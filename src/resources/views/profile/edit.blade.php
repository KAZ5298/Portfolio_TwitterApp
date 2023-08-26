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
            <form method="POST" action="{{ route('profileCheck') }}" enctype="multipart/form-data">
                @csrf

                <label>下記の項目を入力してください。<span style="color:red">（※項目は入力必須）</span></label>

                <!-- Name -->
                <div>
                    <label>アカウント名（ユーザーＩＤ）<span style="color:red">※</span></label>
                    <input type="text" name="name" value="{{ $user->name }}">
                </div>

                <!-- Email Address -->
                <div>
                    <label>メールアドレス <span style="color:red">※</span></label>
                    <input type="email" name="email" value="{{ $user->email }}">
                </div>

                <!-- Nick Name -->
                <div>
                    <label>ニックネーム（一覧画面での表示名）<span style="color:red">※</span></label>
                    <input type="text" name="nickname" value="{{ $user->nickname }}">
                </div>

                <!-- Profile Icon -->
                <div>
                    <label>プロフィール画像</label>
                    @if (isset($user->icon))
                        <img src="{{ asset('storage/images/' . $user->icon) }}" width="80" height="80">
                    @else
                        <label>登録なし</label>
                    @endif
                    <br>
                    <input type="file" name="icon">
                </div>

                <!-- Password -->
                <div>
                    <label>パスワード <span style="color:red">※</span></label>
                    <input type="password" name="password">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label>パスワード（再確認）<span style="color:red">※</span></label>
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
