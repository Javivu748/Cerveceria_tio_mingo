<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Cervecería Tío Mingo</title>
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
            bottom: -20%;
            right: -10%;
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

        /* ── MAIN ── */
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

        .card-accent {
            position: absolute;
            top: 0; left: 0;
            width: 60px; height: 4px;
            background: linear-gradient(90deg, var(--primary-gold), var(--deep-amber));
        }

        /* ── ICONO ── */
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
            margin-bottom: 1rem;
            animation: fadeInUp 0.8s ease-out 0.45s both;
        }

        /* ── TEXTO DESCRIPTIVO ── */
        .card-text {
            font-size: 0.9rem;
            font-weight: 300;
            line-height: 1.8;
            color: rgba(245, 230, 211, 0.7);
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s ease-out 0.5s both;
        }

        /* ── ALERTA DE ÉXITO (link enviado) ── */
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
            margin: 0 0 2rem;
        }

        /* ── LABEL ── */
        label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(245, 230, 211, 0.7);
            margin-bottom: 0.6rem;
            animation: fadeInUp 0.8s ease-out 0.55s both;
        }

        /* ── INPUT ── */
        .input-wrap {
            position: relative;
            animation: fadeInUp 0.8s ease-out 0.6s both;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            opacity: 0.5;
            pointer-events: none;
        }

        input[type="email"] {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 2.8rem;
            background: rgba(245, 230, 211, 0.06);
            border: 1px solid rgba(212, 165, 116, 0.35);
            color: var(--warm-cream);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.95rem;
            font-weight: 400;
            outline: none;
            transition: border-color 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="email"]::placeholder {
            color: rgba(245, 230, 211, 0.3);
            font-weight: 300;
        }

        input[type="email"]:focus {
            border-color: var(--primary-gold);
            background: rgba(212, 165, 116, 0.08);
            box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.12);
        }

        /* ── ERROR ── */
        .input-error {
            margin-top: 0.5rem;
            font-size: 0.78rem;
            color: #f87171;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* ── BOTÓN PRINCIPAL ── */
        .btn-primary {
            display: block;
            width: 100%;
            margin-top: 2rem;
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
            animation: fadeInUp 0.8s ease-out 0.7s both;
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

        /* ── LINK VOLVER ── */
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 1px;
            color: rgba(245, 230, 211, 0.45);
            text-decoration: none;
            text-transform: uppercase;
            transition: color 0.3s ease;
            animation: fadeInUp 0.8s ease-out 0.8s both;
        }

        .back-link:hover { color: var(--primary-gold); }

        .back-link::before {
            content: '← ';
            font-size: 0.75rem;
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
            <div class="icon-wrap">🔑</div>

            {{-- Título --}}
            <h1 class="card-title">Recuperar Contraseña</h1>

            {{-- Texto descriptivo --}}
            <p class="card-text">
                ¿Olvidaste tu contraseña? Sin problema. Indícanos tu email y 
                te enviaremos un enlace para que puedas crear una nueva.
            </p>

            <hr class="divider">

            {{-- Alerta de enlace enviado --}}
            @if (session('status'))
                <div class="alert-success">
                    ✓ &nbsp;{{ session('status') }}
                </div>
            @endif

            {{-- Formulario --}}
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email">Correo Electrónico</label>
                    <div class="input-wrap">
                        <span class="input-icon">✉</span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="tu@correo.com"
                            required
                            autofocus
                            autocomplete="email"
                        >
                    </div>
                    @error('email')
                        <p class="input-error">⚠ {{ $message }}</p>
                    @enderror
                </div>

                {{-- Botón enviar --}}
                <button type="submit" class="btn-primary">
                    Enviar Enlace de Recuperación
                </button>
            </form>

            {{-- Volver al login --}}
            <a href="{{ route('login') }}" class="back-link">Volver al inicio de sesión</a>
        </div>
    </main>

    <footer>
        © {{ date('Y') }} CERVECERÍA TÍO MINGO — Hecho con pasión 🍺
    </footer>

</body>
</html>