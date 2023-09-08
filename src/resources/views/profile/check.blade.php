<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/check_view.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap">
</head>

<body class="bg-primary-subtle">

    {{--  ヘッダー --}}
    <div class="header">
        <div class="title bg-primary">
            Twitter Modoki
        </div>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <table>
                    <tr>
                        <th><label>アカウント名（ユーザーＩＤ）</label></th>
                        <td><label>{{ $user->name }}</label></td>
                        <input type="hidden" name="name" value="{{ $user->name }}">
                    </tr>
                    <tr>
                        <th><label>メールアドレス</label></th>
                        <td><label>{{ $user->email }}</label></td>
                        <input type="hidden" name="email" value="{{ $user->email }}">
                    </tr>
                    <tr>
                        <th><label>ニックネーム（一覧画面での表示名）</label></th>
                        <td><label>{{ $user->nickname }}</label></td>
                        <input type="hidden" name="nickname" value="{{ $user->nickname }}">
                    </tr>
                    <tr>
                        <th><label>プロフィール画像</label></th>
                        <td>
                            @if (isset($icon))
                                <label><img src="{{ asset('storage/images/' . $icon) }}" width="80"
                                        height="80"></label>
                            @else
                                <label>登録なし</label>
                            @endif
                            <input type="hidden" name="icon" value="{{ $icon }}">
                        </td>
                        <input type="hidden" name="password" value="{{ $user->password }}">
                        <input type="hidden" name="password_confirmation" value="{{ $user->password_confirmation }}">
                </table>

                <div class="mt-2 border px-4 py-3 rounded relative bg-warning-subtle">
                    <label style="display: flex; justify-content: center;">上記の内容で登録します。よろしいですか？</label>
                </div>

                <div class="button">
                    <button type="submit" class="btn btn-primary">はい</button>
                    <a href="{{ route('profile.edit') }}" class="btn btn-danger">いいえ</a>
                    <a href="{{ route('allTweetGet') }}" class="btn btn-secondary">ＴＯＰ画面へ戻る</a>
                </div>

            </form>
        </div>
    </div>

    {{-- フッター --}}
    <div class="footer">

    </div>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
