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
            <nav class="navbar navbar-expand navbar-right bg-primary-subtle">
                <h1>Twitter Modoki</h1>
                @if ($loginUser->icon)
                    <img src="{{ asset('storage/images/' . $loginUser->icon) }}" width="80" height="80">
                @endif
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <h2>ログイン中：{{ $loginUser->nickname }}</h2>
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
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout').submit();">ログアウト</a>
                                        <form id="logout" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                        </form>
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
                <div class="container-fluid">
                    <a class="navbar-brand btn btn-secondary" href=""
                        onclick="javascript:history.back(); return false;">ＴＯＰ画面へ戻る</a>
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
                            <td><img src="{{ asset('storage/images/' . $follower->icon) }}" width="80"
                                    height="80"></td>
                        @endif
                        <td>
                            {{ $follower->nickname }}<br>
                            @if ($loginUser->isFollowed($follower->id))
                                フォローされています
                            @endif
                        </td>
                        @if ($loginUser->isFollowing($follower->id))
                            <form action="{{ route('unfollow', $follower->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                @if ($loginUser->checkMessageInTalkRoom($loginUser->id, $follower->id))
                                    <td><input type="submit" class="btn btn-danger"
                                            onclick="return confirm('トークルームのメッセージが削除されます。よろしいですか？');" value="フォロー解除">
                                    </td>
                                @else
                                    <td><input type="submit" class="btn btn-danger" value="フォロー解除"></td>
                                @endif
                            </form>
                        @endif
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
