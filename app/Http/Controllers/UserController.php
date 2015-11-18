<?php

namespace Dixit\Http\Controllers;

use Illuminate\Http\Request;

use Dixit\Http\Requests;
use Dixit\Http\Controllers\Controller;

use Auth;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getEditProfile()
	{
		return "get Edit Profile";
	}

	public function postEditProfile(EditProfileRequest $request)
	{
		$user = Auth::user();

		$user->email = $request->get('email');

		if($request->has('password'))
		{
			$user->password = bcrypt($request->get('password'));
		}

		if($request->has('public_key') || $request->has('private_key'))
		{
			$user->public_key = bcrypt($request->get('public_key'));
			$user->private_key = bcrypt($request->get('private_key'));
		}

		$user->save();

		return redirect('/home')->with(['edited' => 'Congrats, your profile has been updated']);

	}
}
