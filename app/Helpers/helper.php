<?php
use App\Models\GeneralSetting;
use App\Models\PaymentsGateway;
use Illuminate\Support\Facades\Mail;

// import the Intervention Image Manager Class
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;



function file_upload($file = NULL, $dir = NULL,$width=null,$height=null)
{
    if ($dir == NULL || $file ==NULL) {
        return false;
    } else {
        $name = $file;

        $new_name = time().$name->getClientOriginalName();

        $new_name = pathinfo($new_name,PATHINFO_FILENAME);
        $new_name = \Illuminate\Support\Str::slug($new_name);

        $get_extension = $name->getClientOriginalExtension();


        if($get_extension == 'jpg' || $get_extension =='png' || $get_extension =='jpeg'){

            $new_name = $new_name.".".$get_extension;

            $name->move($dir,$new_name);
            if(empty($width)){
                $width = Image::make($dir.$new_name)->width();
                $height = null;
            }

            $image = Image::make($dir.$new_name)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save();
            return $dir.$new_name;
        }
        else {
            $new_name = $new_name.".".$get_extension;
            $name->move($dir, $new_name);

            return $dir . $new_name;
        }
    }
}


function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function getBrowser() {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $browser        = "Unknown Browser";

    $browser_array = array(
        '/msie/i'      => 'Internet Explorer',
        '/firefox/i'   => 'Firefox',
        '/safari/i'    => 'Safari',
        '/chrome/i'    => 'Chrome',
        '/edge/i'      => 'Edge',
        '/opera/i'     => 'Opera',
        '/netscape/i'  => 'Netscape',
        '/maxthon/i'   => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i'    => 'Handheld Browser'
    );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}

function getOS() {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];;

    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function get_country(){


    $connected = @fsockopen("www.google.com", 80);
    if($connected) {
        $ip = get_client_ip();

//          $ip = '103.4.146.218';
        $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".$ip);

        if($xml->geoplugin_status == 404){
            fclose($connected);
            return "Unknown";
        }
        else{
            fclose($connected);
            return $xml;
        }
    }
    else {
        return "Unknown";
    }
}

function app_settings(){

    $settings = GeneralSetting::first();



    Config::set('SITE_TITLE',$settings->site_title);
    Config::set('timezone',$settings->timezone->timezone);
    Config::set('FAVICON',$settings->favicon);
    Config::set('ALERT_SYSTEM',$settings->alert_system);
    Config::set('USER_REGISTER',$settings->user_register);
    Config::set('BASE_BACKGROUND_IMAGE',$settings->bg_image);
    Config::set('CURRENCY_SYMBOL',$settings->currency_symbol);

    return $settings;

}

function email_template(){

    $settings =  GeneralSetting::first(['email_template']);

    return $settings->email_template;
}

function url_format($url){
    $get_url = parse_url($url);
    return $get_url['path'];
}

function sidebar_open($p,$path){
    if(preg_match($p,$path)){
        return "open";
    }
    else{
        return null;
    }
}

function menu_active($p){
    $path = request()->path();

    if($p == $path){
        return "active";
    }
    else{
        return null;
    }
}


function smtp_email($smtp,$to,$receiver_name,$sub,$msg){

    $settings = GeneralSetting::first();
    if($settings->email_config == 2){
        $from = GeneralSetting::first(['email']);

        Config::set('mail.driver',$smtp->driver);
        Config::set('mail.host',$smtp->host);
        Config::set('mail.port',$smtp->port_no);
        Config::set('mail.encryption',$smtp->encryption);
        Config::set('mail.username',$smtp->username);
        Config::set('mail.password',$smtp->password);

        Mail::to($to)->send(new \App\Mail\sendEmail($to,$receiver_name,$sub,$msg,$from));

    }
    else{
        return false;
    }
}

function php_mail($to,$sub,$msg){
    $settings = GeneralSetting::first();

    $from = GeneralSetting::first(['email']);

    if($settings->email_config ==1){
        $headers = "From: $from <$from> \r\n";
        $headers .= "Reply-To: $to <$to> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        mail($to,$sub,$msg,$headers);
    }
    else{
        return false;
    }
}


function mailgun_api($config,$to,$receiver_name,$sub,$msg){
    $settings = GeneralSetting::first();

    $from = $settings->email;



    if($settings->email_config ==3){

        Config::set('mail.driver','mailgun');
        Config::set('services.mailgun.domain',$config->value->api_domain);
        Config::set('services.mailgun.secret',$config->value->api_secret);
        Config::set('services.mailgun.endpoint',$config->value->api_endpoint);

        Mail::to($to)->send(new \App\Mail\sendEmail($to,$receiver_name,$sub,$msg,$from));

    }
    else{
        return false;
    }

}


function pay_with_paypal(){
    $paypal = PaymentsGateway::where('gateway_name','PayPal')->first();

    if(!empty($paypal)){
        Config::set('paypal.client_id',decrypt($paypal->client_id));
        Config::set('paypal.secret',decrypt($paypal->client_secret));

        return $paypal;
    }
    else{
        return false;
    }
}

function pay_with_stripe(){
    $stripe = PaymentsGateway::where('gateway_name','Stripe')->first();

    if(!empty($stripe)){
        Config::set('stripe.client_id',decrypt($stripe->client_id));
        Config::set('stripe.secret',decrypt($stripe->client_secret));

        return $stripe;
    }
    else{
        return false;
    }
}

function permission($role_id,$perm_id) : bool {

    $perm = \App\Models\Permission::where('role_id',$role_id)->whereIn('perm_id',explode(',',$perm_id))->first();
    return !empty($perm);

}

function perm_deny($role_id,$perm_id): bool {

    $perm = \App\Models\Permission::where('role_id',$role_id)->first();
    return in_array($perm_id,explode(",",$perm->perm_id));

}

function social_login($provider){

    if($provider == 'facebook'){

        $call_back_url = Request::root()."/login/facebook/callback";
        $facebook = \App\Models\Frontend::where('key','facebook.auth')->first();

        if(!empty($facebook)){
            Config::set('services.facebook.client_id',$facebook->value->client_id);
            Config::set('services.facebook.client_secret',$facebook->value->client_secret);
            Config::set('services.facebook.redirect',$call_back_url);

        }

    }
    if($provider == 'google'){

        $call_back_url = Request::root()."/login/google/callback";;
        $google = \App\Models\Frontend::where('key','gmail.auth')->first();


        if(!empty($google)){
            Config::set('services.google.client_id',$google->value->client_id);
            Config::set('services.google.client_secret',$google->value->client_secret);
            Config::set('services.google.redirect',$call_back_url);

        }

    }


    return true;
}


function new_orders_count(){
    $order = \App\Models\Order::where('is_accepted',null)->count();
    return $order;
}















