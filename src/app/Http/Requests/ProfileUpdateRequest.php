<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'name' => ['string', 'max:255'],
            // 'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            // 'nickname' => ['string', 'max:255'],
            'name' => ['required', 'string', 'max:50', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => ['required', 'string', 'email:filter', 'max:50', Rule::unique(User::class)->ignore($this->user()->id)],
            'nickname' => ['required', 'string', 'max:50'],
            'password' => ['exclude_if:password_change,no', 'required', 'confirmed', 'regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\-]{8,}$/'],
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

            // ユニークチェック
            'name.unique' => '既に登録されているアカウント名です。',
            'email.unique' => '既に登録されているメールアドレスです。',

            // 文字数チェック
            'name.max' => 'アカウント名は５０文字以下で入力して下さい。',
            'email.max' => 'メールアドレスは５０文字以下で入力して下さい。',
            'nickname.max' => 'ニックネームは５０文字以下で入力して下さい。',

            // 正規表現チェック
            'email.email' => 'メールアドレスは xxx@xxx.xxx の形式で入力して下さい。',
            'password.regex' => 'パスワードは半角英数大文字小文字１文字含む８文字以上で入力して下さい。',

            // ダブルチェック
            'password.confirmed' => 'パスワードが一致しません。',
        ];
    }
}
