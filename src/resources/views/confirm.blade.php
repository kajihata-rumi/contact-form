@extends('layouts.contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection
@section('title', 'お問い合わせ')
@section('content')

<form class="form" action="{{ route('contacts.store') }}" method="post">
    @csrf

    <div class="confirm-table">
        <table class="confirm-table__inner">
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お名前</th>
                <td class="confirm-table__text">
                    {{ $contact['last_name'] }} {{ $contact['first_name'] }}
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] ?? '' }}">
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">性別</th>
                <td class="confirm-table__text">
                    @if ($contact['gender'] == 1)
                    男性
                    @elseif ($contact['gender'] == 2)
                    女性
                    @else
                    その他
                    @endif
                    <input type="hidden" name="gender" value="{{ $contact['gender'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">メールアドレス</th>
                <td class="confirm-table__text">
                    {{ $contact['email'] ?? '' }}
                    <input type="hidden" name="email" value="{{ $contact['email'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">電話番号</th>
                <td class="confirm-table__text">
                    {{ ($contact['tel1'] ?? '') . ($contact['tel2'] ?? '') . ($contact['tel3'] ?? '') }}

                    <input type="hidden" name="tel1" value="{{ $contact['tel1'] ?? '' }}">
                    <input type="hidden" name="tel2" value="{{ $contact['tel2'] ?? '' }}">
                    <input type="hidden" name="tel3" value="{{ $contact['tel3'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">住所</th>
                <td class="confirm-table__text">
                    {{ $contact['address'] ?? '' }}
                    <input type="hidden" name="address" value="{{ $contact['address'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">建物名</th>
                <td class="confirm-table__text">
                    {{ $contact['building'] ?? '' }}
                    <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせの種類</th>
                <td class="confirm-table__text">
                    {{ $contact['category_text'] ?? '' }}
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] ?? '' }}">
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせ内容</th>
                <td class="confirm-table__text">
                    {!! nl2br(e($contact['detail'] ?? '')) !!}
                    <input type="hidden" name="detail" value="{{ $contact['detail'] ?? '' }}">
                </td>
            </tr>
        </table>
    </div>

    <!--✅ 送信ボタンは「外側form」の中に置く-->
    <form class="form" action="{{ route('contacts.store') }}" method="post">
        @csrf

        {{-- ✅ 入力値を送信するため hidden を全部ここにも入れる --}}
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] ?? '' }}">
        <input type="hidden" name="first_name" value="{{ $contact['first_name'] ?? '' }}">
        <input type="hidden" name="gender" value="{{ $contact['gender'] ?? '' }}">
        <input type="hidden" name="email" value="{{ $contact['email'] ?? '' }}">

        <input type="hidden" name="tel" value="{{ ($contact['tel1'] ?? '') . ($contact['tel2'] ?? '') . ($contact['tel3'] ?? '') }}">

        <input type="hidden" name="tel1" value="{{ $contact['tel1'] ?? '' }}">
        <input type="hidden" name="tel2" value="{{ $contact['tel2'] ?? '' }}">
        <input type="hidden" name="tel3" value="{{ $contact['tel3'] ?? '' }}">
        <input type="hidden" name="address" value="{{ $contact['address'] ?? '' }}">
        <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}">
        <input type="hidden" name="category_id" value="{{ $contact['category_id'] ?? '' }}">
        <input type="hidden" name="detail" value="{{ $contact['detail'] ?? '' }}">
        <div class="form__buttons">
            <button class="form__button-submit" type="submit">送信</button>
        </div>
    </form>
    <!--✅ 外側formをここで閉じる（重要！）-->

    <!--✅ 修正ボタンは別form（ネストしない）-->
    <form action="{{ route('contacts.back') }}" method="post">
        @csrf

        {{-- ✅ 入力値を戻すため hidden を全部ここにも入れる --}}
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] ?? '' }}">
        <input type="hidden" name="first_name" value="{{ $contact['first_name'] ?? '' }}">
        <input type="hidden" name="gender" value="{{ $contact['gender'] ?? '' }}">
        <input type="hidden" name="email" value="{{ $contact['email'] ?? '' }}">
        <input type="hidden" name="tel1" value="{{ $contact['tel1'] ?? '' }}">
        <input type="hidden" name="tel2" value="{{ $contact['tel2'] ?? '' }}">
        <input type="hidden" name="tel3" value="{{ $contact['tel3'] ?? '' }}">
        <input type="hidden" name="address" value="{{ $contact['address'] ?? '' }}">
        <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}">
        <input type="hidden" name="category_id" value="{{ $contact['category_id'] ?? '' }}">
        <input type="hidden" name="detail" value="{{ $contact['detail'] ?? '' }}">

        <div class="form__buttons">
            <button class="form__button-correct" type="submit">修正</button>
        </div>
    </form>

    @endsection