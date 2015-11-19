<?php

namespace Dixit\Http\Controllers\Auth;

use Dixit\User;
use Validator;
use Dixit\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Dixit\Http\Requests\PasswordRecoveryRequest;
use Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'  =>  'required|max:255',
            'email'     =>  'required|email|max:255|unique:users',
            'password'  =>  'required|confirmed|min:6',
            'public_key' =>  'required|max:255',
            'private_key'    =>  'required|confirmed|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username'  =>  $data['username'],
            'email'     =>  $data['email'],
            'password'  =>  bcrypt($data['password']),
            'public_key'  =>  bcrypt($data['public_key']),
            'private_key'    =>  bcrypt($data['private_key']),
        ]);
    }

    public function getRecoverPassword()
    {
        return view('auth.recover');
        
    }

    public function postRecoverPassword(PasswordRecoveryRequest $request)
    {
        $publicKey = $request->get('public_key');
        $privateKey = $request->get('private_key');

        $user = User::where('email', $request->get('email'))->first();

        if(Hash::check($publicKey,$user->public_key) && Hash::check($privateKey,$user->private_key))
        {
            $user->password = bcrypt($request->get('password'));

            $user->save();

            return redirect('auth/login')
            ->with(['success' => 'Congrats, you modified your password with success!']);
        }

        return redirect('auth/recover-password')->withInput($request->only('email', 'public_key'))
        ->withErrors('Sorry, the public key and/or the private key don\'t match');
    }
}
