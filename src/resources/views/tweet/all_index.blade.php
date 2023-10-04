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
    <link rel="stylesheet" href="{{ asset('/css/tweet.css') }}">
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
        <nav class="navigation">
            <ul>
                <li class="nav-item current">
                    <a class="nav-name-sp">全て</a>
                    <a href="{{ route('allTweetGet') }}">
                        <span class="material-symbols-outlined icon">groups</span>
                        <span class="nav-name">全てのツイート</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-name-sp">自分</a>
                    <a href="{{ route('myTweetGet') }}">
                        <span class="material-symbols-outlined icon">person</span>
                        <span class="nav-name">自分のツイート</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-name-sp">フォロー</a>
                    <a href="{{ route('followTweetGet') }}">
                        <span class="material-symbols-outlined icon">person_add</span>
                        <span class="nav-name">フォローした人のツイート</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-name-sp">いいね</a>
                    <a href="{{ route('favoriteList') }}">
                        <span class="material-symbols-outlined icon">volunteer_activism</span>
                        <span class="nav-name">いいねしたツイート</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-name-sp">チャット</a>
                    <a href="{{ route('talkRoom') }}">
                        <span class="material-symbols-outlined icon">chat</span>
                        <span class="nav-name">チャットルーム</span>
                    </a>
                </li>
            </ul>
        </nav>
        <form action="{{ route('tweetPost') }}" method="POST">
            @csrf
            <div class="tweetpost">
                <textarea class="tweet" name="content" placeholder="ツイートは１００文字以下で入力してください。">{{ old('content') }}</textarea>
                <button type="submit" class="btn btn-primary">
                    <span class="material-symbols-outlined tp">input</span>
                </button>
            </div>
        </form>
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

            @foreach ($tweets as $tweet)
                <div class="tweetContainer">
                    <div class="tweetIcon">
                        @if ($tweet->user->icon)
                            <img src="{{ asset('storage/images/' . $tweet->user->icon) }}">
                        @endif
                    </div>
                    <div class="tweetNickname">
                        {{ $tweet->user->nickname }}
                        <br>
                        @if ($loginUser->isFollowed($tweet->user->id))
                            <div class="followed">
                                フォローされています
                            </div>
                        @endif
                    </div>
                    <div class="tweetButton">
                        @if ($tweet->user->id != $loginUser->id)
                            @if ($loginUser->isFollowing($tweet->user->id))
                                <form action="{{ route('unfollow', $tweet->user->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    @if ($loginUser->checkMessageInTalkRoom($loginUser->id, $tweet->user->id))
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('チャットルームのメッセージが削除されます。よろしいですか？');">
                                            <span class="material-symbols-outlined tb">person_remove</span>
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-danger">
                                            <span class="material-symbols-outlined tb">person_remove</span>
                                        </button>
                                    @endif
                                </form>
                            @else
                                <form action="{{ route('follow', $tweet->user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <span class="material-symbols-outlined tb">person_add</span>
                                    </button>
                                </form>
                            @endif
                            @if ($tweet->isFavorite($loginUser->id, $tweet->id))
                                <form action="{{ route('unfavorite', $tweet) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">
                                        <span class="material-symbols-outlined tb">thumb_down</span>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('favorite', $tweet) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <span class="material-symbols-outlined tb">thumb_up</span>
                                    </button>
                                </form>
                            @endif
                        @else
                            <form action="{{ route('tweetDestroy', $tweet) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">
                                    <span class="material-symbols-outlined tb">delete</span>
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="tweetContent">
                        {{ $tweet->content }}
                    </div>
                    <div class="tweetTime">
                        {{ $tweet->created_at }}
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
