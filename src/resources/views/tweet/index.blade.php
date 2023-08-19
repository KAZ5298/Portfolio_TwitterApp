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
    <div class="header">
        <div class="container">
            <h1>Twitter Modoki</h1>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">全てのつぶやき</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="#">自分のつぶやき</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="#">フォロワーのつぶやき</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="#">トークルーム</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </div>
    </div>

    <div class="main">
        <div class="container">
            <table>
                @foreach ($tweets as $tweet)
                    <tr>
                        <td>{{ $tweet->user->name }}</td>
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
                            {{-- <?= dd($tweet->user->id, $tweet->id, $tweet->isFavorite($tweet->user->id, $tweet->id)) ?> --}}
                            @if ($tweet->isFavorite($tweet->user->id, $tweet->id))
                                <form action="{{ route('unfavorite', $tweet->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <td><input type="submit" value="いいね解除"></td>
                                </form>
                            @else
                                {{-- <form action="{{ route('favorite', $tweet->favorite->id) }}" method="POST">
                                    @csrf
                                    <td><input type="submit" value="いいね"></td>
                                </form> --}}
                            @endif
                        @endif
                    </tr>
                    <tr>
                        <td>{{ $tweet->content }}</td>
                    </tr>
                    <tr>
                        <td>投稿日時：{{ $tweet->created_at }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="footer">

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
