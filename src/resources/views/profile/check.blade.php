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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@30,400,0,0">
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
                        <th><label class="input">アカウント名（ユーザーＩＤ）</label></th>
                        <td><label class="input">{{ $user->name }}</label></td>
                        <input type="hidden" name="name" value="{{ $user->name }}">
                    </tr>
                    <tr>
                        <th><label class="input">メールアドレス</label></th>
                        <td><label class="input">{{ $user->email }}</label></td>
                        <input type="hidden" name="email" value="{{ $user->email }}">
                    </tr>
                    <tr>
                        <th><label class="input">ニックネーム（一覧画面での表示名）</label></th>
                        <td><label class="input">{{ $user->nickname }}</label></td>
                        <input type="hidden" name="nickname" value="{{ $user->nickname }}">
                    </tr>
                    <tr>
                        <th><label class="input">プロフィール画像</label></th>
                        <td>
                            @if (isset($icon))
                                <label class="input"><img src="{{ asset('storage/images/' . $icon) }}"></label>
                            @else
                                <label class="input">登録なし</label>
                            @endif
                            <input type="hidden" name="icon" value="{{ $icon }}">
                        </td>
                        <input type="hidden" name="password" value="{{ $user->password }}">
                        <input type="hidden" name="password_confirmation" value="{{ $user->password_confirmation }}">
                </table>

                <div class="mt-2 border px-4 py-3 rounded relative bg-warning-subtle">
                    <label class="worning">上記の内容で登録します。よろしいですか？</label>
                </div>

                <div class="button">
                    <button type="submit" class="btn btn-primary">
                        <span class="material-symbols-outlined"> check_circle </span>
                        <span class="btn-name">はい</span>
                    </button>
                    <a href="{{ route('profile.edit') }}" class="btn btn-danger">
                        <span class="material-symbols-outlined"> cancel </span>
                        <span class="btn-name">いいえ</span>
                    </a>
                    <a href="{{ route('allTweetGet') }}" class="btn btn-secondary">
                        <span class="material-symbols-outlined navbar-follow-btn"> undo </span>
                        <span class="btn-name">ＴＯＰ画面へ戻る</span>
                    </a>
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
