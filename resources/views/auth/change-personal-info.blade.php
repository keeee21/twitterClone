<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('update') }}">
            @csrf

            <p>再度、全ての個人情報を登録してください</p>
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('*氏名')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$user->name}}" required autofocus/>
                <!-- <input name="name" value="{{$user->name}}" type="text" id="name" required class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50"> -->
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('*メールアドレス')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('*パスワード (8文字以上)')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('*パスワード確認')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4 space-x-4">
                <button class="py-2 px-3 mr-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-blue-600 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    更新する
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
