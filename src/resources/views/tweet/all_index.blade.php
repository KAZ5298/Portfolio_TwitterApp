<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/tweet.css') }}">
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
        <div class="nav-tabs">
            <ul class="nav nav-tabs justify-content-center nav-fill" id="myTab" role="tablist">
                <a class="nav-link nav-item active" aria-current="page" href="{{ route('allTweetGet') }}">全てのつぶやき</a>
                <a class="nav-link nav-item" href="{{ route('myTweetGet') }}">自分のつぶやき</a>
                <a class="nav-link nav-item" href="{{ route('followerTweetGet') }}">フォロワーのつぶやき</a>
                <a class="nav-link nav-item" href="{{ route('talkRoom') }}">トークルーム</a>
            </ul>
        </div>
        <form action="{{ route('tweetPost') }}" method="POST">
            @csrf
            <div class="tweetpost">
                <textarea class="tweet" name="content" placeholder="つぶやきは１００文字以下で入力してください。"></textarea>
                <button type="submit" class="btn btn-primary">つぶやく</button>
            </div>
        </form>
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

            @foreach ($tweets as $tweet)
                <div class="tweetContainer">
                    <div class="tweetIcon">
                        @if ($tweet->user->icon)
                            <img src="{{ asset('storage/images/' . $tweet->user->icon) }}" width="100"
                                height="100">
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
                                        <input type="submit" class="btn btn-danger"
                                            onclick="return confirm('トークルームのメッセージが削除されます。よろしいですか？');" value="フォロー解除">
                                    @else
                                        <input type="submit" class="btn btn-danger" value="フォロー解除">
                                    @endif
                                </form>
                            @else
                                <form action="{{ route('follow', $tweet->user->id) }}" method="POST">
                                    @csrf
                                    <input type="submit" class="btn btn-primary" value="フォローする">
                                </form>
                            @endif
                            @if ($tweet->isFavorite($loginUser->id, $tweet->id))
                                <form action="{{ route('unfavorite', $tweet) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-danger" value="いいね解除">
                                </form>
                            @else
                                <form action="{{ route('favorite', $tweet) }}" method="POST">
                                    @csrf
                                    <input type="submit" class="btn btn-primary" value="いいね">
                                </form>
                            @endif
                        @else
                            <form action="{{ route('tweetDestroy', $tweet) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="削除">
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
