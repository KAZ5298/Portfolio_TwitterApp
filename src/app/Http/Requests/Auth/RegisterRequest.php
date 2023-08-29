<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:' . User::class],
            'nickname' => ['required', 'string', 'max:50'],
            'password' => ['required', 'confirmed', 'regex:'],
        ];
    }

    public function messages()
    {
        return [
            // 空白チェック
            'name.required' => '入力必須項目です。',
            'email.required' => '入力必須項目です。',
            'nickname.required' => '入力必須項目です。',
            'password.required' => '入力必須項目です。',

            // 文字数チェック
            'name.max' => 'アカウント名は５０文字以下で入力して下さい。',
            'email.max' => 'メールアドレスは５０文字以下で入力して下さい。',
            'nickname.max' => 'ニックネームは５０文字以下で入力して下さい。',

            // 正規表現チェック
            'email.email' => 'メールアドレスは xxx@xxx の形式で入力して下さい。',
            'password.Rules' => 'パスワードは半角英数大文字小文字１文字含む８文字以上で入力して下さい。',

            // ダブルチェック
            'password.confirmed' => 'パスワードが一致しません。',
        ];
    }
}
