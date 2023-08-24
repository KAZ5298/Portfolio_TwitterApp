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
                                            <form method="POST" action="{{ route('logout') }}"> @csrf
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
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand">フォロワー一覧</a>
                </div>
            </nav>
        </div>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            <table>
                @foreach ($followers as $follower)
                    <tr>
                        @if ($follower->icon)
                            <td>
                                <img src="{{ asset('storage/images/' . $follower->icon) }}" width="80"
                                    height="80">
                            </td>
                        @endif
                        <td>{{ $follower->nickname }}
                            @if ($loginUser->isFollowed($follower->id))
                                フォローされています
                            @endif
                        </td>
                        @if ($loginUser->isFollowing($follower->id))
                            <form action="{{ route('unfollow', $follower->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <td><input type="submit" value="フォロー解除"></td>
                            </form>
                        @endif
                    </tr>
                @endforeach
            </table>
            <a href="{{ route('allTweetGet') }}">戻る</a>
        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
