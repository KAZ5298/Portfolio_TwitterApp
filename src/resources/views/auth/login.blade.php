<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/login_view.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@30,400,0,0">
</head>

<body class="bg-primary-subtle">

    {{--  ヘッダー --}}
    <div class="header">
        <div class="title bg-primary">
            Twitter Modoki
        </div>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input name">
                    <label for="name">アカウント名（ユーザーＩＤ）または、メールアドレス</label>
                    @if (!$errors->has('email_or_id'))
                        <input id="name" class="form normal" type="text" name="email_or_id">
                    @else
                        <input id="name" class="form error" type="text" name="email_or_id">
                        @foreach ($errors->get('email_or_id') as $message)
                            <label class="error-msg">{{ $message }}</label>
                        @endforeach
                    @endif
                </div>

                <div class="input password">
                    <label for="password">パスワード</label>
                    @if (!$errors->has('password'))
                        <input id="password" class="form normal" type="password" name="password">
                    @else
                        <input id="password" class="form error" type="password" name="password">
                        @foreach ($errors->get('password') as $message)
                            <label class="error-msg">{{ $message }}</label>
                        @endforeach
                    @endif
                </div>

                <div class="button">
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        <span class="material-symbols-outlined"> person_add </span>
                        <span class="btn-name">新規登録</span>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <span class="material-symbols-outlined"> login </span>
                        <span class="btn-name">ログイン</span>
                    </button>
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
