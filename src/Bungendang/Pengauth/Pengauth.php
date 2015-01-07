<?php
use Illuminate\Support\Facades\Facade;
namespace Bungendang\Pengauth;

class Pengauth {
	public $y;

	public function __construct($x = null)
    {
        $x = 'login';
        return $x;
    }

    public function get($x)
    {
        $x = 'gagal login';
        return $x;
    }

	public function register($input){
		
		$input = (object) $input ;
		$code = str_random(60);
		$username = $input->username;
		$email = $input->email;
		$password = \Hash::make($input->password);
		
		$user = new \User();
		$user->username = $username;
		$user->email     = $email;
		$user->password  = $password;
		$user->activation_code = $code;
		$user->status = 0;
		$user->id_role = 0;
		$user->save();

		\Mail::send('pengauth::emails.activation',array('link'=>\URL::route('user-activate',$code),'username'=>$username),function ($message) use ($user){
		$message->to($user->email,$user->username)->subject('activate your account');
		});				
	}

	public function login($input){
		$input = \Input::all();
		$input = (object) $input;
		$remember = (\Input::has('remember')) ? true : false;
					
					//if login with email address
					$authwithemail = \Auth::attempt(array(
							'email' => $input->useremail,
							'password' => $input->password,
							'status' => 1,
							'id_role' => 0
						), $remember);
					//if login with username
					$auth = \Auth::attempt(array(
							'username' => $input->useremail,
							'password' => $input->password,
							'status' => 1,
							'id_role' => 0
						), $remember);
					//if login with email address and type 8 (admin)
					$authadminwithemail = \Auth::attempt(array(
							'email' => $input->useremail,
							'password' => $input->password,
							'status' => 1,
							'id_role' => 8
						), $remember);
					//if login with username and type 8 (admin)
					$authforadmin = \Auth::attempt(array(
							'username' => $input->useremail,
							'password' => $input->password,
							'status' => 1,
							'id_role' => 8
						), $remember);
					if($auth){
					//	$input = $auth;
						//return \Redirect::to('/');
//						echo 'login sebagai user biasa';
						\Session::put(array('url_after_login'=> '/','message'=>'welcome back'));			
					} elseif ($authforadmin) {
//						echo 'login sebagai user admin';
						\Session::put(array('url_after_login'=> 'admin','message'=>'welcome back'));
					} elseif ($authwithemail) {
						//echo 'login sebagai user biasa menggunakan email';
						\Session::put(array('url_after_login'=> '/','message'=>'welcome back'));			
					}elseif($authadminwithemail){
						//echo 'login sebagai user admin menggunakan email';
						\Session::put(array('url_after_login'=> 'admin','message'=>'welcome admin'));
					} else {
						//echo 'gagal login';
						//$response = '\Redirect::to';
						//Pengauth::get('response');
						//var_dump($x);
						\Session::put(array('url_after_login'=> 'login','message'=>'$x'));
					}
					//var_dump($response);

	}
}

\App::bind('pengauth', function()
{
    return new \Bungendang\Pengauth;
});