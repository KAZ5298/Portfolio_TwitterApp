<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/register_view.css') }}">
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
            <form method="POST" action="{{ route('registerCheck') }}" enctype="multipart/form-data">
                @csrf

                <div class="input guide">
                    <label>下記の項目を入力してください。<span style="color:red">（※項目は入力必須）</span></label>
                </div>

                <!-- Name -->
                <div class="input name">
                    <label for="name">アカウント名（ユーザーＩＤ）</label>
                    @if (!$errors->has('name'))
                        <input id="name" class="form normal" type="text" name="name"
                            value="{{ old('name') }}" placeholder="※">
                    @else
                        <input id="name" class="form error" type="text" name="name"
                            value="{{ old('name') }}" placeholder="※">
                        @foreach ($errors->get('name') as $message)
                            <label class="error-msg">{{ $message }}</label>
                        @endforeach
                    @endif
                </div>

                <!-- Email Address -->
                <div class="input email">
                    <label for="email">メールアドレス</label>
                    @if (!$errors->has('email'))
                        <input id="email" class="form normal" type="text" name="email"
                            value="{{ old('email') }}" placeholder="※">
                    @else
                        <input id="email" class="form error" type="text" name="email"
                            value="{{ old('email') }}" placeholder="※">
                        @foreach ($errors->get('email') as $message)
                            <label class="error-msg">{{ $message }}</label>
                        @endforeach
                    @endif
                </div>

                <!-- Nick Name -->
                <div class="input nickname">
                    <label for="nickname">ニックネーム（一覧画面での表示名）</label>
                    @if (!$errors->has('nickname'))
                        <input id="nickname" class="form normal" type="text" name="nickname"
                            value="{{ old('nickname') }}" placeholder="※">
                    @else
                        <input id="nickname" class="form error" type="text" name="nickname"
                            value="{{ old('nickname') }}" placeholder="※">
                        @foreach ($errors->get('nickname') as $message)
                            <label class="error-msg">{{ $message }}</label>
                        @endforeach
                    @endif
                </div>

                <!-- Profile Icon -->
                <div class="input icon">
                    <label for="icon">プロフィール画像</label>
                    <br>
                    <input id="icon" type="file" name="icon" class="icon">
                </div>

                <!-- Password -->
                <div class="input password">
                    <label for="password">パスワード</label>
                    @if (!$errors->has('password'))
                        <input id="password" class="form normal" type="password" name="password" placeholder="※">
                    @else
                        <input id="password" class="form error" type="password" name="password" placeholder="※">
                        @foreach ($errors->get('password') as $message)
                            <label class="error-msg">{{ $message }}</label>
                        @endforeach
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="input password">
                    <label for="password_confirmation">パスワード（再確認）</label>
                    <input id="password_confirmation" class="form normal" type="password_confirmation"
                        name="password_confirmation" placeholder="※">
                </div>

                <div class="button">
                    <button type="submit" class="btn btn-primary">
                        <span class="material-symbols-outlined"> how_to_reg </span>
                        <span class="btn-name">登録</span>
                    </button>
                    <a href="/register" class="btn btn-danger">
                        <span class="material-symbols-outlined"> restart_alt </span>
                        <span class="btn-name">リセット</span>
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-secondary">
                        <span class="material-symbols-outlined navbar-follow-btn"> undo </span>
                        <span class="btn-name">ログイン画面へ戻る</span>
                    </a>
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
