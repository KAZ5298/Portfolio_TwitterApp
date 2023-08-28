<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
</head>

<body>

    {{--  ヘッダー --}}
    <div class="header">
        <div class="container">
            <h1>Twitter Modoki</h1>
        </div>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            <form method="POST" action="{{ route('registerCheck') }}" enctype="multipart/form-data">
                @csrf

                <label>下記の項目を入力してください。<span style="color:red">（※項目は入力必須）</span></label>

                <!-- Name -->
                <div>
                    <x-input-label for="name" value="アカウント名" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" value="メールアドレス" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Nick Name -->
                <div class="mt-4">
                    <x-input-label for="nickname" value="ニックネーム（一覧画面での表示名）" />
                    <x-text-input id="nickname" class="block mt-1 w-full" type="text" name="nickname"
                        :value="old('nickname')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
                </div>

                <!-- Profile Icon -->
                <div class="mt-4">
                    <x-input-label for="icon" value="プロフィール画像" />
                    <div>
                        <input id="icon" type="file" name="icon">
                    </div>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" value="パスワード" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" value="パスワード（再確認）" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">登録</button>
                    <button type="reset" class="btn btn-danger">リセット</button>
                    <a href="{{ route('login') }}" class="btn btn-secondary">ログイン画面へ戻る</a>
                </div>
            </form>
        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
