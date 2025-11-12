<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>🎬 Nueva solicitud - Cinerama</title>
    <style>
        body {
            background-color: #000;
            color: #f1f1f1;
            font-family: 'Segoe UI', Arial, sans-serif;
            padding: 0;
            margin: 0;
        }
        .container {
            max-width: 650px;
            margin: 40px auto;
            background-color: #111;
            padding: 40px;
            border-radius: 12px;
            border: 2px solid #f7d354;
        }
        h2 {
            color: #f7d354;
            text-align: center;
        }
        .logo {
            display: block;
            margin: 0 auto 20px auto;
            width: 160px;
        }
        .info p {
            line-height: 1.6;
            margin: 6px 0;
        }
        .footer {
            text-align: center;
            color: #aaa;
            font-size: 12px;
            margin-top: 25px;
            border-top: 1px solid #333;
            padding-top: 15px;
        }
        .footer a {
            color: #f7d354;
            text-decoration: none;
            margin: 0 6px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://i.imgur.com/dV6Zk1a.png" alt="Cinerama Logo" class="logo">

        <h2>📩 Nueva solicitud de contacto</h2>

        <p>Has recibido un nuevo mensaje desde el formulario corporativo de <strong>Cinerama</strong>.</p>

        <div class="info">
            <p><strong>Empresa:</strong> {{ $empresa }}</p>
            <p><strong>Correo:</strong> {{ $correo }}</p>
            <p><strong>Teléfono:</strong> {{ $telefono }}</p>
            <p><strong>Ciudad:</strong> {{ $ciudad }}</p>
            <p><strong>Mensaje:</strong></p>
            <p>{{ $mensaje }}</p>
        </div>

        <div class="footer">
            <p>🎬 Cinerama | Atención Corporativa</p>
            <p>
                <a href="https://facebook.com">Facebook</a> |
                <a href="https://instagram.com">Instagram</a> |
                <a href="https://tiktok.com">TikTok</a>
            </p>
        </div>
    </div>
</body>
</html>

