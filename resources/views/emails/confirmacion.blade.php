<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación - Cinerama</title>
    <style>
        body {
            background-color: #000;
            color: #f1f1f1;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #111;
            padding: 40px;
            border-radius: 12px;
            border: 2px solid #f7d354;
            text-align: center;
        }
        .logo {
            display: block;
            margin: 0 auto 25px auto;
            width: 160px;
        }
        h2 {
            color: #f7d354;
        }
        .msg {
            line-height: 1.6;
            margin-top: 10px;
        }
        .footer {
            color: #aaa;
            font-size: 12px;
            margin-top: 30px;
            border-top: 1px solid #333;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://i.imgur.com/dV6Zk1a.png" alt="Cinerama Logo" class="logo">

        <h2>🎬 ¡Gracias por contactarte con nosotros!</h2>

        <p class="msg">
            Hola <strong>{{ $empresa }}</strong>, hemos recibido tu mensaje y nuestro equipo de 
            <strong>Cinerama</strong> te responderá lo antes posible.
        </p>

        <div class="footer">
            <p>📍 Cinerama - Atención Corporativa</p>
            <p>Síguenos en redes sociales</p>
            <p>
                <a href="https://facebook.com" style="color:#f7d354;">Facebook</a> |
                <a href="https://instagram.com" style="color:#f7d354;">Instagram</a> |
                <a href="https://tiktok.com" style="color:#f7d354;">TikTok</a>
            </p>
        </div>
    </div>
</body>
</html>
