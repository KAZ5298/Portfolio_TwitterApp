<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    {{--  ヘッダー --}}
    <div class="header">
        <div class="container">
            <h1>Twitter Modoki</h1>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <h2>ログイン中：{{ $loginUser->nickname }}</h2>
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    ユーザーメニュー
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">ユーザー情報編集</a></li>
                                    <li><a class="dropdown-item" href="{{ route('followerList') }}">フォロワー一覧</a></li>
                                    <li><a class="dropdown-item" href="#">ログアウト</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('allTweetGet') }}">全てのつぶやき</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('myTweetGet') }}">自分のつぶやき</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('followerTweetGet') }}">フォロワーのつぶやき</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('talkRoom') }}">トークルーム</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </div>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            <table>
                @foreach ($tweets as $tweet)
                    <tr>
                        <td>投稿者：{{ $tweet->user->nickname }}
                            @if ($loginUser->isFollowed($tweet->user->id))
                                フォローされています
                            @endif
                        </td>
                        @if ($tweet->user->id != $loginUser->id)
                            @if ($loginUser->isFollowing($tweet->user->id))
                                <form action="{{ route('unfollow', $tweet->user->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <td><input type="submit" value="フォロー解除"></td>
                                </form>
                            @else
                                <form action="{{ route('follow', $tweet->user->id) }}" method="POST">
                                    @csrf
                                    <td><input type="submit" value="フォローする"></td>
                                </form>
                            @endif
                            @if ($tweet->isFavorite($loginUser->id, $tweet->id))
                                <form action="{{ route('unfavorite', $tweet) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <td><input type="submit" value="いいね解除"></td>
                                </form>
                            @else
                                <form action="{{ route('favorite', $tweet) }}" method="POST">
                                    @csrf
                                    <td><input type="submit" value="いいね"></td>
                                </form>
                            @endif
                        @else
                            <form action="{{ route('tweetDestroy', $tweet) }}" method="POST">
                                @csrf
                                @method('delete')
                                <td><input type="submit" value="削除"></td>
                            </form>
                        @endif
                    </tr>
                    <tr>
                        <td>投稿内容：{{ $tweet->content }}</td>
                    </tr>
                    <tr>
                        <td>投稿日時：{{ $tweet->created_at }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">
        <div class="container">
            @if (!$followerFlg)
                <form action="{{ route('tweetPost') }}" method="POST">
                    @csrf
                    <textarea name="content"></textarea>
                    <input type="submit" value="つぶやく">
                </form>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
