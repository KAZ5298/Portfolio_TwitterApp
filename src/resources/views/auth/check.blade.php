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

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <p>アカウント名（ユーザーＩＤ）：{{ $user->name }}</p>
                </div>

                <!-- Email Address -->
                <div>
                    <p>メールアドレス：{{ $user->email }}</p>
                </div>

                <!-- Nick Name -->
                <div>
                    <p>ニックネーム（一覧画面での表示名）：{{ $user->nickname }}</p>
                </div>

                <!-- Profile Icon -->
                <div>
                    {{-- <p>プロフィール画像：<img src="{{ asset('storage/images/' . $user->icon) }}" width="80" height="80"></p> --}}
                </div>

                <!-- Password -->
                {{-- <div>
                    <p>メールアドレス：{{ $user->password }}</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <p>メールアドレス：{{ $user->password_confirmation }}</p>
                </div> --}}

                <input type="submit" value="はい">

                {{-- <a href="{{ route('registerCheck') }}">登録</a> --}}
                <a href="#">いいえ</a>
                <a href="{{ route('login') }}">ログイン画面へ戻る</a>

            </form>
        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
