<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException; 

class RegisterRequest extends FormRequest
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
        return [
            'name'   => 'required',
            'email'   => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ];
    }

    public function messages(){
        return [
            'name.required'  => "ユーザーネームを入力してください",
            'email.required'  => "メールアドレスを入力してください",
            'password.required'       => 'パスワードを入力してください',
            'password.min'       => 'パスワードは8文字以上でお願いします',
            'password.confirmed' => '確認用パスワードと一致しません。',
            'password_confirmation.required' => '確認用パスワードを入力してください。',
            'password_confirmation.min' => '確認用passwordも8字以上でお願いします。',
        ];
        
    }
}