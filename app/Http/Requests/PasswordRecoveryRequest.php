<?php 

namespace Dixit\Http\Requests;

use Dixit\Http\Requests\Request;

class PasswordRecoveryRequest extends Request {

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return
		[
			'email' => 'email|required|exists:users,email',
			'password' => 'required|min:6|confirmed',
			'public_key' => 'required',
			'private_key' => 'required'
		];
	}

}
