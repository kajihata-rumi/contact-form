@extends('layouts.contact')


@section('content')
<h1>お問い合わせ</h1>

@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif

<form method="POST" action="{{ url('/contacts/confirm') }}">
    @csrf

    <div>
        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="姓">
        @error('last_name') <p class="error">{{ $message }}</p> @enderror

        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="名">
        @error('first_name') <p class="error">{{ $message }}</p> @enderror

    </div>
    <div>
        <label>性別</label>

        <label>
            <input type="radio" name="gender" value="1"
                {{ (int)old('gender', 1) === 1 ? 'checked' : '' }}>
            男性
        </label>

        <label>
            <input type="radio" name="gender" value="2"
                {{ (int)old('gender') === 2 ? 'checked' : '' }}>
            女性
        </label>

        <label>
            <input type="radio" name="gender" value="3"
                {{ (int)old('gender') === 3 ? 'checked' : '' }}>
            その他
        </label>

        @error('gender')
        <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>メール</label>
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        <label>電話番号</label>
        <input type="text" name="tel1" value="{{ old('tel1') }}" size="4"> -
        <input type="text" name="tel2" value="{{ old('tel2') }}" size="4"> -
        <input type="text" name="tel3" value="{{ old('tel3') }}" size="4">
        @error('tel') 
        <p class="error">{{ $message }}</p> 
        @enderror
    </div>
    <div>
        <label>住所</label>
        <input type="text" name="address" value="{{ old('address') }}">
        @error('address') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div>
        <label>建物名</label>
        <input type="text" name="building" value="{{ old('building') }}">
    </div>
    <div>
        <label>お問い合わせの種類</label>
        <select name="category_id">
            <option value="">選択してください</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->content }}
            </option>
            @endforeach
        </select>
        @error('category_id') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div>
        <label>内容</label>
        <textarea name="detail">{{ old('detail') }}</textarea>
    </div>

    <button type="submit">確認</button>
</form>
@endsection