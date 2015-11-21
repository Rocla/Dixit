<?php

namespace Dixit\Http\Controllers;

use Illuminate\Http\Request;

use Dixit\Http\Requests;
use Dixit\Http\Controllers\Controller;

use Dixit\Http\Requests\ProfileEditRequest;
//use Validator;
use Auth;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getProfileEdit()
	{
		return view("user.profile-edit");
	}

	public function postProfileEdit(ProfileEditRequest $request)
	{
		$user = Auth::user();

		if($request->has('username'))
		{
			$user->username = $request->get('username');
		}

		// if($request->has('email'))
		// {
		// 	if ($request->get('email') != $user->email){

		// 		$rules = array('email' => 'unique:users');
  //               $validator = Validator::make($request->get('email'), $rules);
  //               if ($validator->passes()){
  //                   $user->email = $request->get('email');
  //               }
  //               else
  //               {
  //               	static::$errors = $validation->messages();
  //               }
		// 	}
		// }

		if($request->has('password'))
		{
			$user->password = bcrypt($request->get('password'));
		}

		if($request->has('question') || $request->has('answer'))
		{
			$user->question = $request->get('question');
			$user->answer = bcrypt($request->get('answer'));
		}

		$user->save();

		return redirect('/home')->with(['edited' => 'Congrats, your profile has been updated']);

	}
}
