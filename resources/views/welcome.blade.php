<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - Unillantas Oaxaca</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            
            font-family: 'Nunito', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #046596;
           
        }
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
        }
        .login-container img {
            height: 150px;
            margin-bottom: 1rem;
        }
        .login-container a {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background-color: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 0.25rem;
        }
        .login-container a:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="{{ asset('assets/LOGO.png') }}" alt="Logo Unillantas">
        <h1>Bienvenido</h1>
        <a href="{{ route('login') }}">INICIAR SESIÓN</a>
    </div>
</body>
</html>

