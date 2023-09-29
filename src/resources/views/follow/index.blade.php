<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/header.css') }}">
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
            <a class="navbar-name"><span>フォロー一覧</span></a>
            <a class="navbar-button btn btn-secondary" href="{{ route('allTweetGet') }}">ＴＯＰ画面へ戻る</a>
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
                            <img src="{{ asset('storage/images/' . $follow->icon) }}" width="100" height="100">
                        @endif
                    </div>
                    <div class="followNickname">
                        {{ $follow->nickname }}
                        <br>
                        @if ($loginUser->isFollowed($follow->id))
                            <div class="followed">
                                フォローされています
                            </div>
                        @endif
                    </div>
                    <div class="followButton">
                        @if ($loginUser->isFollowing($follow->id))
                            <form action="{{ route('unfollow', $follow->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                @if ($loginUser->checkMessageInTalkRoom($loginUser->id, $follow->id))
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('トークルームのメッセージが削除されます。よろしいですか？');"><i
                                            class="material-symbols-outlined fb">person_remove</i></button>
                                @else
                                    <button type="submit" class="btn btn-danger"><i
                                            class="material-symbols-outlined fb">person_remove</i></button>
                                @endif
                            </form>
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
