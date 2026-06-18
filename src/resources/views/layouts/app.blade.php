<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>PiGLy</title>
</head>

<body class="body">
    <header class="header">
        <p class="header-logo">PiGLy</p>
        <div class="header-nav">
            <a href="/weight_logs/goal_setting">⚙ 目標体重設定</a>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>
</body>

</html>