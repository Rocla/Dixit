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
use Input;
use Request;

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
            'question'  =>  'required|max:255',
            'answer'    =>  'required|confirmed|max:255',
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
            'question'  =>  $data['question'],
            'answer'    =>  bcrypt($data['answer']),
        ]);
    }

    public function getRecoverPassword()
    {
        return view('auth.recover');
        
    }

    public function postTestEmail()
    {
        if(Request::ajax()){

            $rules = [
                'email' =>  'required|email|max:255',
            ];

            $data = Input::all();

            $validator = Validator::make($data, $rules);

            if ($validator->fails()){
                
            }
            else
            {
                $rules = array('email' => 'unique:users');
                $validator = Validator::make($data, $rules);
                if ($validator->fails()){
                    $user = User::where('email', $data['email'])->first();
                    return($user->question);
                }
                else
                {
                    return('0');
                }
            }
        }

    }

    public function postRecoverPassword(PasswordRecoveryRequest $request)
    {
        $answer = $request->get('answer');

        $user = User::where('email', $request->get('email'))->first();

        if(Hash::check($answer,$user->answer))
        {
            $user->password = bcrypt($request->get('password'));

            $user->save();

            return redirect('auth/login')
            ->with(['success' => '2']);
        }

        return redirect('auth/recover-password')->withInput($request->only('email', 'question'))
        ->withErrors('1');
    }
}
