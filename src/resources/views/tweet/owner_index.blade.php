<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
</head>

<body>

    {{--  ヘッダー --}}
    <div class="header">
        <div class="container">
            <h1>Twitter Modoki</h1>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                @if ($loginUser->icon)
                    <img src="{{ asset('storage/images/' . $loginUser->icon) }}" width="80" height="80">
                @endif
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
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">ユーザー情報編集</a></li>
                                    <li><a class="dropdown-item" href="{{ route('followerList') }}">フォロワー一覧</a></li>
                                    <li><a class="dropdown-item">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <input type="submit" value="ログアウト">
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <ul class="nav nav-tabs justify-content-center nav-fill" id="myTab" role="tablist">
                <a class="nav-link nav-item" href="{{ route('allTweetGet') }}">全てのつぶやき</a>
                <a class="nav-link nav-item active" aria-current="page" href="{{ route('myTweetGet') }}">自分のつぶやき</a>
                <a class="nav-link nav-item" href="{{ route('followerTweetGet') }}">フォロワーのつぶやき</a>
                <a class="nav-link nav-item" href="{{ route('talkRoom') }}">トークルーム</a>
            </ul>
        </div>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            <table>
                @foreach ($tweets as $tweet)
                    <tr>
                        @if ($tweet->user->icon)
                            <td>
                                <img src="{{ asset('storage/images/' . $tweet->user->icon) }}" width="80"
                                    height="80">
                            </td>
                        @endif
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
