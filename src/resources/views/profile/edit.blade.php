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
        </div>
    </div>

    {{-- メインコンテンツ --}}
    <div class="main">
        <div class="container">
            <form method="POST" action="{{ route('profileCheck') }}" enctype="multipart/form-data">
                @csrf

                <label>下記の項目を入力してください。<span style="color:red">（※項目は入力必須）</span></label>

                <!-- Name -->
                <div class="mt-4">
                    <label>アカウント名（ユーザーＩＤ）</label>
                    @if ($errors->has('name'))
                        <tr>
                            @foreach ($errors->get('name') as $message)
                                <td> {{ $message }} </td>
                            @endforeach
                        </tr>
                    @endif
                    <br>
                    <br>
                    <input type="text" name="name" value="{{ $user->name }}" placeholder="※">
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <label>メールアドレス</label>
                    @if ($errors->has('email'))
                        <tr>
                            @foreach ($errors->get('email') as $message)
                                <td> {{ $message }} </td>
                            @endforeach
                        </tr>
                    @endif
                    <br>
                    <input type="text" name="email" value="{{ $user->email }}" placeholder="※">
                </div>

                <!-- Nick Name -->
                <div class="mt-4">
                    <label>ニックネーム（一覧画面での表示名）</label>
                    @if ($errors->has('nickname'))
                        <tr>
                            @foreach ($errors->get('nickname') as $message)
                                <td> {{ $message }} </td>
                            @endforeach
                        </tr>
                    @endif
                    <br>
                    <input type="text" name="nickname" value="{{ $user->nickname }}" placeholder="※">
                </div>

                <!-- Profile Icon -->
                <div class="mt-4">
                    <label>プロフィール画像</label>
                    @if (isset($user->icon))
                        <img src="{{ asset('storage/images/' . $user->icon) }}" width="80" height="80">
                    @else
                        <label>登録なし</label>
                    @endif
                    <br>
                    <input type="file" name="icon">
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label>パスワード</label>
                    @if ($errors->has('password'))
                        <tr>
                            @foreach ($errors->get('password') as $message)
                                <td> {{ $message }} </td>
                            @endforeach
                        </tr>
                    @endif
                    <br>
                    <input type="password" name="password" placeholder="※">
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label>パスワード（再確認）</label>
                    <br>
                    <input type="password" name="password_confirmation" placeholder="※">
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">登録</button>
                    <button type="reset" class="btn btn-danger">リセット</button>
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
