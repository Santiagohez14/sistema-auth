<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem-auth</title>
    <link rel="icon" href="{{ asset('img/tl.webp') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>¡Bienvenido a nuestra plataforma de Autenticación!</h1>
        <h2>Sistem-auth</h2>
        <p>Por favor, inicia sesión o regístrate para continuar.</p>
        <div class="buttons">
            <a href="{{ route('login') }}" class="btn">Entrar</a>
            <a href="{{ route('register') }}" class="btn">Registrarse</a>
        </div>
    </div>
</body>
</html>
