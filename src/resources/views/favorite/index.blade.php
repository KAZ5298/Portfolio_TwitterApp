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
                    <img src="{{ asset('storage/images/' . $loginUser->icon) }}" width="100" height="100">
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
        <nav>
            <ul>
                <li class="nav-item"><a href="{{ route('allTweetGet') }}"><span class="material-symbols-outlined nav">
                            groups
                        </span><span>全てのツイート</span></a></li>
                <li class="nav-item"><a href="{{ route('myTweetGet') }}"><span class="material-symbols-outlined nav">
                            person
                        </span><span>自分のツイート</span></a></li>
                <li class="nav-item"><a href="{{ route('followTweetGet') }}"><span
                            class="material-symbols-outlined nav">
                            person_add
                        </span><span>フォローしている人のツイート</span></a></li>
                <li class="nav-item current"><a href="{{ route('favoriteList') }}"><span
                            class="material-symbols-outlined nav">
                            volunteer_activism
                        </span><span>いいねしたツイート</span></a></li>
                <li class="nav-item"><a href="{{ route('talkRoom') }}"><span class="material-symbols-outlined nav">
                            chat
                        </span><span>チャットルーム</span></a></li>
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
                            <img src="{{ asset('storage/images/' . $favorite->user->icon) }}" width="100"
                                height="100">
                        @endif
                    </div>
                    <div class="favoriteNickname">
                        {{ $favorite->user->nickname }}
                        <br>
                        @if ($loginUser->isFollowed($favorite->user->id))
                            <div class="followed">
                                フォローされています
                            </div>
                        @endif
                    </div>
                    <div class="favoriteButton">
                        @if ($loginUser->isFollowing($favorite->user->id))
                            <form action="{{ route('unfollow', $favorite->user->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                @if ($loginUser->checkMessageInTalkRoom($loginUser->id, $favorite->user->id))
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('チャットルームのメッセージが削除されます。よろしいですか？');"><i
                                            class="material-symbols-outlined fb">person_remove</i></button>
                                @else
                                    <button type="submit" class="btn btn-danger"><i
                                            class="material-symbols-outlined fb">person_remove</i></button>
                                @endif
                            </form>
                        @else
                            <form action="{{ route('follow', $favorite->user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary"><i
                                        class="material-symbols-outlined fb">person_add</i></button>
                            </form>
                        @endif
                        @if ($favorite->isFavorite($loginUser->id, $favorite->id))
                            <form action="{{ route('unfavorite', $favorite) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"><i
                                        class="material-symbols-outlined fb">thumb_down</i></button>
                            </form>
                        @else
                            <form action="{{ route('favorite', $favorite) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary"><i
                                        class="material-symbols-outlined fb">thumb_up</i></button>
                            </form>
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
