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
            <form method="POST" action="{{ route('profileCheck') }}" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div>
                    <p>アカウント名（ユーザーＩＤ）</p>
                    <input type="text" name="name" value="{{ $user->name }}">
                </div>

                <!-- Email Address -->
                <div>
                    <p>メールアドレス</p>
                    <input type="email" name="email" value="{{ $user->email }}">
                </div>

                <!-- Nick Name -->
                <div>
                    <p>ニックネーム（一覧画面での表示名）</p>
                    <input type="text" name="nickname" value="{{ $user->nickname }}">
                </div>

                <!-- Profile Icon -->
                <div>
                    <p>プロフィール画像</p>
                    @if (isset($user->icon))
                        <img src="{{ asset('storage/images/' . $user->icon) }}" width="80" height="80">
                    @else
                        <p>登録なし</p>
                    @endif
                    <br>
                    <input type="file" name="icon">
                </div>

                <!-- Password -->
                <div>
                    <p>パスワード</p>
                    <input type="password" name="password">
                </div>

                <!-- Confirm Password -->
                <div>
                    <p>パスワード（再確認）</p>
                    <input type="password" name="password_confirmation">
                </div>


                <button type="submit" class="btn btn-primary">登録</button>
                <button type="reset" class="btn btn-danger">リセット</button>
                <a href="{{ route('allTweetGet') }}" class="btn btn-secondary">ＴＯＰ画面へ戻る</a>
            </form>
        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
