<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo(){
        if(Auth::user()->is_admin){
            return route('admin.dashboard');
        }
        elseif(!empty(Auth::user()->role_id ==1)){
            return route('admin.dashboard');

        }
        elseif(Auth::user()->is_banned){

            Session::flash('danger','Your Current Status is Banned');
            Auth::logout();
            return '/login';
        }
        else{
            return '/home';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {

        $find_histories = LoginHistory::where('user_id',$user->id)->get();
        if(count($find_histories)>=3){
            $record = LoginHistory::where('user_id',$user->id)->orderBy('created_at','DESC')->first();
            LoginHistory::where('user_id',$user->id)->where('id','<>',$record->id)->delete();

            $login_history = LoginHistory::find($record->id);
    }
        else{
            $login_history = new LoginHistory();
        }


        $login_history->user_id = Auth::id();
        $login_history->ip_address = get_client_ip();
        $login_history->browser = getBrowser();
        $login_history->os = getOS();
        if(empty(get_country()->geoplugin_countryName)){
            $login_history->country  = 'Unknown';
            $login_history->visitor_info = "Unknown";
        }
        else {
            $login_history->country = get_country()->geoplugin_countryName;
            $login_history->visitor_info = (object)get_country();
        }
        $login_history->save();


    }




}
