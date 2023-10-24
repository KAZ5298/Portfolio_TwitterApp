<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/message.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/follow.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@30,400,0,0">
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
                {{-- ＰＣ対応 --}}
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        ユーザーメニュー
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">ユーザー情報編集</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('followList') }}">フォロー一覧</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout').submit();">ログアウト</a>
                            <form id="logout" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                {{-- スマホ対応 --}}
                <nav class="navbar bg-primary">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="offcanvas offcanvas-end text-bg-primary" tabindex="-1" id="offcanvasDarkNavbar"
                            aria-labelledby="offcanvasDarkNavbarLabel">
                            <div class="offcanvas-header">
                                <p class="offcanvas-title" id="offcanvasDarkNavbarLabel">ユーザーメニュー</p>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav justify-content-end">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('profile.edit') }}">ユーザー情報編集</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('followList') }}">フォロー一覧</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout').submit();">ログアウト</a>
                                        <form id="logout" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <nav class="navbar-follow">
            <ul>
                <li class="nav-item-follow name">
                    <a class="navbar-follow-name">
                        <p>フォロー一覧</p>
                    </a>
                </li>
                <li class="nav-item-follow btn">
                    <a class="navbar-follow-btn btn btn-secondary" href="{{ route('allTweetGet') }}">
                        <p class="material-symbols-outlined navbar-follow-btn"> undo </p>
                        <p class="navbar-follow-btn-name">ＴＯＰ画面へ戻る</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
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

            @foreach ($follows as $follow)
                <div class="followContainer">
                    <div class="followIcon">
                        @if ($follow->icon)
                            <img src="{{ asset('storage/images/' . $follow->icon) }}">
                        @endif
                    </div>
                    <div class="followUser">
                        <div class="followNickname">
                            {{ $follow->nickname }}
                        </div>
                        <div class="followAccount">
                            {{ $follow->name }}
                        </div>
                    </div>
                    <div class="followFollow">
                        @if ($loginUser->isFollowing($follow->id) && $loginUser->isFollowed($follow->id))
                            <div class="mutual-follow">
                                <p class="material-symbols-outlined">handshake</p>
                                <p class="mutual-follow-fb">相互フォローです</p>
                            </div>
                        @endif
                    </div>
                    <div class="followButton">
                        @if ($loginUser->isFollowing($follow->id))
                            <div class="unfollow-btn">
                                <form action="{{ route('unfollow', $follow->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    @if ($loginUser->checkMessageInTalkRoom($loginUser->id, $follow->id))
                                        <button type="submit" class="btn unfollow"
                                            onclick="return confirm('チャットルームのメッセージが削除されます。よろしいですか？');">
                                            <p class="material-symbols-outlined">person_remove</p>
                                            <p class="icon-name">フォロー解除</p>
                                        </button>
                                    @else
                                        <button type="submit" class="btn unfollow">
                                            <p class="material-symbols-outlined">person_remove</p>
                                            <p class="icon-name">フォロー解除</p>
                                        </button>
                                    @endif
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
