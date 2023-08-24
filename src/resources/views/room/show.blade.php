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
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                @if ($loginUser->icon)
                    <img src="{{ asset('storage/images/' . $loginUser->icon) }}" width="80" height="80">
                @endif
                <h2>ログイン中：{{ $loginUser->nickname }}</h2>
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    ユーザーメニュー
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">ユーザー情報編集</a></li>
                                    <li><a class="dropdown-item" href="{{ route('followerList') }}">フォロワー一覧</a></li>
                                    <li><a class="dropdown-item">
                                            <form method="POST" action="{{ route('logout') }}"> @csrf
                                                <input type="submit" value="ログアウト">
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand">{{ $rooms->user->nickname }}さんとのトークルーム</a>
                </div>
            </nav>
        </div>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            <div class="kaiwa line">
                <img src="{{ asset('storage/images/' . $rooms->user->icon) }}" width="80" height="80">
                {{ $rooms->user->nickname }}
                <img src="{{ asset('storage/images/' . $loginUser->icon) }}" width="80" height="80">
                {{ $loginUser->nickname }}
                @foreach ($messages as $message)
                    @if ($message->user_id == $loginUser->id)
                        <div class="fukidasi right">
                            {{ $message->message }}
                        </div>
                    @else
                        <div class="fukidasi left">
                            {{ $message->message }}
                        </div>
                    @endif
                @endforeach
            </div>
            <form action="{{ route('messagePost', $rooms->id) }}" method="POST">
                @csrf
                <textarea name="message"></textarea>
                <input type="submit" value="つぶやく">
            </form>
            <a href="{{ route('talkRoom') }}">戻る</a>
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
