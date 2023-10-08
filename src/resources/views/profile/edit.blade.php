<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Modoki</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/profile_edit_view.css') }}">
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
            <form name="editForm" method="POST" action="{{ route('profileCheck') }}" enctype="multipart/form-data">
                @csrf

                <div class="input guide">
                    <label>下記の項目を入力してください。<span style="color:red">（※項目は入力必須）</span></label>
                </div>

                <input type="hidden" name="id" value="{{ $user->id }}">

                <!-- Name -->
                <div class="input name">
                    <label for="name">アカウント名（ユーザーＩＤ）</label>
                    @if (!$errors->has('name'))
                        <input id="name" class="form" type="text" name="name" value="{{ $user->name }}"
                            placeholder="※">
                    @else
                        <input style="border: solid 2px red;" id="name" class="form" type="text"
                            name="name" value="{{ old('name') }}" placeholder="※">
                        @foreach ($errors->get('name') as $message)
                            <label style="color: red">{{ $message }}</label>
                        @endforeach
                    @endif
                </div>

                <!-- Email Address -->
                <div class="input email">
                    <label for="email">メールアドレス</label>
                    @if (!$errors->has('email'))
                        <input id="email" class="form" type="text" name="email" value="{{ $user->email }}"
                            placeholder="※">
                    @else
                        <input style="border: solid 2px red;" id="email" class="form" type="text"
                            name="email" value="{{ old('email') }}" placeholder="※">
                        @foreach ($errors->get('email') as $message)
                            <label style="color: red">{{ $message }}</label>
                        @endforeach
                    @endif
                </div>

                <!-- Nick Name -->
                <div class="input nickname">
                    <label for="nickname">ニックネーム（一覧画面での表示名）</label>
                    @if (!$errors->has('nickname'))
                        <input id="nickname" class="form" type="text" name="nickname"
                            value="{{ $user->nickname }}" placeholder="※">
                    @else
                        <input style="border: solid 2px red;" id="nickname" class="form" type="text"
                            name="nickname" value="{{ old('nickname') }}" placeholder="※">
                        @foreach ($errors->get('nickname') as $message)
                            <label style="color: red">{{ $message }}</label>
                        @endforeach
                    @endif
                </div>

                <!-- Profile Icon -->
                <div class="input icon">
                    <label for="icon">プロフィール画像</label>
                    <br>
                    <input type="radio" id="icon_change" name="icon_change" value="no" checked>
                    <label for="icon_change">変更しない</label>
                    <input type="radio" id="icon_change" name="icon_change" value="yes">
                    <label for="icon_change">変更する</label>
                    <br>
                    @if (isset($user->icon))
                        <img src="{{ asset('storage/images/' . $user->icon) }}">
                    @else
                        <label>登録なし</label>
                    @endif
                    <br>
                    <input id="icon" type="file" name="icon">
                </div>

                <!-- Password -->
                <div class="input password">
                    <label for="password">パスワード</label>
                    @if (!$errors->has('password'))
                        <input id="password" class="form" type="password" name="password" placeholder="※">
                    @else
                        <input style="border: solid 2px red;" id="password" class="form" type="password"
                            name="password" placeholder="※">
                        @foreach ($errors->get('password') as $message)
                            <label style="color: red">{{ $message }}</label>
                        @endforeach
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="input password">
                    <label for="password">パスワード（再確認）</label>
                    <input id="password" class="form" type="password" name="password_confirmation"
                        placeholder="※">
                </div>

                <div class="button">
                    <button type="submit" class="btn btn-primary">
                        <span class="material-symbols-outlined"> how_to_reg </span>
                        <span class="btn-name">登録</span>
                    </button>
                    <a href="/profile" class="btn btn-danger">
                        <span class="material-symbols-outlined"> restart_alt </span>
                        <span class="btn-name">リセット</span>
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
