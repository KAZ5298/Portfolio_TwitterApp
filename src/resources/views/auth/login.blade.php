<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
</head>

<body>

    {{--  ヘッダー --}}

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" value="アカウント名（ユーザーＩＤ）または、メールアドレス" />
                    <x-text-input id="email" class="block mt-1 w-full" type="text" name="email_or_id"
                        :value="old('email_or_id')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email_or_id')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <a href="{{ route('register') }}" class="btn btn-primary">新規登録</a>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">ログイン</button>
                </div>
        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
