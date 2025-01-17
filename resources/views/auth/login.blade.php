<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>
<body>
    <div class="auth-container">
        <div class="login-block">
            <p>Login to App</p>
            <form id="login-form" method="post" action="/login">
                @csrf
                <label for="username">Username</label>
                <input type="text" name="name" value="" id="username">
                <label for="password">Password</label>
                <input type="password" name="password" value="" id="password">
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
