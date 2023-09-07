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
        <div class="container bg-primary-border-subtle">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="error_msg mt-4">
                    <ul>
                        @if ($errors->any())
                            <div class="border px-4 py-3 rounded relative bg-danger-subtle">
                                @foreach ($errors->all() as $message)
                                    <li> {{ $message }} </li>
                                @endforeach
                            </div>
                        @endif
                    </ul>
                </div>

                <!-- Email Address -->
                <div class="input">
                    <label>アカウント名（ユーザーＩＤ）または、メールアドレス</label>
                    <br>
                    <input class="form" type="text" name="email_or_id">
                </div>

                <!-- Password -->
                <div class="input">
                    <label>パスワード</label>
                    <br>
                    <input class="form" type="password" name="password">
                </div>

                <div class="button">
                    <a href="{{ route('register') }}" class="btn btn-primary">新規登録</a>
                    <button type="submit" class="btn btn-primary">ログイン</button>
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
