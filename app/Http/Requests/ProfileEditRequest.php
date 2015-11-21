<?php

namespace Dixit\Http\Requests;

use Dixit\Http\Requests\Request;

class ProfileEditRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return
        [
            'username'  =>  'max:255',
            //'email'     =>  'email|max:255',
            'password'  =>  'confirmed|min:6',
            'question'  =>  'required_with:answer',
            'answer'    =>  'required_with:question'
        ];
    }
}
