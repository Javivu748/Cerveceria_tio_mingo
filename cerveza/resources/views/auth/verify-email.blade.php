<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Email - Cervecería Tío Mingo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gold: #D4A574;
            --deep-amber: #B8860B;
            --dark-brown: #2C1810;
            --warm-cream: #F5E6D3;
            --forest-green: #1B4332;
            --copper: #B87333;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--dark-brown);
            color: var(--warm-cream);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Textura de fondo */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: repeating-linear-gradient(
                90deg,
                transparent, transparent 2px,
                rgba(212, 165, 116, 0.03) 2px,
                rgba(212, 165, 116, 0.03) 4px
            );
            pointer-events: none;
            z-index: 0;
        }

        /* Orbe de fondo */
        body::after {
            content: '';
            position: fixed;
            top: -20%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, var(--deep-amber) 0%, transparent 70%);
            opacity: 0.07;
            pointer-events: none;
            z-index: 0;
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1);   opacity: 0.07; }
            50%       { transform: scale(1.2); opacity: 0.11; }
        }

        /* ── HEADER ── */
        header {
            position: relative;
            z-index: 10;
            padding: 1.5rem 5%;
            border-bottom: 2px solid var(--primary-gold);
            background: rgba(44, 24, 16, 0.95);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            animation: slideDown 0.7s ease-out;
        }

        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to   { transform: translateY(0);     opacity: 1; }
        }

        .logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            letter-spacing: 3px;
            color: var(--primary-gold);
            text-shadow: 3px 3px 0 var(--deep-amber);
            text-decoration: none;
            position: relative;
        }

        .logo::after {
            content: '🍺';
            position: absolute;
            right: -36px;
            top: -4px;
            font-size: 1.6rem;
        }

        /* ── MAIN WRAPPER ── */
        main {
            flex: 1;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1.5rem;
        }

        /* ── CARD ── */
        .card {
            width: 100%;
            max-width: 480px;
            background: rgba(245, 230, 211, 0.04);
            border: 2px solid var(--primary-gold);
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0);    }
        }

        /* Brillo de hover en la card */
        .card::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212,165,116,0.06), transparent);
            transition: left 0.8s ease;
            pointer-events: none;
        }

        .card:hover::before { left: 100%; }

        /* Línea decorativa superior */
        .card-accent {
            position: absolute;
            top: 0; left: 0;
            width: 60px; height: 4px;
            background: linear-gradient(90deg, var(--primary-gold), var(--deep-amber));
        }

        /* ── ICONO CENTRAL ── */
        .icon-wrap {
            width: 80px;
            height: 80px;
            margin: 0 auto 2rem;
            border: 2px solid var(--primary-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            background: rgba(212, 165, 116, 0.08);
            animation: fadeInUp 0.8s ease-out 0.35s both;
        }

        /* ── TÍTULO ── */
        .card-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.2rem;
            letter-spacing: 3px;
            color: var(--primary-gold);
            text-align: center;
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.8s ease-out 0.45s both;
        }

        /* ── TEXTO DESCRIPTIVO ── */
        .card-text {
            font-size: 0.95rem;
            font-weight: 300;
            line-height: 1.8;
            color: rgba(245, 230, 211, 0.8);
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s ease-out 0.55s both;
        }

        /* ── ALERTA DE ÉXITO ── */
        .alert-success {
            background: rgba(27, 67, 50, 0.4);
            border: 1px solid rgba(27, 67, 50, 0.9);
            border-left: 4px solid #4ade80;
            padding: 1rem 1.2rem;
            margin-bottom: 2rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: #86efac;
            letter-spacing: 0.5px;
            line-height: 1.6;
            animation: fadeInUp 0.6s ease-out both;
        }

        /* ── SEPARADOR ── */
        .divider {
            border: none;
            border-top: 1px solid rgba(212, 165, 116, 0.2);
            margin: 2rem 0;
        }

        /* ── BOTÓN PRINCIPAL ── */
        .btn-primary {
            display: block;
            width: 100%;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--primary-gold), var(--deep-amber));
            color: var(--dark-brown);
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeInUp 0.8s ease-out 0.65s both;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: rgba(255,255,255,0.25);
            transition: left 0.5s ease;
        }

        .btn-primary:hover::before { left: 100%; }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 165, 116, 0.35);
        }

        /* ── BOTÓN SECUNDARIO (logout) ── */
        .btn-ghost {
            display: block;
            width: 100%;
            padding: 0.9rem 2rem;
            background: transparent;
            color: rgba(245, 230, 211, 0.5);
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 0.8rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 1px solid rgba(245, 230, 211, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease-out 0.75s both;
            margin-top: 1rem;
        }

        .btn-ghost:hover {
            background: rgba(255, 80, 80, 0.08);
            color: #ff8080;
            border-color: rgba(255, 80, 80, 0.4);
            transform: translateY(-1px);
        }

        /* ── FOOTER ── */
        footer {
            position: relative;
            z-index: 1;
            padding: 1.5rem 5%;
            border-top: 1px solid rgba(212, 165, 116, 0.2);
            text-align: center;
            font-size: 0.75rem;
            color: rgba(245, 230, 211, 0.3);
            letter-spacing: 1px;
        }

        @media (max-width: 520px) {
            .card { padding: 2rem 1.5rem; }
            .card-title { font-size: 1.8rem; }
            .logo { font-size: 1.4rem; }
            .logo::after { font-size: 1.3rem; right: -30px; }
        }
    </style>
</head>
<body>

    <header>
        <a href="{{ url('/') }}" class="logo">CERVECERÍA TÍO MINGO</a>
    </header>

    <main>
        <div class="card">
            <div class="card-accent"></div>

            {{-- Icono --}}
            <div class="icon-wrap">📧</div>

            {{-- Título --}}
            <h1 class="card-title">Verifica tu Email</h1>

            {{-- Alerta de éxito al reenviar --}}
            @if (session('status') == 'verification-link-sent')
                <div class="alert-success">
                    ✓ &nbsp;Hemos enviado un nuevo enlace de verificación a tu correo electrónico.
                </div>
            @endif

            {{-- Texto descriptivo --}}
            <p class="card-text">
                ¡Gracias por registrarte! Antes de continuar, verifica tu dirección de email
                haciendo clic en el enlace que acabamos de enviarte. Si no lo has recibido,
                podemos enviarte uno nuevo.
            </p>

            <hr class="divider">

            {{-- Botón reenviar verificación --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-primary">
                    Reenviar Email de Verificación
                </button>
            </form>

            {{-- Botón cerrar sesión --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-ghost">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </main>

    <footer>
        © {{ date('Y') }} CERVECERÍA TÍO MINGO — Hecho con pasión 🍺
    </footer>

</body>
</html>