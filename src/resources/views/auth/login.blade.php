<x-guest-layout>

    <x-auth-card>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <!-- Email Address -->
            <div>
                <x-label
                    for="email"
                    value="メールアドレス"
                    class="text-sm sm:text-base md:text-lg" />

                <x-input id="email" class="
    block mt-1 w-full
    text-sm sm:text-base md:text-lg
    py-2 sm:py-3
  " type="email" name="email" :value="old('email')"
                    placeholder="例：test@example.com" />
                @error('email')
                <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                @enderror

            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label
                    for="password"
                    value="パスワード"
                    class="text-sm sm:text-base md:text-lg" />
                <x-input id="password" class="
    block mt-1 w-full
    text-sm sm:text-base md:text-lg
    py-2 sm:py-3
  "
                    type="password"
                    name="password"
                    autocomplete="current-password"
                    placeholder="例：coachtech1106" />
                @error('password')
                <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center mt-6">
                <x-button class="bg-flbrown text-white px-10 py-2 hover:opacity-90">
                    ログイン
                </x-button>
            </div>

        </form>
    </x-auth-card>
</x-guest-layout>