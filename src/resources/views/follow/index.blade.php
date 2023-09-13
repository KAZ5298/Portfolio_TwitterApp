<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/follow.css') }}">
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
                <a class="navbar-brand">フォロワー一覧</a>
            </div>
            <div class="container-fluid">
                <a class="navbar-brand btn btn-secondary" href=""
                    onclick="javascript:history.back(); return false;">ＴＯＰ画面へ戻る</a>
            </div>
        </nav>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            @foreach ($followers as $follower)
                <div class="followerContainer">
                    <div class="followerIcon">
                        @if ($follower->icon)
                            <img src="{{ asset('storage/images/' . $follower->icon) }}" width="100" height="100">
                        @endif
                    </div>
                    <div class="followerNickname">
                        {{ $follower->nickname }}
                        <br>
                        @if ($loginUser->isFollowed($follower->id))
                            <div class="followed">
                                フォローされています
                            </div>
                        @endif
                    </div>
                    <div class="followerButton">
                        @if ($loginUser->isFollowing($follower->id))
                            <form action="{{ route('unfollow', $follower->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                @if ($loginUser->checkMessageInTalkRoom($loginUser->id, $follower->id))
                                    <input type="submit" class="btn btn-danger"
                                        onclick="return confirm('トークルームのメッセージが削除されます。よろしいですか？');" value="フォロー解除">
                                @else
                                    <input type="submit" class="btn btn-danger" value="フォロー解除">
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
