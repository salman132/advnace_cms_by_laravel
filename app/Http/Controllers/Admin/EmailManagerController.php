<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailConfig;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Mail\sendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EmailManagerController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('banned');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = GeneralSetting::first(['id','email','email_template']);
        return view('admin.dashboard.emails.design',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = GeneralSetting::first(['id','email','email_config']);
        $email_api = Frontend::where('key','email.config_api')->first();
        return view('admin.dashboard.emails.configure',compact('settings','email_api'));
    }


    public function store(Request $request)
    {
        $perm = perm_deny(Auth::user()->role_id,7);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'subject'=> 'required|string|max:220',
            'sms'=> 'required'
        ]);

        $key = 'email.template';
        $frontend = new Frontend();
        $frontend->key = $key;
        $frontend->value = $request->except('_token');
        $frontend->save();

        Session::flash('success','You added a Template');
        return redirect()->back();
    }


    public function template()
    {
        $templates = Frontend::where('key','email.template')->get();
        return view('admin.dashboard.emails.template',compact('templates'));
    }

    public function draftEdit($id){
        $template = Frontend::findOrFail($id);
        return view('admin.dashboard.emails.template_edit',compact('template'));
    }

    public function draftUpdate(Request $request,$id){

        $perm = perm_deny(Auth::user()->role_id,7);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'subject' => 'required|max:220',
            'sms' => 'required'
        ]);
        $template = Frontend::findOrFail($id);
        $template->value = $request->except('_token');
        $template->save();

        Session::flash('success','You Updated the Settings');
        return redirect()->route('admin.emailTemplate');

    }


    public function edit(Request $request,$id)
    {
        $request->validate([
            'email'=>'required|string|email|max:150',
            'email_body' => 'required',
        ]);

        $settings = GeneralSetting::findOrfail($id);
        $settings->email = $request->email;
        $settings->email_template = $request->email_body;
        $settings->save();
        Session::flash('success','You Updated the Settings');
        return redirect()->back();

    }

    public function sendMail(Request $request){
        $perm = perm_deny(Auth::user()->role_id,7);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'email'=>'required|string|email',
            'subject'=>'required|string|max:155',
            'mail_body'=>'required'
        ]);

        $settings = GeneralSetting::first();

        Session::flash('success','Email Sent Successfully');
        return redirect()->back();
    }

    public function allMailView(){
        return view('admin.dashboard.users.mail');
    }

    public function allMailSend(Request $request){
        $perm = perm_deny(Auth::user()->role_id,7);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'audience'=> 'required|integer|min:1|max:5',
            'subject'=> 'required|string|max:120',
            'mail_body'=> 'required'
        ]);

        $settings = GeneralSetting::first();
        $users = User::when($request->audience ==1,
            fn($query) =>  $query->where('is_admin','<>',1)
            ->where('id','<>',Auth::id())
            ->where('email_verified_at','<>',NULL)->get(['email','name']))
            ->when($request->audience ==2 ,
                fn($query) => $query->where('is_admin','<>',1)
                ->where('id','<>',Auth::id())
                ->where('email_verified_at',NULL)->get(['email','name']))
            ->when($request->audience ==3,
                fn($query) => $query->where('is_admin','<>',1)
                ->where('id','<>',Auth::id())
                ->where('email_verified_at',NULL)->get(['email','name']))
            ->when($request->audience ==4,
                fn($query) => $query->whereNotNull('email')->get(['email','name']));


        //Custom Mail for single user
        if($request->audience ==5){
            $request->validate([
                'receiver'=>'required|string|email'
            ]);

            if($settings->email_config ==1){
                php_mail($request->receiver, $request->subject, $request->mail_body);
            }
            if($settings->email_config ==2){
                $email_config = EmailConfig::first();
                smtp_email($email_config,$request->receiver,$request->receiver,$request->subject, $request->mail_body);
            }
            if($settings->email_config ==3){
                $email_config = Frontend::where('key','email.config_api')->first();
                mailgun_api($email_config,$request->receiver,$request->receiver, $request->subject, $request->mail_body);
            }

            Session::flash('success','All Users will get the email soon');
            return redirect()->back();

        }

        //Mails for group fo users
        if($settings->email_config ==1){

            foreach ($users as $user) {
                php_mail($user->email, $request->subject, $request->mail_body);
            }
        }
        if($settings->email_config ==2){

            foreach ($users as $user) {
                $email_config = EmailConfig::first();
                smtp_email($email_config, $user->email,$user->name ,$request->subject, $request->mail_body);
            }
        }

        if($settings->email_config ==3){

            foreach ($users as $user) {
                $email_config = Frontend::where('key','email.config_api')->first();
                mailgun_api($email_config, $user->email,$user->name, $request->subject, $request->mail_body);
            }
        }

        Session::flash('success','All Users will get the email soon');
        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $perm = perm_deny(Auth::user()->role_id,7);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'email_system'=>'required|integer|min:1|max:3',
            'php_mail_name' => 'string|max:255'
        ]);

        $settings = GeneralSetting::findOrFail($id);

        // For PHP MAIL
        if($request->email_system ==1){
            $settings->email_config = $request->email_system;
            $settings->email = $request->php_mail_name;

        }

        // For SMTP MAIL
        if($request->email_system ==2){
            $request->validate([
                'host' => 'required|string|max:100',
                'port_no' => 'required|string|max:100',
                'driver' => 'required|string|max:200',
                'encryption' => 'nullable|string|max:60',
                'username' => 'required|string|max:200',
                'password'=> 'required|string|max:255',
            ]);

            $settings->email_config = $request->email_system;

            $email_config = EmailConfig::first();
            $email_config->settings_id = $id;
            $email_config->host = $request->host;
            $email_config->username = $request->username;
            $email_config->port_no = $request->port_no;
            $email_config->driver = $request->driver;
            $email_config->encryption = $request->encryption;
            $email_config->password = $request->password;
            $email_config->save();
        }

        //For Mailgun Service
        if($request->email_system ==3){
            $request->validate([
                'api_domain' => 'required|string|max:255',
                'api_secret' => 'required|string|max:255',
                'api_endpoint' => 'string|max:255|nullable',
            ]);

            $settings->email_config = $request->email_system;

            $check_old = Frontend::where('key','email.config_api')->first();

            if(!empty($check_old)){
                $frontend = Frontend::findOrFail($check_old->id);
            }
            else{
                $frontend = new  Frontend();
            }

            $key = 'email.config_api';

            $frontend->key = $key;
            $frontend->value = $request->only(['api_domain','api_secret','api_endpoint']);
            $frontend->save();
        }


        $settings->save();

        Session::flash('success','You Updated the Settings');
        return redirect()->back();


    }

    public function usingTemplate($id){
      $template = Frontend::findOrFail($id);
      return view('admin.dashboard.emails.usingTemplate',compact('template'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $perm = perm_deny(Auth::user()->role_id,7);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'template_id'=>'required|integer|min:1'
        ]);
        $template = Frontend::findOrFail($request->template_id);
        $template->delete();
        Session::flash('success','You Deleted a Template');
        return redirect()->back();
    }
}
