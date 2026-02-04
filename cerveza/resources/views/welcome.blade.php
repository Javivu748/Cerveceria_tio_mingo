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
            padding: 2rem 5%;
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
            font-size: 2.5rem;
            letter-spacing: 3px;
            color: var(--primary-gold);
            text-shadow: 3px 3px 0 var(--deep-amber);
            position: relative;
        }

        .logo::after {
            content: '🍺';
            position: absolute;
            right: -50px;
            top: -5px;
            font-size: 2rem;
        }

        

        nav {
            display: flex;
            gap: 2.5rem;
        }

        nav a {
            color: var(--warm-cream);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            position: relative;
            transition: color 0.3s ease;
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

        .beer-glass {
            width: 100%;
            max-width: 450px;
            height: 550px;
            background: linear-gradient(180deg, 
                rgba(255, 193, 7, 0.1) 0%,
                rgba(255, 152, 0, 0.2) 30%,
                rgba(255, 111, 0, 0.3) 70%,
                rgba(230, 81, 0, 0.4) 100%
            );
            border-radius: 0 0 50% 50% / 0 0 30% 30%;
            position: relative;
            margin: 0 auto;
            box-shadow: 
                inset 0 -50px 100px rgba(255, 193, 7, 0.3),
                0 20px 60px rgba(0, 0, 0, 0.5);
            animation: fillGlass 2s ease-out 1s both;
        }

        @keyframes fillGlass {
            from {
                clip-path: inset(100% 0 0 0);
            }
            to {
                clip-path: inset(0 0 0 0);
            }
        }

        .beer-glass::before {
            content: '';
            position: absolute;
            top: -80px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            height: 80px;
            background: radial-gradient(ellipse at center, 
                rgba(255, 255, 255, 0.8) 0%,
                rgba(255, 255, 255, 0.4) 50%,
                transparent 100%
            );
            border-radius: 50%;
            animation: foam 3s ease-in-out infinite;
        }

        @keyframes foam {
            0%, 100% { transform: translateX(-50%) scale(1); }
            50% { transform: translateX(-50%) scale(1.05); }
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

        /* Responsive */
        @media (max-width: 968px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-text h1 {
                font-size: 3.5rem;
            }

            .hero-text h1 span {
                font-size: 2.5rem;
            }

            nav {
                gap: 1.5rem;
            }

            .logo {
                font-size: 2rem;
            }

            .beer-glass {
                max-width: 350px;
                height: 450px;
            }
        }

        @media (max-width: 640px) {
            header {
                flex-direction: column;
                gap: 1.5rem;
            }

            nav {
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .hero-text h1 span {
                font-size: 1.8rem;
            }

            .features-title {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">TÍO MINGO</div>
            <nav>
                <a href="#cervezas">Cervezas</a>
                <a href="#nosotros">Nosotros</a>
                <a href="#tienda">Tienda</a>
                <a href="#contacto">Contacto</a>
            </nav>
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
                    <a href="#tienda" class="cta-button">Descubre Nuestras Cervezas</a>
                </div>
                <div class="hero-image">
                    <div class="beer-glass"></div>
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
</body> 
</html>