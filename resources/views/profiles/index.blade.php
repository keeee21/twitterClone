１番目にここにくる。
ここで、登録情報を表示+編集するedit+新規登録createする。
screen_name を
持っていたら、ユーザー情報を表示+編集ボタンを表示
持っていなかったら、新規登録のボタンを表示

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">タイムライン</h2>
    </x-slot>
    
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">

            <div class="bg-pink-300">
                <div class="flex">
                    <h1>プロフィール</h1>
                </div>
            </div>

            <div>
                
            </div>
        </div>
    </div>
</x-app-layout>
