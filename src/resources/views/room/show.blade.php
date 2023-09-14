<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/room.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap">
</head>

<body class="bg-primary-subtle">

    {{--  ヘッダー --}}
    <div class="header bg-primary">
        <div class="container">
            <div class="title">
                Twitter Modoki
            </div>
            <div class="userIcon">
                @if ($loginUser->icon)
                    <img src="{{ asset('storage/images/' . $loginUser->icon) }}" width="100" height="100">
                @endif
            </div>
            <div class="loginUser">ログイン中：{{ $loginUser->nickname }}</div>
            <div class="userMenu">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        ユーザーメニュー
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">ユーザー情報編集</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="{{ route('followerList') }}">フォロワー一覧</a></li>
                        <hr class="dropdown-divider">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout').submit();">ログアウト</a>
                            <form id="logout" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand">{{ $rooms->user->nickname }}さんとのトークルーム</a>
            </div>
            <div class="container-fluid">
                <a class="navbar-brand btn btn-secondary" href="{{ route('talkRoom') }}">一覧へ戻る</a>
            </div>
        </nav>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            @if ($errors->any())
                <div class="border px-4 py-3 rounded relative bg-danger-subtle">
                    @foreach ($errors->all() as $message)
                        {{ $message }}
                    @endforeach
                </div>
            @endif

            @if (session('message'))
                <div class="border px-4 py-3 rounded relative bg-success-subtle">
                    {{ session('message') }}
                </div>
            @endif

            <form action="{{ route('messagePost', $rooms) }}" method="POST">
                @csrf
                <div class="messagepost">
                    <textarea class="message" name="message" placeholder="メッセージは１００文字以下で入力してください。"></textarea>
                    <button type="submit" class="btn btn-primary">投稿</button>
                </div>
            </form>

            <div class="kaiwa line mt-4">
                <div class="profile">
                    <div class="followerIcon">
                        <img src="{{ asset('storage/images/' . $rooms->user->icon) }}" width="100" height="100">
                    </div>
                    <div class="followerName">
                        {{ $rooms->user->nickname }}
                    </div>
                    <div class="loginUserIcon">
                        <img src="{{ asset('storage/images/' . $loginUser->icon) }}" width="100" height="100">
                    </div>
                    <div class="loginUserName">
                        {{ $loginUser->nickname }}
                    </div>
                </div>
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
        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
