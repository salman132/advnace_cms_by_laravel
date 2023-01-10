<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
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
        $users = User::where('is_admin','<>',1)->where('id','<>',Auth::id())->with('role')->paginate(50);
        $roles = Role::all();
        return view('admin.dashboard.users.index',compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function active()
    {
        $users = User::where('is_admin','<>',1)
            ->where('id','<>',Auth::id())
            ->where('is_banned',0)->with('role')
            ->paginate(50);
        return view('admin.dashboard.users.active',compact('users'));
    }

    public function banned()
    {
        $users = User::where('is_admin','<>',1)
            ->where('id','<>',Auth::id())
            ->where('is_banned',1)->with('role')
            ->paginate(50);

        return view('admin.dashboard.users.banned',compact('users'));
    }

    public function email_unverified()
    {
        $users = User::where('is_admin','<>',1)
            ->where('id','<>',Auth::id())
            ->where('email_verified_at',NULL)->with('role')
            ->paginate(50);

        return view('admin.dashboard.users.unverified',compact('users'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $perm = perm_deny(Auth::user()->role_id,5);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'name'=>'required|string|max:130',
            'email'=>'required|string|email|unique:users',
            'password'=> 'required|string|max:120',
            'confirm_password' => 'required|string|max:120',
            'role_id' => 'required|integer|min:1',
            'profile_pic' => 'nullable|image'
        ]);

        if($request->password != $request->confirm_password){
            Session::flash('danger',"Password doesn't matching");
            return redirect()->route('users.index');
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;

        if($request->hasFile('profile_pic')){
           $user->profile_pic = file_upload($request->profile_pic,'uploads/users/profile/','270','250');
        }
        $user->save();
        Session::flash('success','You added a User');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perm = perm_deny(Auth::user()->role_id,5);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $user = User::findOrFail($id);
        $roles = Role::all();

        $last_login = LoginHistory::where('user_id',$id)->orderBy('created_at','DESC')->first(['created_at','country']);
        return view('admin.dashboard.users.show',compact('user','roles','last_login'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $user = User::findOrFail($id);
        $roles = Role::all();

        //Permission Checking

        if(Auth::id() == $id){
            Session::flash('danger',"You don't have the permission to view this page");
            return redirect()->route('users.index');
        }
        //Can not edit on same role user
        if($user->role_id == Auth::user()->role_id && Auth::user()->is_admin !=1){
            Session::flash('danger',"You don't have the permission to view this page");
            return redirect()->route('users.index');
        }
        //End Of Permission Checking


        return view('admin.dashboard.users.edit',compact('user','roles'));
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
        $perm = perm_deny(Auth::user()->role_id,5);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'name'=> 'required|max:255',
            'email'=>'required|email',
            'role_id'=>'integer|min:1',
            'status'=> 'string|min:2:max:3'
        ]);

       //Permission Checking
        $user = User::findOrFail($id);


        if($user->is_admin ==1){
            Session::flash('danger',"You don't have the permission to view this page");
            return redirect()->route('users.index');
        }

        if($user->role_id == Auth::user()->role_id && Auth::user()->is_admin !=1){
            Session::flash('danger',"You don't have the permission to view this page");
            return redirect()->route('users.index');
        }
        //End of Permission Checking

        $user->name = $request->name;
        //Email availability check
        if($request->email != $user->email){
            $email_check = User::where('email',$request->email)->first();

            if(!empty($email_check)){
                Session::flash('danger','This email is already exists');
                return redirect()->back();
            }
            $user->email = $request->email;
        }
        else{
            $user->email = $request->email;
        }
        //End of email  availability check

        $user->role_id = $request->role_id;

        //Storing the banned records only
        $request->status = strtolower($request->status) == 'on' ? 0 : 1;
        if($request->status != $user->is_banned){
            $user->is_banned = $request->status;
            if(strtolower($request->status) != 'on'){
                $user->banned_by = Auth::id();
            }
        }
        $user->updated_by = Auth::id();
        $user->save();

        Session::flash('success','You Updated Info');
        return redirect()->back();
    }

    public function availablityCheck(Request $request){
       if($request->ajax()){
           $user = User::where('email',$request->email)->first();
           if(!empty($user)){
               $user = 1;
           }
           else{
               $user = 0;
           }
           return $user;
       }
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
}
