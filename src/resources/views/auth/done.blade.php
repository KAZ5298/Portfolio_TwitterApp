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
            <h1>登録が完了しました。</h1>

            <div class="d-grid gap-2">
                <a href="{{ route('loginRedirect', $user) }}"class="btn btn-primary">ログインして一覧画面へ</a>
                <a href="{{ route('login') }}"class="btn btn-secondary">ログイン画面へ戻る</a>
            </div>

        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
