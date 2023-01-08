<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginHistoryController extends Controller
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
        $user = User::findOrFail(Auth::id());

        $login_histories = LoginHistory::where('user_id',$user->id)->orderBy('created_at','DESC')->paginate();

        return view('admin.dashboard.histories.index',compact('login_histories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user = User::findOrFail($id);
        if($user->is_admin){
            Session::flash('danger',"You don't have the permission to view this page");
            return redirect()->route('users.index');
        }
        $login_histories = LoginHistory::where('user_id',$id)->orderBy('created_at','DESC')->get();

        return view('admin.dashboard.users.login-histories',compact('login_histories'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $perm = perm_deny(Auth::user()->role_id,6);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'history_id'=> 'required|integer'
        ]);

        $login_history = LoginHistory::findOrFail($request->history_id);
        $login_history->delete();

        Session::flash('success','You deleted a Login History');

        return redirect()->back();
    }
}
