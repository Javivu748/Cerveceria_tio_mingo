<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - Cervecería Tío Mingo</title>
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
            --danger: #ff6b6b;
            --success: #51cf66;
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

        .btn-logout {
            padding: 0.7rem 1.5rem;
            background: transparent;
            color: rgba(245, 230, 211, 0.6);
            border: 2px solid rgba(245, 230, 211, 0.3);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: inline-block;
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
            gap: 6px;
            cursor: pointer;
            background: none;
            border: none;
        }

        .menu-toggle span {
            width: 28px;
            height: 3px;
            background: var(--primary-gold);
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        /* ── MAIN CONTENT ── */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 5%;
        }

        .page-header {
            margin-bottom: 3rem;
            animation: fadeInUp 0.8s ease-out;
        }

        .page-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3rem;
            letter-spacing: 2px;
            color: var(--primary-gold);
            text-shadow: 2px 2px 0 var(--deep-amber);
            margin-bottom: 0.5rem;
        }

        /* FORMULARIO */
        .form-section {
            background: rgba(212, 165, 116, 0.05);
            border: 2px solid var(--primary-gold);
            border-radius: 8px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(212, 165, 116, 0.15);
            animation: fadeInUp 0.8s ease-out 0.1s both;
        }

        .form-title {
            font-size: 1.6rem;
            color: var(--primary-gold);
            margin-bottom: 2rem;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 1.8rem;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            color: rgba(245, 230, 211, 0.8);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.7rem;
            font-weight: 600;
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            background: rgba(212, 165, 116, 0.08);
            border: 2px solid rgba(212, 165, 116, 0.3);
            border-radius: 6px;
            color: var(--warm-cream);
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-gold);
            background: rgba(212, 165, 116, 0.12);
            box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.1);
        }

        .form-input::placeholder {
            color: rgba(245, 230, 211, 0.5);
        }

        /* Botones del formulario */
        .form-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2.5rem;
        }

        .btn-primary {
            flex: 1;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--primary-gold), var(--deep-amber));
            color: var(--dark-brown);
            border: none;
            border-radius: 6px;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(212, 165, 116, 0.3);
        }

        .btn-secondary {
            flex: 1;
            padding: 1rem 2rem;
            background: transparent;
            color: var(--primary-gold);
            border: 2px solid var(--primary-gold);
            border-radius: 6px;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-secondary:hover {
            background: rgba(212, 165, 116, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(212, 165, 116, 0.2);
        }

        /* Mensajes de error */
        .error-message {
            color: #ff6b6b;
            font-size: 0.8rem;
            margin-top: 0.5rem;
            display: block;
        }

        .form-group.has-error .form-input {
            border-color: #ff6b6b;
            background: rgba(255, 107, 107, 0.05);
        }

        /* Mensajes de éxito */
        .success-alert {
            background: rgba(81, 207, 102, 0.1);
            border: 2px solid var(--success);
            color: var(--success);
            padding: 1.5rem;
            border-radius: 6px;
            margin-bottom: 2rem;
            animation: fadeInUp 0.5s ease-out;
        }

        /* ── FOOTER ── */
        footer {
            margin-top: 5rem;
            padding: 3rem 5%;
            border-top: 2px solid var(--primary-gold);
            text-align: center;
            background: rgba(44, 24, 16, 0.5);
        }

        .footer-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.5rem;
            letter-spacing: 2px;
            color: var(--primary-gold);
            margin-bottom: 0.5rem;
        }

        .footer-text {
            font-size: 0.9rem;
            color: rgba(245, 230, 211, 0.7);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
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

            .menu-toggle {
                display: flex;
            }

            .nav-container {
                position: absolute;
                top: 70px;
                left: 0;
                right: 0;
                flex-direction: column;
                background: rgba(44, 24, 16, 0.98);
                padding: 2rem;
                gap: 1rem;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
                border-bottom: 2px solid var(--primary-gold);
            }

            .nav-container.active {
                max-height: 400px;
            }

            nav {
                flex-direction: column;
                gap: 1rem;
                width: 100%;
            }

            nav a {
                display: block;
                padding: 0.5rem 0;
            }

            .auth-buttons {
                flex-direction: column;
                width: 100%;
            }

            .main-content {
                padding: 2rem 4%;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .form-section {
                padding: 1.5rem;
            }

            .form-buttons {
                flex-direction: column;
            }

            .btn-primary, .btn-secondary {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .logo {
                font-size: 1.2rem;
                letter-spacing: 1px;
            }

            .logo::after {
                right: -25px;
                font-size: 1.2rem;
            }

            .page-header h1 {
                font-size: 1.8rem;
            }

            .main-content {
                padding: 1.5rem 3%;
            }

            .form-section {
                padding: 1.2rem;
            }

            .form-input {
                padding: 0.8rem;
                font-size: 0.95rem;
            }

            .btn-primary, .btn-secondary {
                padding: 0.8rem 1.5rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    {{-- HEADER --}}
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
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </nav>

            <div class="auth-buttons">
                <span class="user-greeting">{{ Auth::user()->nombre }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <section class="main-content">
        <div class="page-header">
            <h1>Editar Perfil ✏️</h1>
        </div>

        {{-- FORMULARIO DE EDICIÓN --}}
        <div class="form-section">
            <h2 class="form-title">Actualiza tu información</h2>

            @if ($errors->any())
                <div class="error-alert" style="background: rgba(255, 107, 107, 0.1); border: 2px solid #ff6b6b; color: #ff6b6b; padding: 1.5rem; border-radius: 6px; margin-bottom: 2rem;">
                    <strong>⚠️ Error al actualizar:</strong>
                    <ul style="margin-top: 0.5rem; padding-left: 1.5rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('PATCH')

                {{-- Nombre --}}
                <div class="form-group @error('nombre') has-error @enderror">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input 
                        type="text" 
                        id="nombre" 
                        name="nombre" 
                        class="form-input" 
                        value="{{ old('nombre', $user->nombre) }}"
                        placeholder="Ingresa tu nombre"
                        required
                    >
                    @error('nombre')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Apellido --}}
                <div class="form-group @error('apellido') has-error @enderror">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input 
                        type="text" 
                        id="apellido" 
                        name="apellido" 
                        class="form-input" 
                        value="{{ old('apellido', $user->apellido) }}"
                        placeholder="Ingresa tu apellido"
                        required
                    >
                    @error('apellido')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Teléfono --}}
                <div class="form-group @error('telefono') has-error @enderror">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input 
                        type="tel" 
                        id="telefono" 
                        name="telefono" 
                        class="form-input" 
                        value="{{ old('telefono', $user->telefono) }}"
                        placeholder="Ingresa tu teléfono"
                    >
                    @error('telefono')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

               
                {{-- Botones --}}
                <div class="form-buttons">
                    <button type="submit" class="btn-primary">💾 Guardar Cambios</button>
                    <a href="{{ route('user.profile', $user->id) }}" class="btn-secondary">↩️ Cancelar</a>
                </div>
            </form>
        </div>
    </section>

    {{-- FOOTER --}}
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
