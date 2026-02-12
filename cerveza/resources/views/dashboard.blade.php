<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cervecería Tío Mingo</title>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--dark-brown);
            color: var(--warm-cream);
            overflow-x: hidden;
        }

        /* Animated background texture */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 2px,
                    rgba(212, 165, 116, 0.03) 2px,
                    rgba(212, 165, 116, 0.03) 4px
                );
            pointer-events: none;
            z-index: 1;
        }

        .container {
            position: relative;
            z-index: 2;
        }

        /* ── HEADER ── */
        header {
            padding: 1.5rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--primary-gold);
            background: rgba(44, 24, 16, 0.95);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 100;
            animation: slideDown 0.8s ease-out;
        }

        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to   { transform: translateY(0);     opacity: 1; }
        }

        .logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            letter-spacing: 3px;
            color: var(--primary-gold);
            text-shadow: 3px 3px 0 var(--deep-amber);
            position: relative;
            white-space: nowrap;
            text-decoration: none;
        }

        .logo::after {
            content: '🍺';
            position: absolute;
            right: -40px;
            top: -5px;
            font-size: 1.8rem;
        }

        /* Navegación */
        .nav-container {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        nav a {
            color: var(--warm-cream);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            position: relative;
            transition: color 0.3s ease;
            white-space: nowrap;
        }

        nav a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-gold);
            transition: width 0.3s ease;
        }

        nav a:hover            { color: var(--primary-gold); }
        nav a:hover::after     { width: 100%; }

        /* Enlace activo */
        nav a.active {
            color: var(--primary-gold);
        }
        nav a.active::after {
            width: 100%;
        }

        /* Botones de usuario autenticado */
        .auth-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .user-greeting {
            color: var(--primary-gold);
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        .btn-profile,
        .btn-logout {
            padding: 0.7rem 1.5rem;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: 2px solid var(--primary-gold);
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: inline-block;
        }

        .btn-profile {
            background: transparent;
            color: var(--primary-gold);
        }

        .btn-profile:hover {
            background: var(--primary-gold);
            color: var(--dark-brown);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 165, 116, 0.3);
        }

        .btn-logout {
            background: transparent;
            color: rgba(245, 230, 211, 0.6);
            border-color: rgba(245, 230, 211, 0.3);
            font-size: 0.8rem;
        }

        .btn-logout:hover {
            background: rgba(255, 60, 60, 0.15);
            color: #ff6b6b;
            border-color: #ff6b6b;
            transform: translateY(-2px);
        }

        /* Menú hamburguesa */
        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            z-index: 101;
        }

        .menu-toggle span {
            width: 30px;
            height: 3px;
            background: var(--primary-gold);
            transition: all 0.3s ease;
        }

        .menu-toggle.active span:nth-child(1) { transform: rotate(45deg) translate(8px, 8px); }
        .menu-toggle.active span:nth-child(2) { opacity: 0; }
        .menu-toggle.active span:nth-child(3) { transform: rotate(-45deg) translate(7px, -7px); }

        /* ── HERO / WELCOME BANNER ── */
        .hero {
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 4rem 5%;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, var(--deep-amber) 0%, transparent 70%);
            opacity: 0.1;
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1);   opacity: 0.1;  }
            50%       { transform: scale(1.2); opacity: 0.15; }
        }

        .hero-content {
            max-width: 1200px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to   { opacity: 1; transform: translateY(0);    }
        }

        .hero-text h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 5rem;
            line-height: 0.95;
            color: var(--primary-gold);
            margin-bottom: 1.5rem;
            letter-spacing: 2px;
            text-shadow: 4px 4px 0 rgba(184, 134, 11, 0.3);
        }

        .hero-text h1 span {
            display: block;
            font-size: 3.5rem;
            color: var(--warm-cream);
            text-shadow: none;
            margin-top: 0.5rem;
        }

        /* Badge de bienvenida */
        .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(212, 165, 116, 0.15);
            border: 1px solid rgba(212, 165, 116, 0.4);
            padding: 0.5rem 1.2rem;
            font-size: 0.85rem;
            letter-spacing: 1px;
            font-weight: 600;
            color: var(--primary-gold);
            margin-bottom: 1.5rem;
            animation: fadeInUp 1s ease-out 0.1s both;
        }

        .welcome-badge::before {
            content: '✓';
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            background: var(--forest-green);
            color: #fff;
            font-size: 0.7rem;
            border-radius: 50%;
            font-weight: 700;
        }

        .hero-text p {
            font-size: 1.15rem;
            line-height: 1.8;
            margin-bottom: 2.5rem;
            color: rgba(245, 230, 211, 0.9);
            font-weight: 300;
        }

        /* Botones CTA del hero */
        .hero-ctas {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .cta-button {
            display: inline-block;
            padding: 1.2rem 3rem;
            background: linear-gradient(135deg, var(--primary-gold), var(--deep-amber));
            color: var(--dark-brown);
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: rgba(255, 255, 255, 0.3);
            transition: left 0.5s ease;
        }

        .cta-button:hover::before { left: 100%; }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(212, 165, 116, 0.4);
        }

        .cta-button-outline {
            display: inline-block;
            padding: 1.2rem 3rem;
            background: transparent;
            color: var(--primary-gold);
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 2px solid var(--primary-gold);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cta-button-outline:hover {
            background: rgba(212, 165, 116, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(212, 165, 116, 0.2);
        }

        /* ── ANIMACIÓN VASO DE CERVEZA (idéntica al welcome) ── */
        .hero-image {
            position: relative;
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .beer-container {
            position: relative;
            width: 100%;
            max-width: 450px;
            height: 650px;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 0 0 50% 50% / 0 0 30% 30%;
        }

        .beer-glass {
            width: 100%;
            height: 550px;
            background: linear-gradient(180deg,
                rgba(255, 193, 7, 0.1)  0%,
                rgba(255, 152, 0, 0.2) 30%,
                rgba(255, 111, 0, 0.3) 70%,
                rgba(230, 81,  0, 0.4) 100%
            );
            border-radius: 0 0 50% 50% / 0 0 30% 30%;
            position: absolute;
            bottom: 0; left: 0;
            box-shadow:
                inset 0 -50px 100px rgba(255, 193, 7, 0.3),
                0 20px 60px rgba(0, 0, 0, 0.5);
            animation: fillGlass 2.5s ease-out 1s both;
        }

        @keyframes fillGlass {
            from { clip-path: inset(100% 0 0 0); }
            to   { clip-path: inset(0 0 0 0);    }
        }

        .beer-glass::after {
            content: '';
            position: absolute;
            top: 20%; right: 10%;
            width: 40%; height: 60%;
            background: linear-gradient(135deg, rgba(255,255,255,0.4) 0%, transparent 50%);
            border-radius: 50%;
            filter: blur(20px);
        }

        .espuma {
            position: absolute;
            bottom: -50px; left: 0;
            width: 100%; height: 140px;
            background: radial-gradient(ellipse at center,
                rgba(255,255,255,0.95)  0%,
                rgba(255,248,220,0.9)  30%,
                rgba(255,248,220,0.7)  60%,
                rgba(255,248,220,0.5) 100%
            );
            animation: foamRise 2.5s ease-out 1s both, foamFloat 3s ease-in-out 3.5s infinite;
            filter: blur(2px);
            z-index: 10;
        }

        @keyframes foamRise {
            0%   { transform: translateY(0);      opacity: 0; }
            10%  { opacity: 1; }
            100% { transform: translateY(-540px); opacity: 1; }
        }

        @keyframes foamFloat {
            0%, 100% { transform: translateY(-540px) scale(1);    }
            50%       { transform: translateY(-548px) scale(1.03); }
        }

        .espuma::before, .espuma::after {
            content: '';
            position: absolute;
            background: radial-gradient(circle, rgba(255,255,255,0.9), rgba(255,248,220,0.6));
            border-radius: 50%;
        }

        .espuma::before { width:60px; height:60px; top:20px; left:20%;  animation: bubble 4s ease-in-out 3s   infinite; }
        .espuma::after  { width:50px; height:50px; top:35px; right:25%; animation: bubble 4s ease-in-out 3.5s infinite; }

        @keyframes bubble {
            0%,100% { transform: translateY(0)    scale(1);   opacity:0.8; }
            50%      { transform: translateY(-10px) scale(1.1); opacity:1;   }
        }

        /* ── STATS BANNER (nuevo, sólo en dashboard) ── */
        .stats-banner {
            padding: 3rem 5%;
            background: rgba(212, 165, 116, 0.06);
            border-top: 1px solid rgba(212, 165, 116, 0.2);
            border-bottom: 1px solid rgba(212, 165, 116, 0.2);
        }

        .stats-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: center;
        }

        .stat-item {
            animation: fadeInUp 0.8s ease-out both;
        }

        .stat-item:nth-child(1) { animation-delay: 0.1s; }
        .stat-item:nth-child(2) { animation-delay: 0.2s; }
        .stat-item:nth-child(3) { animation-delay: 0.3s; }
        .stat-item:nth-child(4) { animation-delay: 0.4s; }

        .stat-number {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3.5rem;
            color: var(--primary-gold);
            line-height: 1;
            letter-spacing: 2px;
        }

        .stat-label {
            font-size: 0.8rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(245, 230, 211, 0.6);
            font-weight: 600;
            margin-top: 0.4rem;
        }

        /* ── FEATURES SECTION (idéntica al welcome) ── */
        .features {
            padding: 6rem 5%;
            background: linear-gradient(180deg, var(--dark-brown) 0%, #1a0f0a 100%);
        }

        .features-title {
            text-align: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3.5rem;
            color: var(--primary-gold);
            margin-bottom: 4rem;
            letter-spacing: 3px;
        }

        .features-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 3rem;
        }

        .feature-card {
            background: rgba(245, 230, 211, 0.05);
            padding: 2.5rem;
            border: 2px solid var(--primary-gold);
            position: relative;
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            animation: fadeInUp 1s ease-out both;
            text-decoration: none;
            display: block;
            color: inherit;
        }

        .feature-card:nth-child(1) { animation-delay: 0.2s; }
        .feature-card:nth-child(2) { animation-delay: 0.4s; }
        .feature-card:nth-child(3) { animation-delay: 0.6s; }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212,165,116,0.1), transparent);
            transition: left 0.6s ease;
        }

        .feature-card:hover::before { left: 100%; }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(212, 165, 116, 0.2);
        }

        /* Indicador de "disponible" en las cards del dashboard */
        .card-badge {
            position: absolute;
            top: 1rem; right: 1rem;
            background: var(--forest-green);
            color: #fff;
            font-size: 0.65rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 0.25rem 0.6rem;
            font-weight: 700;
        }

        /* Badge de "próximamente" — ámbar en vez de verde */
        .card-badge-soon {
            background: var(--deep-amber);
        }

        .feature-icon {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .feature-card h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            color: var(--primary-gold);
            margin-bottom: 1rem;
            letter-spacing: 2px;
        }

        .feature-card p {
            color: rgba(245, 230, 211, 0.8);
            line-height: 1.7;
            font-weight: 300;
        }

        .card-cta {
            display: inline-block;
            margin-top: 1.5rem;
            color: var(--primary-gold);
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            border-bottom: 1px solid var(--primary-gold);
            padding-bottom: 2px;
            transition: letter-spacing 0.3s ease;
        }

        .feature-card:hover .card-cta {
            letter-spacing: 3px;
        }

        /* ── FOOTER ── */
        footer {
            padding: 2.5rem 5%;
            border-top: 2px solid rgba(212, 165, 116, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            background: rgba(20, 10, 5, 0.5);
        }

        .footer-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.4rem;
            letter-spacing: 3px;
            color: var(--primary-gold);
            opacity: 0.7;
        }

        .footer-text {
            font-size: 0.8rem;
            color: rgba(245, 230, 211, 0.4);
            letter-spacing: 1px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .logo { font-size: 1.8rem; }
            .logo::after { right: -35px; font-size: 1.6rem; }
            nav { gap: 1.5rem; }
            nav a { font-size: 0.85rem; }
            .hero-text h1 { font-size: 4rem; }
            .hero-text h1 span { font-size: 3rem; }
        }

        @media (max-width: 968px) {
            header { padding: 1.5rem 4%; }

            .nav-container {
                position: fixed;
                top: 0; right: -100%;
                height: 100vh; width: 300px;
                background: rgba(44, 24, 16, 0.98);
                backdrop-filter: blur(20px);
                flex-direction: column;
                padding: 5rem 2rem 2rem;
                gap: 2rem;
                transition: right 0.4s ease;
                border-left: 2px solid var(--primary-gold);
                box-shadow: -5px 0 20px rgba(0,0,0,0.5);
            }

            .nav-container.active { right: 0; }

            nav { flex-direction: column; gap: 1.5rem; width: 100%; }
            nav a { font-size: 1rem; padding: 0.5rem 0; width: 100%; text-align: center; }

            .auth-buttons {
                flex-direction: column;
                width: 100%; gap: 1rem;
            }

            .btn-profile, .btn-logout {
                width: 100%; text-align: center; padding: 1rem 1.5rem; font-size: 0.9rem;
            }

            .user-greeting { text-align: center; }

            .menu-toggle { display: flex; }

            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 3rem;
            }

            .hero-text h1 { font-size: 3.5rem; }
            .hero-text h1 span { font-size: 2.5rem; }
            .hero-ctas { justify-content: center; }

            .beer-container { max-width: 350px; height: 550px; }
            .beer-glass { height: 450px; }

            .espuma {
                animation: foamRiseResponsiveMedium 2.5s ease-out 1s both,
                           foamFloatResponsiveMedium 3s ease-in-out 3.5s infinite;
            }

            @keyframes foamRiseResponsiveMedium {
                0%   { transform: translateY(0);      opacity: 0; }
                10%  { opacity: 1; }
                100% { transform: translateY(-440px); opacity: 1; }
            }

            @keyframes foamFloatResponsiveMedium {
                0%,100% { transform: translateY(-440px) scale(1);    }
                50%      { transform: translateY(-448px) scale(1.03); }
            }

            .features-grid { grid-template-columns: 1fr; gap: 2rem; }
        }

        @media (max-width: 640px) {
            header { padding: 1rem 4%; }
            .logo { font-size: 1.5rem; letter-spacing: 2px; }
            .logo::after { right: -30px; font-size: 1.4rem; top: -3px; }
            .nav-container { width: 280px; }
            .hero { min-height: auto; padding: 3rem 4% 4rem; }
            .hero-content { gap: 2rem; }
            .hero-text h1 { font-size: 2.5rem; margin-bottom: 1rem; }
            .hero-text h1 span { font-size: 1.8rem; }
            .hero-text p { font-size: 1rem; margin-bottom: 2rem; }
            .cta-button, .cta-button-outline { padding: 1rem 2rem; font-size: 0.9rem; width: 100%; text-align: center; }
            .beer-container { max-width: 280px; height: 480px; }
            .beer-glass { height: 380px; }

            .espuma {
                animation: foamRiseResponsiveSmall 2.5s ease-out 1s both,
                           foamFloatResponsiveSmall 3s ease-in-out 3.5s infinite;
            }

            @keyframes foamRiseResponsiveSmall {
                0%   { transform: translateY(0);      opacity: 0; }
                10%  { opacity: 1; }
                100% { transform: translateY(-370px); opacity: 1; }
            }

            @keyframes foamFloatResponsiveSmall {
                0%,100% { transform: translateY(-370px) scale(1);    }
                50%      { transform: translateY(-378px) scale(1.03); }
            }

            .features { padding: 4rem 4%; }
            .features-title { font-size: 2.5rem; margin-bottom: 2.5rem; }
            .feature-card { padding: 2rem; }
            .feature-icon { font-size: 3rem; }
            .feature-card h3 { font-size: 1.5rem; }
            .feature-card p { font-size: 0.95rem; }
            .stat-number { font-size: 2.5rem; }
        }

        @media (max-width: 400px) {
            .logo { font-size: 1.3rem; }
            .hero-text h1 { font-size: 2rem; }
            .hero-text h1 span { font-size: 1.5rem; }
            .beer-container { max-width: 240px; height: 420px; }
            .beer-glass { height: 330px; }
            .espuma { height: 120px; }
            .features-title { font-size: 2rem; }
        }
    </style>
