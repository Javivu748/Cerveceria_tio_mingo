<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cervecería Tío Mingo - Cerveza Artesanal de Calidad</title>
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

        /* Header */
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
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            letter-spacing: 3px;
            color: var(--primary-gold);
            text-shadow: 3px 3px 0 var(--deep-amber);
            position: relative;
            white-space: nowrap;
        }

        .logo::after {
            content: '🍺';
            position: absolute;
            right: -40px;
            top: -5px;
            font-size: 1.8rem;
        }

        /* Contenedor de navegación */
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

        nav a:hover {
            color: var(--primary-gold);
        }

        nav a:hover::after {
            width: 100%;
        }

        /* Icono de candado junto a los links de nav protegidos */
        nav a.protected::before {
            content: '🔒';
            font-size: 0.7rem;
            margin-right: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
            vertical-align: middle;
        }

        nav a.protected:hover::before {
            opacity: 1;
        }

        /* Botones de autenticación */
        .auth-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-login,
        .btn-register,
        .btn-dashboard {
            padding: 0.7rem 1.5rem;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: 2px solid var(--primary-gold);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: inline-block;
        }

        .btn-login {
            background: transparent;
            color: var(--primary-gold);
        }

        .btn-login:hover {
            background: var(--primary-gold);
            color: var(--dark-brown);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 165, 116, 0.3);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary-gold), var(--deep-amber));
            color: var(--dark-brown);
            border: 2px solid var(--primary-gold);
        }

        .btn-register:hover {
            background: linear-gradient(135deg, var(--deep-amber), var(--copper));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 165, 116, 0.4);
        }

        .btn-dashboard {
            background: linear-gradient(135deg, var(--forest-green), #0f4c28);
            color: var(--warm-cream);
            border: 2px solid var(--forest-green);
        }

        .btn-dashboard:hover {
            background: linear-gradient(135deg, #0f4c28, var(--forest-green));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(27, 67, 50, 0.4);
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

        .menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }

        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }

        /* Hero Section */
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
            0%, 100% { transform: scale(1); opacity: 0.1; }
            50% { transform: scale(1.2); opacity: 0.15; }
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
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        .hero-text p {
            font-size: 1.15rem;
            line-height: 1.8;
            margin-bottom: 2.5rem;
            color: rgba(245, 230, 211, 0.9);
            font-weight: 300;
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
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.3);
            transition: left 0.5s ease;
        }

        .cta-button:hover::before {
            left: 100%;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(212, 165, 116, 0.4);
        }

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
                rgba(255, 193, 7, 0.1) 0%,
                rgba(255, 152, 0, 0.2) 30%,
                rgba(255, 111, 0, 0.3) 70%,
                rgba(230, 81, 0, 0.4) 100%
            );
            border-radius: 0 0 50% 50% / 0 0 30% 30%;
            position: absolute;
            bottom: 0;
            left: 0;
            box-shadow: 
                inset 0 -50px 100px rgba(255, 193, 7, 0.3),
                0 20px 60px rgba(0, 0, 0, 0.5);
            animation: fillGlass 2.5s ease-out 1s both;
        }

        @keyframes fillGlass {
            from {
                clip-path: inset(100% 0 0 0);
            }
            to {
                clip-path: inset(0 0 0 0);
            }
        }

        .beer-glass::after {
            content: '';
            position: absolute;
            top: 20%;
            right: 10%;
            width: 40%;
            height: 60%;
            background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.4) 0%,
                transparent 50%
            );
            border-radius: 50%;
            filter: blur(20px);
        }

        .espuma {
            position: absolute;
            bottom: -50px;
            left: 0; 
            width: 100%;
            height: 140px;
            background: radial-gradient(ellipse at center, 
                rgba(255, 255, 255, 0.95) 0%,
                rgba(255, 248, 220, 0.9) 30%,
                rgba(255, 248, 220, 0.7) 60%,
                rgba(255, 248, 220, 0.5) 100%
            );
            animation: foamRise 2.5s ease-out 1s both, foamFloat 3s ease-in-out 3.5s infinite;
            filter: blur(2px);
            z-index: 10;
        }

        @keyframes foamRise {
            0% {
                transform: translateY(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            100% {
                transform: translateY(-540px); 
                opacity: 1;
            }
        }

        @keyframes foamFloat {
            0%, 100% { 
                transform: translateY(-540px) scale(1); 
            }
            50% { 
                transform: translateY(-548px) scale(1.03); 
            }
        }

        .espuma::before,
        .espuma::after {
            content: '';
            position: absolute;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.9), rgba(255, 248, 220, 0.6));
            border-radius: 50%;
            animation: bubble 4s ease-in-out 3s infinite; 
        }

        .espuma::before {
            width: 60px;
            height: 60px;
            top: 20px;
            left: 20%;
            animation-delay: 3s;
        }

        .espuma::after {
            width: 50px;
            height: 50px;
            top: 35px;
            right: 25%;
            animation-delay: 3.5s;
        }

        @keyframes bubble {
            0%, 100% { 
                transform: translateY(0) scale(1);
                opacity: 0.8;
            }
            50% { 
                transform: translateY(-10px) scale(1.1);
                opacity: 1;
            }
        }

        .bubble {
            position: absolute;
            background: radial-gradient(circle at 30% 30%, 
                rgba(255, 255, 255, 0.9), 
                rgba(255, 248, 220, 0.6)
            );
            border-radius: 50%;
            animation: bubbleRise 3s ease-in-out infinite;
        }
        
        .bubble:nth-child(1) {
            width: 40px; height: 40px; top: -10px; left: 15%; animation-delay: 1.5s;
        }
        .bubble:nth-child(2) {
            width: 35px; height: 35px; top: 5px; left: 40%; animation-delay: 2s;
        }
        .bubble:nth-child(3) {
            width: 45px; height: 45px; top: -5px; right: 15%; animation-delay: 2.5s;
        }
        .bubble:nth-child(4) {
            width: 30px; height: 30px; top: 10px; right: 35%; animation-delay: 2.2s;
        }

        @keyframes bubbleRise {
            0%, 100% { 
                transform: translateY(0) scale(1);
                opacity: 0.7;
            }
            50% { 
                transform: translateY(-15px) scale(1.15);
                opacity: 1;
            }
        }

        /* Features Section */
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
            border-radius: 0;
            position: relative;
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            animation: fadeInUp 1s ease-out both;
        }

        .feature-card:nth-child(1) { animation-delay: 0.2s; }
        .feature-card:nth-child(2) { animation-delay: 0.4s; }
        .feature-card:nth-child(3) { animation-delay: 0.6s; }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 165, 116, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(212, 165, 116, 0.2);
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

        /* Responsive - Tablet */
        @media (max-width: 1024px) {
            .logo {
                font-size: 1.8rem;
            }

            .logo::after {
                right: -35px;
                font-size: 1.6rem;
            }

            nav {
                gap: 1.5rem;
            }

            nav a {
                font-size: 0.85rem;
            }

            .auth-buttons {
                gap: 0.8rem;
            }

            .btn-login,
            .btn-register,
            .btn-dashboard {
                padding: 0.6rem 1.2rem;
                font-size: 0.8rem;
            }

            .hero-text h1 {
                font-size: 4rem;
            }

            .hero-text h1 span {
                font-size: 3rem;
            }
        }

        /* Responsive - Tablet pequeña */
        @media (max-width: 968px) {
            header {
                padding: 1.5rem 4%;
            }

            .nav-container {
                position: fixed;
                top: 0;
                right: -100%;
                height: 100vh;
                width: 300px;
                background: rgba(44, 24, 16, 0.98);
                backdrop-filter: blur(20px);
                flex-direction: column;
                padding: 5rem 2rem 2rem;
                gap: 2rem;
                transition: right 0.4s ease;
                border-left: 2px solid var(--primary-gold);
                box-shadow: -5px 0 20px rgba(0, 0, 0, 0.5);
            }

            .nav-container.active {
                right: 0;
            }

            nav {
                flex-direction: column;
                gap: 1.5rem;
                width: 100%;
            }

            nav a {
                font-size: 1rem;
                padding: 0.5rem 0;
                width: 100%;
                text-align: center;
            }

            .auth-buttons {
                flex-direction: column;
                width: 100%;
                gap: 1rem;
            }

            .btn-login,
            .btn-register,
            .btn-dashboard {
                width: 100%;
                text-align: center;
                padding: 1rem 1.5rem;
                font-size: 0.9rem;
            }

            .menu-toggle {
                display: flex;
            }

            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 3rem;
            }

            .hero-text h1 {
                font-size: 3.5rem;
            }

            .hero-text h1 span {
                font-size: 2.5rem;
            }

            .beer-container {
                max-width: 350px;
                height: 550px;
            }

            .beer-glass {
                height: 450px;
            }

            .espuma {
                animation: foamRiseResponsiveMedium 2.5s ease-out 1s both, foamFloatResponsiveMedium 3s ease-in-out 3.5s infinite;
            }

            @keyframes foamRiseResponsiveMedium {
                0% { transform: translateY(0); opacity: 0; }
                10% { opacity: 1; }
                100% { transform: translateY(-440px); opacity: 1; }
            }

            @keyframes foamFloatResponsiveMedium {
                0%, 100% { transform: translateY(-440px) scale(1); }
                50% { transform: translateY(-448px) scale(1.03); }
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        /* Responsive - Móvil */
        @media (max-width: 640px) {
            header {
                padding: 1rem 4%;
            }

            .logo {
                font-size: 1.5rem;
                letter-spacing: 2px;
            }

            .logo::after {
                right: -30px;
                font-size: 1.4rem;
                top: -3px;
            }

            .nav-container {
                width: 280px;
            }

            .hero {
                min-height: auto;
                padding: 3rem 4% 4rem;
            }

            .hero-content {
                gap: 2rem;
            }

            .hero-text h1 {
                font-size: 2.5rem;
                margin-bottom: 1rem;
            }

            .hero-text h1 span {
                font-size: 1.8rem;
            }

            .hero-text p {
                font-size: 1rem;
                margin-bottom: 2rem;
            }

            .cta-button {
                padding: 1rem 2rem;
                font-size: 0.9rem;
                width: 100%;
                text-align: center;
            }

            .beer-container {
                max-width: 280px;
                height: 480px;
            }

            .beer-glass {
                height: 380px;
            }

            .espuma {
                animation: foamRiseResponsiveSmall 2.5s ease-out 1s both, foamFloatResponsiveSmall 3s ease-in-out 3.5s infinite;
            }

            @keyframes foamRiseResponsiveSmall {
                0% { transform: translateY(0); opacity: 0; }
                10% { opacity: 1; }
                100% { transform: translateY(-370px); opacity: 1; }
            }

            @keyframes foamFloatResponsiveSmall {
                0%, 100% { transform: translateY(-370px) scale(1); }
                50% { transform: translateY(-378px) scale(1.03); }
            }

            .features {
                padding: 4rem 4%;
            }

            .features-title {
                font-size: 2.5rem;
                margin-bottom: 2.5rem;
            }

            .feature-card {
                padding: 2rem;
            }

            .feature-icon {
                font-size: 3rem;
            }

            .feature-card h3 {
                font-size: 1.5rem;
            }

            .feature-card p {
                font-size: 0.95rem;
            }
        }

        /* Responsive - Móvil pequeño */
        @media (max-width: 400px) {
            .logo {
                font-size: 1.3rem;
            }

            .hero-text h1 {
                font-size: 2rem;
            }

            .hero-text h1 span {
                font-size: 1.5rem;
            }

            .beer-container {
                max-width: 240px;
                height: 420px;
            }

            .beer-glass {
                height: 330px;
            }

            .espuma {
                height: 120px;
            }

            @keyframes foamRiseResponsiveSmall {
                0% { transform: translateY(0); opacity: 0; }
                10% { opacity: 1; }
                100% { transform: translateY(-320px); opacity: 1; }
            }

            @keyframes foamFloatResponsiveSmall {
                0%, 100% { transform: translateY(-320px) scale(1); }
                50% { transform: translateY(-328px) scale(1.03); }
            }

            .features-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">CERVECERÍA TÍO MINGO</div>
            
            <div class="menu-toggle" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="nav-container" id="navContainer">
                <nav>
<<<<<<< HEAD
                    {{-- 
                        Si el usuario está autenticado, los enlaces van a sus secciones normales.
                        Si NO está autenticado, redirigen al login para indicar que necesita sesión.
                    --}}
                    @auth
                        <a href="#cervezas">Cervezas</a>
                        <a href="#nosotros">Nosotros</a>
                        <a href="#tienda">Tienda</a>
                    @else
                        <a href="{{ route('login') }}" class="protected">Cervezas</a>
                        <a href="{{ route('login') }}" class="protected">Nosotros</a>
                        <a href="{{ route('login') }}" class="protected">Tienda</a>
                    @endauth
=======
                    <a href="{{ url('/cerveza') }}">Cervezas</a>
                    <a href="#nosotros">Nosotros</a>
                    <a href="#tienda">Tienda</a>
>>>>>>> 50954484a8fca17c988b1943c111808b85fc981d
                </nav>
                
                <div class="auth-buttons">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-dashboard">
                                Ir al Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-login">
                                Iniciar Sesión
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-register">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        <section class="hero">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>
                        CERVEZA ARTESANAL
                        <span>Hecha con Pasión</span>
                    </h1>
                    <p>
                        En Cervecería Tío Mingo, cada gota cuenta una historia. 
                        Elaboramos cerveza artesanal de calidad premium usando recetas 
                        tradicionales y los mejores ingredientes naturales.
                    </p>
                    <a href="{{ route('login') }}" class="cta-button">Descubre Nuestras Cervezas</a>
                </div>
                <div class="hero-image">
                    <div class="beer-container">
                        <div class="espuma"></div>
                        <div class="beer-glass"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="features">
            <h2 class="features-title">¿Por Qué Tío Mingo?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <span class="feature-icon">🌾</span>
                    <h3>100% Natural</h3>
                    <p>
                        Usamos únicamente ingredientes naturales de primera calidad. 
                        Sin conservantes ni aditivos artificiales.
                    </p>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">⚗️</span>
                    <h3>Receta Artesanal</h3>
                    <p>
                        Cada lote es elaborado cuidadosamente siguiendo procesos 
                        tradicionales perfeccionados por generaciones.
                    </p>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">🏆</span>
                    <h3>Sabor Premium</h3>
                    <p>
                        Nuestras cervezas han ganado múltiples reconocimientos por 
                        su excepcional sabor y calidad inigualable.
                    </p>
                </div>
            </div>
        </section>
    </div>

    <script>
        function toggleMenu() {
            const navContainer = document.getElementById('navContainer');
            const menuToggle = document.querySelector('.menu-toggle');
            
            navContainer.classList.toggle('active');
            menuToggle.classList.toggle('active');
        }

        // Cerrar menú al hacer clic en un enlace
        document.querySelectorAll('.nav-container a').forEach(link => {
            link.addEventListener('click', () => {
                const navContainer = document.getElementById('navContainer');
                const menuToggle = document.querySelector('.menu-toggle');
                
                navContainer.classList.remove('active');
                menuToggle.classList.remove('active');
            });
        });

        // Cerrar menú al hacer clic fuera de él
        document.addEventListener('click', (e) => {
            const navContainer = document.getElementById('navContainer');
            const menuToggle = document.querySelector('.menu-toggle');
            
            if (!navContainer.contains(e.target) && !menuToggle.contains(e.target)) {
                navContainer.classList.remove('active');
                menuToggle.classList.remove('active');
            }
        });
    </script>
</body> 
</html>