<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoアプリ</title>
    <!-- 独自のCSSファイルを読み込む -->
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="container">
        {{-- メッセージ表示エリア --}}
        @if (session('success'))
            <div class="message-box success" role="alert">
                <span class="message-text">{{ session('success') }}</span>
            </div>
        @endif

        {{-- コンテンツ表示エリア --}}
        @yield('content')
    </div>
</body>
</html>
