@extends('layouts.contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection
@section('title', 'お問い合わせ')

@section('content')
<div class="thanks__content">
    <div class="thanks__heading">
        <h2>お問い合わせありがとうございました</h2>
    </div>

    <a href="{{ route('contacts.index') }}">HOME</a>

</div>
@endsection