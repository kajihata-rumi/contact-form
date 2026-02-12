<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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

    // ContactRequest（バリデーション失敗時の戻り先）を /contacts に固定
    protected $redirect = '/contacts';

    public function rules()
    {
        $route = $this->route()->getName(); // ルート名取得

        // store のとき（confirm から送信）
        if ($route === 'contacts.store') {
            return [
                'last_name' => ['required'],
                'first_name' => ['required'],
                'gender' => ['required'],
                'email' => ['required', 'email'],
                'tel' => ['required', 'regex:/^[0-9]+$/'],   // confirmから来るtel
                'address' => ['required'],
                'building' => ['nullable'],
                'category_id' => ['required'],
                'detail' => ['required', 'max:120'],
            ];
        }

        // confirm のとき（フォーム→確認）
        return [
            'last_name' => ['required'],
            'first_name' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'tel1' => ['required', 'regex:/^[0-9]+$/', 'max:5'],
            'tel2' => ['required', 'regex:/^[0-9]+$/', 'max:5'],
            'tel3' => ['required', 'regex:/^[0-9]+$/', 'max:5'],
            'address' => ['required'],
            'building' => ['nullable'],
            'category_id' => ['required'],
            'detail' => ['required', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',

            'tel1.required' => '電話番号を入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel1.regex' => '電話番号は半角英数字で入力してください',
            'tel2.regex' => '電話番号は半角英数字で入力してください',
            'tel3.regex' => '電話番号は半角英数字で入力してください',
            'tel1.max' => '電話番号は5桁まで数字で入力してください',
            'tel2.max' => '電話番号は5桁まで数字で入力してください',
            'tel3.max' => '電話番号は5桁まで数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
