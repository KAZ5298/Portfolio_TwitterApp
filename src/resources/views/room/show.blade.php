<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/message.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/room.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700&display=swap">
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
                    <img src="{{ asset('storage/images/' . $loginUser->icon) }}">
                @endif
            </div>
            <div class="loginUser">ログイン中：{{ $loginUser->nickname }} さん</div>
            <div class="userMenu">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        ユーザーメニュー
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">ユーザー情報編集</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="{{ route('followList') }}">フォロー一覧</a></li>
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
        <nav class="navbar">
            <a class="navbar-name"><span>{{ $rooms->user->nickname }}さんとのトークルーム</span></a>
            <a class="navbar-button btn btn-secondary" href="{{ route('talkRoom') }}">一覧へ戻る</a>
        </nav>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            <form action="{{ route('messagePost', $rooms) }}" method="POST">
                @csrf
                <div class="messagepost">
                    <textarea class="message" name="message" placeholder="メッセージは１００文字以下で入力してください。">{{ old('message') }}</textarea>
                    <button type="submit" class="btn btn-primary">投稿</button>
                </div>
            </form>

            @if ($errors->any())
                <div class="error-message bg-danger-subtle">
                    @foreach ($errors->all() as $message)
                        {{ $message }}
                    @endforeach
                </div>
            @endif

            @if (session('message'))
                <div class="success-message bg-success-subtle">
                    {{ session('message') }}
                </div>
            @endif

            <div class="kaiwa line">
                <div class="profile">
                    <div class="followIcon">
                        <img src="{{ asset('storage/images/' . $rooms->user->icon) }}" width="100" height="100">
                    </div>
                    <div class="followName">
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
