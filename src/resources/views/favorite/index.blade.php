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
    <link rel="stylesheet" href="{{ asset('/css/favorite.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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
                            <span class="material-symbols-outlined nav-icon">groups</span>
                            <p class="nav-name-pc">全てのツイート</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('myTweetGet') }}">
                        <div class="nav-item">
                            <p class="nav-name-sp">自分</p>
                            <span class="material-symbols-outlined nav-icon">person</span>
                            <p class="nav-name-pc">自分のツイート</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('followTweetGet') }}">
                        <div class="nav-item">
                            <p class="nav-name-sp">フォロー</p>
                            <span class="material-symbols-outlined nav-icon">person_add</span>
                            <p class="nav-name-pc">フォローした人のツイート</p>
                        </div>
                    </a>
                </li>
                <li class="current">
                    <a href="{{ route('favoriteList') }}">
                        <div class="nav-item current">
                            <p class="nav-name-sp">いいね</p>
                            <span class="material-symbols-outlined nav-icon">volunteer_activism</span>
                            <p class="nav-name-pc">いいねしたツイート</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('talkRoom') }}">
                        <div class="nav-item">
                            <p class="nav-name-sp">チャット</p>
                            <span class="material-symbols-outlined nav-icon">chat</span>
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

            @foreach ($favorites as $favorite)
                <div class="favoriteContainer">
                    <div class="favoriteIcon">
                        @if ($favorite->user->icon)
                            <img src="{{ asset('storage/images/' . $favorite->user->icon) }}">
                        @endif
                    </div>
                    <div class="favoriteUser">
                        <div class="favoriteNickname">
                            {{ $favorite->user->nickname }}
                        </div>
                        <div class="favoriteAccount">
                            {{ $favorite->user->name }}
                        </div>
                    </div>
                    <div class="favoriteFollow">
                        @if ($loginUser->isFollowing($favorite->user->id) && $loginUser->isFollowed($favorite->user->id))
                            <div class="mutual-follow">
                                <span class="material-symbols-outlined fb">handshake</span>
                                <span class="mutual-follow-fb">相互フォローです</span>
                            </div>
                        @elseif(!$loginUser->isFollowing($favorite->user->id) && $loginUser->isFollowed($favorite->user->id))
                            <div class="followed"><span class="material-symbols-outlined fb"> front_hand </span>
                                <span class="followed-fb">フォローされています</span>
                            </div>
                        @endif
                    </div>
                    <div class="favoriteButton">
                        @if ($loginUser->isFollowing($favorite->user->id))
                            <div class="unfollow-btn">
                                <form action="{{ route('unfollow', $favorite->user->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    @if ($loginUser->checkMessageInTalkRoom($loginUser->id, $favorite->user->id))
                                        <button type="submit" class="btn unfollow"
                                            onclick="return confirm('チャットルームのメッセージが削除されます。よろしいですか？');">
                                            <span class="material-symbols-outlined fb">person_remove</span>
                                            <span class="icon-name">フォロー解除</span>
                                        </button>
                                    @else
                                        <button type="submit" class="btn unfollow">
                                            <span class="material-symbols-outlined fb">person_remove</span>
                                            <span class="icon-name">フォロー解除</span>
                                        </button>
                                    @endif
                                </form>
                            </div>
                        @else
                            <div class="follow-btn">
                                <form action="{{ route('follow', $favorite->user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <span class="material-symbols-outlined fb">person_add</span>
                                        <span class="icon-name">フォロー</span>
                                    </button>
                                </form>
                            </div>
                        @endif
                        @if ($favorite->isFavorite($loginUser->id, $favorite->id))
                            <div class="unfavorite-btn">
                                <form action="{{ route('unfavorite', $favorite) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn unfavorite">
                                        <span class="material-symbols-outlined fb">thumb_down</span>
                                        <span class="icon-name">いいね解除</span>
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="favorite-btn">
                                <form action="{{ route('favorite', $favorite) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <span class="material-symbols-outlined fb">thumb_up</span>
                                        <span class="icon-name">いいね</span>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <div class="favoriteContent">
                        {{ $favorite->content }}
                    </div>
                    <div class="favoriteTime">
                        {{ $favorite->created_at }}
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
