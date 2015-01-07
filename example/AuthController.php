<?php

class AuthController extends \BaseController {

	public function postLogin(){
		$validator = Validator::make($input = Input::all(),
			array(
				'useremail' => 'required',
				'password' => 'required'
				)
			);

				if($validator->fails()){
					return Redirect::route('user-login')
						->withErrors($validator)
						->withInput();
				} else	{
					Pengauth::login($input);
					//$redirect = $response;	
				}
				return Redirect::to(Session::pull('url_after_login'))->with('alert',Session::get('message')) ;
	}

	public function postRegister()
	{
		$validator = Validator::make($input = Input::all(),
			array(
				'username' => 'required|unique:users,username',
				'email' => 'required|unique:users,email',
				'password' => 'required'
				)
			);
		if ($validator->fails()) {
			return Redirect::to('register')
						->withErrors($validator)
						->withInput();
		}else{
			Pengauth::register($input = Input::all());
		}
		return Redirect::to('login')->with('alert', 'Success!');
	}

	//end store signup data customer
	public function Activate($code){
		
		$user = User::where('activation_code','=',$code)->where('status','=',0);
		if($user->count()) {
			$user = $user->first();
			
			$user->status = 1;
			$user->activation_code = null;
			if($user->save()){
				return Redirect::to('/');
			}
		}
		return Redirect::to('register');
	}


}

