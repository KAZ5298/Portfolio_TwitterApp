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

            <div class="tweetcontainer">
                <form action="{{ route('tweetPost') }}" method="POST">
                    @csrf
                    <textarea name="content" rows="1" cols="150" placeholder="つぶやきは１００文字以下で入力してください。"></textarea>
                    <button type="submit" class="btn btn-primary">つぶやく</button>
                </form>
            </div>

            @foreach ($tweets as $tweet)
                <div class="row">
                    <div class="col-md-3 border">
                        @if ($tweet->user->icon)
                            <img src="{{ asset('storage/images/' . $tweet->user->icon) }}" width="80"
                                height="80">
                        @endif
                    </div>
                    <div class="col-md-3 border">
                        {{ $tweet->user->nickname }}
                    </div>
                    <div class="col-6 border">
                        <form action="{{ route('tweetDestroy', $tweet) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger" value="削除">
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col border">
                        {{ $tweet->content }}
                    </div>
                </div>
                <div class="row">
                    <div class="col border">
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
