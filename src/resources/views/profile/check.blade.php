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

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <!-- Name -->
                <div>
                    <p>アカウント名（ユーザーＩＤ）：{{ $user->name }}</p>
                    <input type="hidden" name="name" value="{{ $user->name }}">
                </div>

                <!-- Email Address -->
                <div>
                    <p>メールアドレス：{{ $user->email }}</p>
                    <input type="hidden" name="email" value="{{ $user->email }}">
                </div>

                <!-- Nick Name -->
                <div>
                    <p>ニックネーム（一覧画面での表示名）：{{ $user->nickname }}</p>
                    <input type="hidden" name="nickname" value="{{ $user->nickname }}">
                </div>

                <!-- Profile Icon -->
                <div>
                    @if (isset($icon))
                        <p>プロフィール画像：<img src="{{ asset('storage/images/' . $icon) }}" width="80" height="80"></p>
                    @else
                        <p>プロフィール画像：登録なし</p>
                    @endif
                    <input type="hidden" name="icon" value="{{ $icon }}">
                </div>

                <!-- Password -->
                <div>
                    <input type="hidden" name="password" value="{{ $user->password }}">
                </div>

                <!-- Confirm Password -->
                <div>
                    <input type="hidden" name="password_confirmation" value="{{ $user->password_confirmation }}">
                </div>

                <button type="submit" class="btn btn-primary">はい</button>
                <a href="{{ route('profile.edit') }}" class="btn btn-danger">いいえ</a>
                <a href="{{ route('allTweetGet') }}" class="btn btn-secondary">ＴＯＰ画面へ戻る</a>

            </form>
        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
