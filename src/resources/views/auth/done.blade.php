<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/done_view.css') }}">
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
            <div class="done bg-success-subtle">
                <label class="done">登録が完了しました。</label>
            </div>

            <div class="button">
                <a href="{{ route('loginRedirect', $user) }}"class="btn btn-primary">
                    <span class="material-symbols-outlined"> login </span>
                    <span class="btn-name">ログインして一覧画面へ</span>
                </a>
                <a href="{{ route('login') }}"class="btn btn-secondary">
                    <span class="material-symbols-outlined navbar-follow-btn"> undo </span>
                    <span class="btn-name">ログイン画面へ戻る</span>
                </a>
            </div>
        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
