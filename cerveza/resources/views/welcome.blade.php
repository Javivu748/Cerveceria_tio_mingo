<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cervecería Tío Mingo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold:   #D4A574;
            --amber:  #B8860B;
            --brown:  #2C1810;
            --cream:  #F5E6D3;
            --copper: #B87333;
            --dark:   #180D08;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body {
            width: 100%; height: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--dark);
            color: var(--cream);
        }

        /* ── FONDO ── */
        .bg {
            position: fixed; inset: 0; z-index: 0;
            background:
                radial-gradient(ellipse 80% 60% at 15% 50%,  rgba(184,134,11,.18) 0%, transparent 65%),
                radial-gradient(ellipse 60% 80% at 85% 20%,  rgba(212,165,116,.12) 0%, transparent 60%),
                radial-gradient(ellipse 50% 50% at 60% 90%,  rgba(184,100,11,.10) 0%, transparent 60%),
                var(--dark);
        }

        /* grano de textura */
        .bg::after {
            content: '';
            position: absolute; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
            opacity: .045;
            pointer-events: none;
        }

        /* líneas verticales decorativas */
        .bg::before {
            content: '';
            position: absolute; inset: 0;
            background-image: repeating-linear-gradient(
                90deg,
                transparent, transparent 120px,
                rgba(212,165,116,.04) 120px, rgba(212,165,116,.04) 121px
            );
            pointer-events: none;
        }

        /* ── LAYOUT ── */
        .page {
            position: relative; z-index: 1;
            width: 100vw; height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* ── LADO IZQUIERDO ── */
        .left {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 5% 6% 5% 8%;
            position: relative;
            border-right: 1px solid rgba(212,165,116,.15);
        }

        /* barra dorada vertical */
        .left::before {
            content: '';
            position: absolute;
            left: 0; top: 15%; bottom: 15%;
            width: 3px;
            background: linear-gradient(to bottom, transparent, var(--gold), transparent);
        }

        .eyebrow {
            font-size: .72rem;
            letter-spacing: .35em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 2rem;
            opacity: 0;
            animation: fadeUp .7s ease-out .2s forwards;
        }

        .brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(4rem, 7vw, 7.5rem);
            line-height: .88;
            letter-spacing: .02em;
            color: var(--cream);
            margin-bottom: 1.8rem;
            opacity: 0;
            animation: fadeUp .7s ease-out .35s forwards;
        }

        .brand em {
            display: block;
            color: var(--gold);
            font-style: normal;
            text-shadow: 0 0 60px rgba(212,165,116,.35);
        }

        .tagline {
            font-size: clamp(.85rem, 1.1vw, 1rem);
            font-weight: 300;
            font-style: italic;
            line-height: 1.75;
            color: rgba(245,230,211,.65);
            max-width: 380px;
            margin-bottom: 3rem;
            opacity: 0;
            animation: fadeUp .7s ease-out .5s forwards;
        }

        /* insignias */
        .badges {
            display: flex; gap: 1.2rem; flex-wrap: wrap;
            opacity: 0;
            animation: fadeUp .7s ease-out .65s forwards;
        }

        .badge {
            display: flex; align-items: center; gap: .5rem;
            font-size: .72rem; letter-spacing: .12em;
            text-transform: uppercase;
            color: rgba(245,230,211,.5);
        }

        .badge::before {
            content: '';
            width: 22px; height: 1px;
            background: var(--gold);
            opacity: .6;
        }

        /* ── LADO DERECHO ── */
        .right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 5%;
            position: relative;
            overflow: hidden;
        }

        /* vaso decorativo de fondo */
        .glass-bg {
            position: absolute;
            bottom: -5%; right: -8%;
            width: 55%;
            aspect-ratio: 1;
            border-radius: 0 0 50% 50% / 0 0 30% 30%;
            background: linear-gradient(180deg,
                rgba(255,193,7,.05)  0%,
                rgba(255,111,0,.12) 50%,
                rgba(200,70,0,.18) 100%);
            box-shadow: inset 0 -40px 80px rgba(255,193,7,.08);
            animation: fillGlass 2.5s ease-out .5s both;
            pointer-events: none;
        }

        .foam-bg {
            position: absolute;
            bottom: 20%; right: -8%;
            width: 55%;
            height: 60px;
            background: radial-gradient(ellipse at center,
                rgba(255,255,255,.08) 0%,
                rgba(255,248,220,.04) 60%,
                transparent 100%);
            filter: blur(8px);
            animation: foamDrift 4s ease-in-out 3s infinite;
            pointer-events: none;
        }

        @keyframes foamDrift {
            0%, 100% { transform: translateY(0) scaleX(1); }
            50%       { transform: translateY(-8px) scaleX(1.03); }
        }

        @keyframes fillGlass {
            from { clip-path: inset(100% 0 0 0); }
            to   { clip-path: inset(0 0 0 0); }
        }

        /* ── CARD ── */
        .card {
            width: 100%;
            max-width: 400px;
            position: relative; z-index: 2;
            opacity: 0;
            animation: fadeUp .7s ease-out .8s forwards;
        }

        .card-label {
            font-size: .68rem;
            letter-spacing: .3em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .btn-main {
            display: block;
            width: 100%;
            padding: 1.15rem 2rem;
            text-align: center;
            text-decoration: none;
            font-weight: 700;
            font-size: .9rem;
            letter-spacing: .18em;
            text-transform: uppercase;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform .3s ease, box-shadow .3s ease;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--gold) 0%, var(--amber) 100%);
            color: var(--dark);
            border: none;
        }

        .btn-primary::before {
            content: '';
            position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%;
            background: rgba(255,255,255,.25);
            transition: left .5s ease;
        }

        .btn-primary:hover::before { left: 100%; }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(212,165,116,.45);
        }

        .btn-outline {
            background: transparent;
            color: var(--gold);
            border: 1.5px solid var(--gold);
        }

        .btn-outline:hover {
            background: rgba(212,165,116,.1);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(212,165,116,.15);
        }

        .divider {
            display: flex; align-items: center; gap: 1rem;
            margin: 1.5rem 0;
            color: rgba(245,230,211,.25);
            font-size: .72rem;
            letter-spacing: .15em;
            text-transform: uppercase;
        }

        .divider::before,
        .divider::after {
            content: ''; flex: 1;
            height: 1px;
            background: rgba(212,165,116,.2);
        }

        .card-note {
            text-align: center;
            font-size: .72rem;
            color: rgba(245,230,211,.3);
            margin-top: 2rem;
            letter-spacing: .05em;
        }

        /* sello año */
        .year-stamp {
            position: fixed;
            bottom: 1.5rem; left: 50%;
            transform: translateX(-50%);
            font-family: 'Bebas Neue', sans-serif;
            font-size: .9rem;
            letter-spacing: .4em;
            color: rgba(212,165,116,.18);
            white-space: nowrap;
            z-index: 10;
        }

        /* ── ANIMACIONES ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(22px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            html, body { overflow: auto; }

            .page {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto;
                min-height: 100vh; height: auto;
            }

            .left {
                padding: 4rem 8% 3rem;
                border-right: none;
                border-bottom: 1px solid rgba(212,165,116,.15);
                text-align: center;
            }

            .left::before { display: none; }
            .tagline { max-width: 100%; }
            .badges { justify-content: center; }

            .right { padding: 3rem 8% 5rem; }
            .glass-bg, .foam-bg { display: none; }
        }
    </style>
</head>
<body>

    <div class="bg"></div>

    <div class="page">

        {{-- ══ IZQUIERDA: branding ══ --}}
        <div class="left">
            <p class="eyebrow">Desde 1987 · Artesanal · Premium</p>

            <h1 class="brand">
                CERVECERÍA
                <em>TÍO MINGO</em>
            </h1>

            <p class="tagline">
                Cada sorbo es el resultado de décadas de oficio,
                ingredientes naturales y la pasión que solo encuentra
                un maestro cervecero de verdad.
            </p>

            <div class="badges">
                <span class="badge">100% Natural</span>
                <span class="badge">Receta Artesanal</span>
                <span class="badge">3 Premios</span>
            </div>
        </div>

        {{-- ══ DERECHA: acceso ══ --}}
        <div class="right">
            <div class="glass-bg"></div>
            <div class="foam-bg"></div>

            <div class="card">
                <p class="card-label">Accede a tu cuenta</p>

                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-main btn-primary">
                        Ir al Dashboard
                    </a>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn-main btn-primary">
                            Iniciar Sesión
                        </a>
                    @endif

                    <div class="divider">o</div>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-main btn-outline">
                            Crear Cuenta
                        </a>
                    @endif

                    <p class="card-note">
                        Regístrate gratis y accede al catálogo completo 🍺
                    </p>
                @endauth
            </div>
        </div>

    </div>

    <span class="year-stamp">CERVECERÍA TÍO MINGO · {{ date('Y') }}</span>

</body>
</html>