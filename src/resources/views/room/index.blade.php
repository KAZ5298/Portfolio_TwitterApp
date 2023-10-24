<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/room.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
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
        <nav class="navigation">
            <ul>
                <li>
                    <a href="{{ route('allTweetGet') }}">
                        <div class="nav-item">
                            <p class="nav-name-sp">全て</p>
                            <p class="material-symbols-outlined nav-icon">group</p>
                            <p class="nav-name-pc">全てのツイート</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('myTweetGet') }}">
                        <div class="nav-item">
                            <p class="nav-name-sp">自分</p>
                            <p class="material-symbols-outlined nav-icon">person</p>
                            <p class="nav-name-pc">自分のツイート</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('followTweetGet') }}">
                        <div class="nav-item">
                            <p class="nav-name-sp">フォロー</p>
                            <p class="material-symbols-outlined nav-icon">person_add</p>
                            <p class="nav-name-pc">フォローした人のツイート</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('favoriteList') }}">
                        <div class="nav-item">
                            <p class="nav-name-sp">いいね</p>
                            <p class="material-symbols-outlined nav-icon">volunteer_activism</p>
                            <p class="nav-name-pc">いいねしたツイート</p>
                        </div>
                    </a>
                </li>
                <li class="current">
                    <a href="{{ route('talkRoom') }}">
                        <div class="nav-item current">
                            <p class="nav-name-sp">チャット</p>
                            <p class="material-symbols-outlined nav-icon">chat</p>
                            <p class="nav-name-pc">チャットルーム</p>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            @foreach ($rooms as $room)
                <div class="roomContainer">
                    <div class="roomIcon">
                        @if ($room->user->icon)
                            <img src="{{ asset('storage/images/' . $room->user->icon) }}">
                        @endif
                    </div>
                    <div class="roomUser">
                        <div class="roomNickname">
                            {{ $room->user->nickname }}
                        </div>
                        <div class="roomAccount">
                            {{ $room->user->name }}
                        </div>
                    </div>
                    <div class="roomLink">
                        <a class="enter-btn btn btn-primary" href="{{ route('talkRoomShow', $room->id) }}">
                            <p class="material-symbols-outlined icon">login</p>
                            <p class="icon-name">入室する</p>
                        </a>
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
