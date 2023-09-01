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
                                    <hr class="dropdown-divider">
                                    <li><a class="dropdown-item" href="{{ route('followerList') }}">フォロワー一覧</a></li>
                                    <hr class="dropdown-divider">
                                    <li>
                                        <a class="dropdown-item">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <input type="submit" value="ログアウト" style="background-color: transparent; outline: none; border: none;">
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
                <a class="nav-link nav-item" href="{{ route('myTweetGet') }}">自分のつぶやき</a>
                <a class="nav-link nav-item" href="{{ route('followerTweetGet') }}">フォロワーのつぶやき</a>
                <a class="nav-link nav-item active" aria-current="page" href="{{ route('talkRoom') }}">トークルーム</a>
            </ul>
        </div>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            <table>
                @foreach ($rooms as $room)
                    <tr>
                        <td><a href="{{ route('talkRoomShow', $room->id) }}">{{ $room->user->nickname }}
                                さんとのトークルーム</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
