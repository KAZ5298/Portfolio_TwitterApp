<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/register_check_view.css') }}">
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

                <div class="border px-4 py-3 rounded relative bg-warning-subtle">
                    <label>上記の内容で登録します。よろしいですか？</label>
                </div>

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
