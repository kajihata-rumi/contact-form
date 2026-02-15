<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}" novalidate>

            @csrf

            @if ($errors->any())
            <p class="text-red-500 font-bold mb-4">入力に問題があります</p>
            @endif

            <!-- Name -->
            <div>
                <x-label for="name" value="お名前" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    placeholder="例：山田 太郎" />
                @error('name')
                <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                @enderror

            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" value="メールアドレス" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username"
                    placeholder="例：test@example.com" />
                @error('email')
                <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                @enderror

            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" value="パスワード" />

                <x-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="new-password"
                    placeholder="例：coachtech1106" />
                @error('password')
                <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                @enderror

            </div>



            <div class="flex items-center justify-center mt-8">

            </div>
            <button
                type="submit"
                class="inline-flex items-center px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                登録
            </button>
        </form>
    </x-auth-card>
</x-guest-layout>