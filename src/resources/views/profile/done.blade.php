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
            <div class="border px-4 py-3 rounded relative bg-success-subtle">
                <label class="text-align: center;">修正が完了しました。</label>
            </div>

            <div class="d-grid gap-2">
                <a href="{{ route('allTweetGet') }}"class="btn btn-primary">ＴＯＰ画面へ戻る</a>
            </div>

        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