</head>
<body>
<div class="container">

    {{-- ═══════════════════════════════════════════
         HEADER — mismo estilo que welcome, 
         pero con enlaces desbloqueados + menú de usuario
    ════════════════════════════════════════════ --}}
    <header>
        <a href="{{ url('/') }}" class="logo">CERVECERÍA TÍO MINGO</a>

        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="nav-container" id="navContainer">
            <nav>
                <a href="{{ route('cervezas') }}">Cervezas</a>
                <a href="#">Nosotros</a>
                <a href="#">Tienda</a>
                <a href="{{ route('pedidos.index') }}">Pedidos</a>
            </nav>




            <div class="auth-buttons">
                {{-- Saludo al usuario autenticado --}}
                <span class="user-greeting">
                    ¡Hola, {{ Auth::user()->nombre }}!
                </span>

                {{-- Botón perfil --}}
                <a href="{{ route('profile.edit') }}" class="btn-profile">Mi Perfil</a>

                {{-- Cerrar sesión (form POST para CSRF) --}}
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Salir</button>
                </form>
            </div>
        </div>
    </header>

    {{-- ═══════════════════════════════════════════
         HERO — igual que welcome, 
         pero con texto personalizado + doble CTA
    ════════════════════════════════════════════ --}}
    <section class="hero">
        <div class="hero-content">
            <div class="hero-text">

                {{-- Badge de sesión activa --}}
                <div class="welcome-badge">
                    Sesión activa — {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}
                </div>

                <h1>
                    BIENVENIDO DE NUEVO
                    <span>A Tu Cervecería</span>
                </h1>
                <p>
                    Ya tienes acceso completo a todo lo que Cervecería Tío Mingo
                    tiene para ofrecerte. Explora nuestro catálogo de cervezas
                    artesanales, conoce nuestra historia y visita la tienda.
                </p>

                <div class="hero-ctas">
                    <a href="#" class="cta-button">Ver Cervezas</a>
                    <a href="#" class="cta-button-outline">Ir a la Tienda</a>
                </div>
            </div>

            {{-- Animación vaso de cerveza — idéntica al welcome --}}
            <div class="hero-image">
                <div class="beer-container">
                    <div class="espuma"></div>
                    <div class="beer-glass"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         STATS — bloque exclusivo del dashboard
    ════════════════════════════════════════════ --}}
    <section class="stats-banner">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">12+</div>
                <div class="stat-label">Estilos de Cerveza</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">100%</div>
                <div class="stat-label">Natural</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">3</div>
                <div class="stat-label">Premios Ganados</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">∞</div>
                <div class="stat-label">Años de Pasión</div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         FEATURES — igual que welcome, 
         pero las cards son clicables y tienen badge
    ════════════════════════════════════════════ --}}
    <section class="features">
        <h2 class="features-title">¿Qué Quieres Explorar?</h2>
        <div class="features-grid">

            <a href="#" class="feature-card">
                <span class="card-badge card-badge-soon">Próximamente</span>
                <h3>Nuestras Cervezas</h3>
                <p>
                    Descubre toda nuestra gama de cervezas artesanales. 
                    Desde IPA refrescantes hasta stouts oscuras y aterciopeladas.
                </p>
                <span class="card-cta">Explorar catálogo →</span>
            </a>

            <a href="#" class="feature-card">
                <span class="card-badge card-badge-soon">Próximamente</span>
                <span class="feature-icon">⚗️</span>
                <h3>Nuestra Historia</h3>
                <p>
                    Conoce el proceso artesanal y la historia detrás de 
                    cada receta perfeccionada por generaciones de maestros cerveceros.
                </p>
                <span class="card-cta">Conocer más →</span>
            </a>

            <a href="#" class="feature-card">
                <span class="card-badge card-badge-soon">Próximamente</span>
                <span class="feature-icon">🏆</span>
                <h3>Tienda Online</h3>
                <p>
                    Pide directamente desde casa. Envíos rápidos y seguros 
                    para que nunca te falte tu cerveza favorita.
                </p>
                <span class="card-cta">Ir a la tienda →</span>
            </a>

        </div>
    </section>

    {{-- Footer mínimo --}}
    <footer>
        <div class="footer-logo">CERVECERÍA TÍO MINGO</div>
        <div class="footer-text">© {{ date('Y') }} — Hecho con pasión 🍺</div>
    </footer>

</div>

<script>
    function toggleMenu() {
        const navContainer = document.getElementById('navContainer');
        const menuToggle   = document.querySelector('.menu-toggle');
        navContainer.classList.toggle('active');
        menuToggle.classList.toggle('active');
    }

    // Cerrar menú al hacer clic en cualquier enlace
    document.querySelectorAll('.nav-container a, .nav-container button').forEach(el => {
        el.addEventListener('click', () => {
            document.getElementById('navContainer').classList.remove('active');
            document.querySelector('.menu-toggle').classList.remove('active');
        });
    });

    // Cerrar menú al hacer clic fuera
    document.addEventListener('click', (e) => {
        const navContainer = document.getElementById('navContainer');
        const menuToggle   = document.querySelector('.menu-toggle');
        if (!navContainer.contains(e.target) && !menuToggle.contains(e.target)) {
            navContainer.classList.remove('active');
            menuToggle.classList.remove('active');
        }
    });
</script>
</body>
</html>