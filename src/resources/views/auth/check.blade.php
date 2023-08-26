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
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <label>アカウント名（ユーザーＩＤ）：{{ $user->name }}</label>
                    <input type="hidden" name="name" value="{{ $user->name }}">
                </div>

                <!-- Email Address -->
                <div>
                    <label>メールアドレス：{{ $user->email }}</label>
                    <input type="hidden" name="email" value="{{ $user->email }}">
                </div>

                <!-- Nick Name -->
                <div>
                    <label>ニックネーム（一覧画面での表示名）：{{ $user->nickname }}</label>
                    <input type="hidden" name="nickname" value="{{ $user->nickname }}">
                </div>

                <!-- Profile Icon -->
                <div>
                    @if (isset($icon))
                        <label>プロフィール画像：<img src="{{ asset('storage/images/' . $icon) }}" width="80" height="80"></label>
                    @else
                        <label>プロフィール画像：登録なし</label>
                    @endif
                    <input type="hidden" name="icon" value="{{ $icon }}">
                </div>

                <!-- Password -->
                <div>
                    <input type="hidden" name="password" value="{{ $user->password }}">
                </div>

                <!-- Confirm Password -->
                <div>
                    <input type="hidden" name="password_confirmation" value="{{ $user->password_confirmation }}">
                </div>

                <label>上記の内容で登録します。よろしいですか？</label>

                <button type="submit" class="btn btn-primary">はい</button>
                <a href="{{ route('register') }}" class="btn btn-danger">いいえ</a>
                <a href="{{ route('login') }}" class="btn btn-secondary">ログイン画面へ戻る</a>

            </form>
        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
