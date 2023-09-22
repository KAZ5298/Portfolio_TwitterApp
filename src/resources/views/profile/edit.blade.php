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
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/js/reset.button.js') --}}
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

                <div class="input mb-4">
                    <label>下記の項目を入力してください。<span style="color:red">（※項目は入力必須）</span></label>
                </div>

                <input type="hidden" name="id" value="{{ $user->id }}">

                <!-- Name -->
                <div class="input">
                    <label>アカウント名（ユーザーＩＤ）</label>
                    <br>
                    <div class="mb-4">
                        @if (!$errors->has('name'))
                            <input class="form" type="text" name="name" value="{{ $user->name }}"
                                placeholder="※">
                            <label>　</label>
                        @else
                            <input style="border: solid 2px red;" class="form" type="text" name="name"
                                value="{{ old('name') }}" placeholder="※">
                            @foreach ($errors->get('name') as $message)
                                <label style="color: red">{{ $message }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Email Address -->
                <div class="input">
                    <label>メールアドレス</label>
                    <br>
                    <div class="mb-4">
                        @if (!$errors->has('email'))
                            <input class="form" type="text" name="email" value="{{ $user->email }}"
                                placeholder="※">
                            <label>　</label>
                        @else
                            <input style="border: solid 2px red;" class="form" type="text" name="email"
                                value="{{ old('email') }}" placeholder="※">
                            @foreach ($errors->get('email') as $message)
                                <label style="color: red">{{ $message }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Nick Name -->
                <div class="input">
                    <label>ニックネーム（一覧画面での表示名）</label>
                    <br>
                    <div class="mb-4">
                        @if (!$errors->has('nickname'))
                            <input class="form" type="text" name="nickname" value="{{ $user->nickname }}"
                                placeholder="※">
                            <label>　</label>
                        @else
                            <input style="border: solid 2px red;" class="form" type="text" name="nickname"
                                value="{{ old('nickname') }}" placeholder="※">
                            @foreach ($errors->get('nickname') as $message)
                                <label style="color: red">{{ $message }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Profile Icon -->
                <div class="mt-4">
                    <label>プロフィール画像</label>
                    <br>
                    <input type="radio" id="icon_change" name="icon_change" value="no" checked>
                    <label for="icon_change">変更しない</label>
                    <input type="radio" id="icon_change" name="icon_change" value="yes">
                    <label for="icon_change">変更する</label>
                    <br>
                    @if (isset($user->icon))
                        <img src="{{ asset('storage/images/' . $user->icon) }}" width="80" height="80">
                    @else
                        <label>登録なし</label>
                    @endif
                    <br>
                    <input type="file" name="icon">
                    <br>
                    <label>　</label>
                </div>

                <!-- Password -->
                <div class="input">
                    <label>パスワード</label>
                    <br>
                    <input type="radio" id="password_change" name="password_change" value="no" checked>
                    <label for="password_change">変更しない</label>
                    <input type="radio" id="password_change" name="password_change" value="yes">
                    <label for="password_change">変更する</label>
                    <br>
                    <div class="mb-4">
                        @if (!$errors->has('password'))
                            <input class="form" type="password" name="password" placeholder="※">
                            <label>　</label>
                        @else
                            <input style="border: solid 2px red;" class="form" type="password" name="password"
                                placeholder="※">
                            @foreach ($errors->get('password') as $message)
                                <label style="color: red">{{ $message }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <div class="input">
                        <label>パスワード（再確認）</label>
                        <br>
                        <input class="form" type="password" name="password_confirmation" placeholder="※">
                    </div>
                </div>

                <div class="button">
                    <button type="submit" class="btn btn-primary">登録</button>
                    {{-- <button type="reset" class="btn btn-danger">リセット</button> --}}
                    <input type="reset" class="btn btn-danger">
                    {{-- <button type="button" class="btn btn-danger" onclick="resetEditForm()">リセット</button> --}}
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
