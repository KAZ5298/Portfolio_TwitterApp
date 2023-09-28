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
                <li class="nav-item"><a href="{{ route('allTweetGet') }}"><span class="material-symbols-outlined">
                            home
                        </span><span>全てのつぶやき</span></a></li>
                <li class="nav-item"><a href="{{ route('myTweetGet') }}"><span class="material-symbols-outlined">
                            person
                        </span><span>自分のつぶやき</span></a></li>
                <li class="nav-item"><a href="{{ route('followTweetGet') }}"><span class="material-symbols-outlined">
                            handshake
                        </span><span>フォローした人のつぶやき</span></a></li>
                <li class="nav-item"><a href="{{ route('favoriteList') }}"><span class="material-symbols-outlined">
                            volunteer_activism
                        </span><span>いいねしたつぶやき</span></a></li>
                <li class="nav-item current"><a href="{{ route('talkRoom') }}"><span class="material-symbols-outlined">
                            communication
                        </span><span>トークルーム</span></a></li>
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
                            <img src="{{ asset('storage/images/' . $room->user->icon) }}" width="100"
                                height="100">
                        @endif
                    </div>
                    <div class="roomLink">
                        <a href="{{ route('talkRoomShow', $room->id) }}">{{ $room->user->nickname }}さんとのトークルーム</a>
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
