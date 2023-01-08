<?php

namespace App\Http\Controllers\Admin;

use App\Frontend;
use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use App\Timezone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
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
        $settings = GeneralSetting::first();
        $timezones = Timezone::all();



        return view('admin.dashboard.settings.basic',compact('settings','timezones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = GeneralSetting::first();
        $socials = Frontend::where('key','gmail.auth')->orWhere('key','facebook.auth')->get();
        return view('admin.dashboard.settings.social',compact('settings','socials'));
    }

    public function socialUpdate(Request $request,$id){
        $perm = perm_deny(Auth::user()->role_id,14);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        strtolower($request->social_login) == 'on' ? $social_login =1 : $social_login =0;


        $gs = GeneralSetting::findOrFail($id);
        $gs->social_login = $social_login;
        $gs->save();
        Session::flash('success','Changed has been saved successfully');

        return redirect()->back();
    }

    public function socialEdit(Request $request){
        $perm = perm_deny(Auth::user()->role_id,14);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'id'=> 'required|integer|min:1',
            'name'=> 'required|string|max:100',
            'client_id'=> 'required|string|max:100',
            'client_secret'=> 'required|string|max:100',
            'status'=> 'required|integer|min:0|max:1'
        ]);

        $frontend = Frontend::findOrFail($request->id);

        $frontend->value = $request->except('_token');
        $frontend->save();

        Session::flash('success','Changed has been saved successfully');

        return redirect()->back();

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $perm = perm_deny(Auth::user()->role_id,14);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'site_title'=> 'required|string',
            'currency'=> 'required|string|min:3|max:10',
            'currency_symbol' => 'required|min:1|max:3',
            'alertui'=> 'required',
            'timezone' => 'required|integer',

        ]);
        strtolower($request->email_verification) =="on" ? $email_verification =1 : $email_verification =0;
        strtolower($request->email_notify) =="on" ? $email_notify =1 : $email_notify =0;
        strtolower($request->user_register) =="on" ? $user_register =1 : $user_register =0;




        $generalSettings = GeneralSetting::find($id);

        $generalSettings->site_title = $request->site_title;
        $generalSettings->currency = $request->currency;
        $generalSettings->currency_symbol = $request->currency_symbol;
        $generalSettings->ev = $email_verification;
        $generalSettings->en = $email_notify;
        $generalSettings->user_register = $user_register;
        $generalSettings->alert_system = $request->alertui;
        $generalSettings->timezone_id = $request->timezone;
        $generalSettings->bg_color = $request->bg_color;

        if($request->hasFile('image')){
            if(file_exists($generalSettings->bg_image)){
                unlink($generalSettings->bg_image);
            }
            $generalSettings->bg_image = file_upload($request->image,'uploads/thumbnails/','1400','787');
        }
        $generalSettings->save();
        Session::flash('success','You Updated Settings');

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logo(){
        $settings = GeneralSetting::first(['id','logo','favicon']);

        return view("admin.dashboard.settings.logo",compact('settings'));

    }

    public function logoUpdate(Request $request,$id){

        $perm = perm_deny(Auth::user()->role_id,14);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'logo'=> 'image|mimes:jpg,png,jpeg',
            'favicon' => 'image|mimes:jpg,png,jpeg',
        ]);

        $settings = GeneralSetting::first();
       if($request->hasFile('logo')){
            if(file_exists($settings->logo)){
                unlink($settings->logo);
            }
            $settings->logo = file_upload($request->logo,'uploads/logo/',300,250);
       }
       if($request->hasFile('favicon')){
           if(file_exists($settings->favicon)){
               unlink($settings->favicon);
           }
            $settings->favicon = file_upload($request->favicon,'uploads/logo/',120,105);
       }
       $settings->save();
       Session::flash('success','You Uploaded the logo & favicon');
       return redirect()->back();
    }

    public function permShow(){

        $roles = Role::all();

        return view('admin.dashboard.settings.role_list',compact('roles'));
    }


    public function addRole(Request $request){
        $perm = perm_deny(Auth::user()->role_id,14);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'role_name' => 'required|string|max:255'
        ]);

        Role::create([
            'name' => $request->role_name,
        ]);

        Session::flash('success','You added a role');
        return redirect()->back();
    }

    public function permSet($role){

        $permission = Permission::where('role_id',$role)->first('perm_id');

        if(!empty($permission)){
            $permission = explode(",",$permission->perm_id);
        }
        else{
            $permission = array();
        }
        $role_name = Role::findOrFail($role);


        return view('admin.dashboard.settings.permission',compact('role','permission','role_name'));
    }

    public function permUpdate(Request $request,$role){
        $perm = perm_deny(Auth::user()->role_id,14);
        if(Auth::user()->is_admin){
            $perm = true;
        }
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'permission'=>'required',
            'permission.*'=> 'integer|min:1'
        ]);


        $permission = Permission::where('role_id',$role)->first();
        if(!empty($permission)){
            $permission->role_id = $role;
            $permission->perm_id = implode(",",$request->permission);
            $permission->given_by = Auth::id();
            $permission->save();
        }
        else{
            $permission = new Permission();
            $permission->role_id = $role;
            $permission->perm_id = implode(",",$request->permission);
            $permission->given_by = Auth::id();
            $permission->save();
        }

        Session::flash('success','You update permission');
        return redirect()->back();


    }



}
