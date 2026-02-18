<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Cervecería Tío Mingo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <style>
        /* TUS ESTILOS CSS ORIGINALES SE MANTIENEN IGUAL */
        :root {
            --primary-gold: #D4A574;
            --deep-amber: #B8860B;
            --dark-brown: #2C1810;
            --warm-cream: #F5E6D3;
            --forest-green: #1B4332;
            --copper: #B87333;
            --danger: #c0392b;
            --danger-light: #e74c3c;
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: repeating-linear-gradient(90deg,
                    transparent, transparent 2px,
                    rgba(212, 165, 116, 0.03) 2px,
                    rgba(212, 165, 116, 0.03) 4px);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            top: -20%;
            right: -10%;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, var(--deep-amber) 0%, transparent 70%);
            opacity: 0.06;
            pointer-events: none;
            z-index: 0;
            animation: pulse 10s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.06;
            }

            50% {
                transform: scale(1.2);
                opacity: 0.10;
            }
        }

        /* ── HEADER ── */
        header.site-header {
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 1.2rem 5%;
            border-bottom: 2px solid var(--primary-gold);
            background: rgba(44, 24, 16, 0.97);
            backdrop-filter: blur(10px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: slideDown 0.7s ease-out;
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

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .btn-back {
            color: rgba(245, 230, 211, 0.55);
            text-decoration: none;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: color 0.3s ease;
        }

        .btn-back:hover {
            color: var(--primary-gold);
        }

        .btn-back::before {
            content: '← ';
        }

        /* ── PAGE WRAPPER ── */
        main {
            flex: 1;
            position: relative;
            z-index: 1;
            padding: 3rem 5% 5rem;
            max-width: 860px;
            margin: 0 auto;
            width: 100%;
        }

        /* ── PAGE TITLE ── */
        .page-header {
            margin-bottom: 3rem;
            animation: fadeInUp 0.7s ease-out 0.1s both;
        }

        .page-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3rem;
            letter-spacing: 4px;
            color: var(--primary-gold);
            line-height: 1;
        }

        .page-header p {
            margin-top: 0.5rem;
            font-size: 0.85rem;
            font-weight: 300;
            color: rgba(245, 230, 211, 0.5);
            letter-spacing: 1px;
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

        /* ── SECCIÓN CARD ── */
        .profile-card {
            background: rgba(245, 230, 211, 0.04);
            border: 2px solid rgba(212, 165, 116, 0.4);
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
            margin-bottom: 2rem;
            animation: fadeInUp 0.7s ease-out both;
            transition: border-color 0.3s ease;
        }

        .profile-card:nth-child(1) {
            animation-delay: 0.2s;
        }

        .profile-card:nth-child(2) {
            animation-delay: 0.35s;
        }

        .profile-card:nth-child(3) {
            animation-delay: 0.5s;
        }

        .profile-card:hover {
            border-color: var(--primary-gold);
        }

        /* Acento de color en la esquina superior */
        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 4px;
            width: 80px;
            background: linear-gradient(90deg, var(--primary-gold), var(--deep-amber));
        }

        .profile-card.danger-card::before {
            background: linear-gradient(90deg, var(--danger), var(--danger-light));
        }

        .profile-card.danger-card {
            border-color: rgba(192, 57, 43, 0.35);
        }

        .profile-card.danger-card:hover {
            border-color: rgba(231, 76, 60, 0.7);
        }

        /* ── SECCIÓN HEADER ── */
        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.6rem;
            letter-spacing: 3px;
            color: var(--primary-gold);
            margin-bottom: 0.4rem;
        }

        .danger-card .section-title {
            color: #e87070;
        }

        .section-subtitle {
            font-size: 0.82rem;
            font-weight: 300;
            color: rgba(245, 230, 211, 0.55);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .section-divider {
            border: none;
            border-top: 1px solid rgba(212, 165, 116, 0.15);
            margin-bottom: 2rem;
        }

        /* ── FORM GROUPS ── */
        .form-group {
            margin-bottom: 1.5rem;
        }

        label.field-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(245, 230, 211, 0.6);
            margin-bottom: 0.5rem;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.95rem;
            opacity: 0.4;
            pointer-events: none;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.8rem;
            background: rgba(245, 230, 211, 0.05);
            border: 1px solid rgba(212, 165, 116, 0.3);
            color: var(--warm-cream);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.92rem;
            font-weight: 400;
            outline: none;
            transition: border-color 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
        }

        input::placeholder {
            color: rgba(245, 230, 211, 0.25);
            font-weight: 300;
        }

        input:focus {
            border-color: var(--primary-gold);
            background: rgba(212, 165, 116, 0.07);
            box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.1);
        }

        .input-error {
            margin-top: 0.45rem;
            font-size: 0.76rem;
            color: #f87171;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* ── ALERTA EMAIL NO VERIFICADO ── */
        .alert-warning {
            margin-top: 0.8rem;
            background: rgba(184, 134, 11, 0.12);
            border: 1px solid rgba(184, 134, 11, 0.4);
            border-left: 4px solid var(--deep-amber);
            padding: 0.9rem 1rem;
            font-size: 0.82rem;
            color: rgba(245, 230, 211, 0.8);
            line-height: 1.6;
        }

        .alert-warning button {
            background: none;
            border: none;
            color: var(--primary-gold);
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: underline;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
        }

        .alert-warning button:hover {
            color: var(--deep-amber);
        }

        /* ── ALERTA ÉXITO ── */
        .alert-success-inline {
            background: rgba(27, 67, 50, 0.4);
            border: 1px solid rgba(27, 67, 50, 0.9);
            border-left: 4px solid #4ade80;
            padding: 0.7rem 1rem;
            font-size: 0.82rem;
            font-weight: 600;
            color: #86efac;
            letter-spacing: 0.5px;
        }

        /* ── FILA DE BOTÓN ── */
        .form-footer {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        /* ── BOTÓN PRIMARIO ── */
        .btn-primary {
            padding: 0.85rem 2.5rem;
            background: linear-gradient(135deg, var(--primary-gold), var(--deep-amber));
            color: var(--dark-brown);
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 0.82rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.22);
            transition: left 0.5s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 165, 116, 0.3);
        }

        /* ── BOTÓN PELIGRO ── */
        .btn-danger {
            padding: 0.85rem 2.5rem;
            background: transparent;
            color: #e87070;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 0.82rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 2px solid rgba(192, 57, 43, 0.6);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: rgba(192, 57, 43, 0.15);
            border-color: var(--danger-light);
            color: #ff8080;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(192, 57, 43, 0.25);
        }

        /* ── SAVED FLASH ── */
        .saved-flash {
            font-size: 0.8rem;
            font-weight: 600;
            color: #86efac;
            letter-spacing: 1px;
            opacity: 0;
            animation: flashFade 2.5s ease-out forwards;
        }

        @keyframes flashFade {
            0% {
                opacity: 0;
                transform: translateX(-6px);
            }

            15% {
                opacity: 1;
                transform: translateX(0);
            }

            75% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        /* ══════════════════════════════════════
            MODAL DE CONFIRMACIÓN DE BORRADO
         ══════════════════════════════════════ */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10, 5, 2, 0.82);
            backdrop-filter: blur(6px);
            z-index: 200;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            animation: overlayIn 0.25s ease-out both;
        }

        .modal-overlay.open {
            display: flex;
        }

        @keyframes overlayIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal {
            width: 100%;
            max-width: 480px;
            background: #1e0e08;
            border: 2px solid rgba(192, 57, 43, 0.6);
            padding: 2.5rem;
            position: relative;
            animation: modalIn 0.3s ease-out both;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 4px;
            width: 80px;
            background: linear-gradient(90deg, var(--danger), var(--danger-light));
        }

        .modal-icon {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 1.2rem;
        }

        .modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            letter-spacing: 3px;
            color: #e87070;
            text-align: center;
            margin-bottom: 0.8rem;
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

        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 5%;
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

        .modal-text {
            font-size: 0.85rem;
            font-weight: 300;
            line-height: 1.8;
            color: rgba(245, 230, 211, 0.65);
            text-align: center;
            margin-bottom: 1.8rem;
        }

        .modal-divider {
            border: none;
            border-top: 1px solid rgba(192, 57, 43, 0.2);
            margin-bottom: 1.8rem;
        }

        .modal .form-group {
            margin-bottom: 0;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.8rem;
            flex-wrap: wrap;
        }

        .btn-cancel {
            padding: 0.8rem 1.8rem;
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
        }

        .btn-cancel:hover {
            color: var(--warm-cream);
            border-color: rgba(245, 230, 211, 0.45);
            background: rgba(245, 230, 211, 0.04);
        }

        /* ── FOOTER ── */
        footer {
            position: relative;
            z-index: 1;
            padding: 1.5rem 5%;
            border-top: 1px solid rgba(212, 165, 116, 0.15);
            text-align: center;
            font-size: 0.75rem;
            color: rgba(245, 230, 211, 0.25);
            letter-spacing: 1px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 640px) {
            main {
                padding: 2rem 4% 4rem;
            }

            .profile-card {
                padding: 2rem 1.5rem;
            }

            .logo {
                font-size: 1.4rem;
            }

            .logo::after {
                font-size: 1.3rem;
                right: -30px;
            }

            .page-header h1 {
                font-size: 2.2rem;
            }

            .btn-primary,
            .btn-danger {
                width: 100%;
                text-align: center;
            }

            .modal {
                padding: 2rem 1.5rem;
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

            .modal-footer {
                flex-direction: column-reverse;
            }

            .btn-cancel,
            .modal .btn-danger {
                width: 100%;
                text-align: center;
            }

            #map {
                height: 250px; /* Reducido de 400px a 250px para mejor escala */
                width: 100%;
                border: 1px solid rgba(212, 165, 116, 0.4);
                border-radius: 12px;
                margin-bottom: 1rem;
                background-color: #1a1a1a;
                box-shadow: inset 0 0 10px rgba(0,0,0,0.5);
            }

            .location-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }

            .profile-card.location-card {
                padding: 1.5rem; 
            }
        }
    </style>
</head>

<body>

    {{-- ═══ HEADER ═══ --}}
    <header class="site-header">
        <a href="{{ url('/dashboard') }}" class="logo">CERVECERÍA TÍO MINGO</a>
        <div class="header-right">
            <a href="{{ url('/dashboard') }}" class="btn-back">Dashboard</a>
        </div>
    </header>

    {{-- ═══ FORMULARIO oculto para reenvío de verificación ═══ --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <main>

        {{-- ─────────────────────────────────────────
             TÍTULO DE PÁGINA
        ───────────────────────────────────────── --}}
        <div class="page-header">
            <h1>Mi Perfil</h1>
            <p>Gestiona tu información personal y preferencias de seguridad</p>
        </div>


        <section class="main-content">

            {{-- FORMULARIO DE EDICIÓN --}}
            <div class="form-section">
                <h2 class="form-title">Actualiza tu información</h2>

                @if ($errors->any())
                    <div class="error-alert"
                        style="background: rgba(255, 107, 107, 0.1); border: 2px solid #ff6b6b; color: #ff6b6b; padding: 1.5rem; border-radius: 6px; margin-bottom: 2rem;">
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
                        <input type="text" id="nombre" name="nombre" class="form-input"
                            value="{{ old('nombre', $user->nombre) }}" placeholder="Ingresa tu nombre" required>
                        @error('nombre')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Apellido --}}
                    <div class="form-group @error('apellido') has-error @enderror">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" id="apellido" name="apellido" class="form-input"
                            value="{{ old('apellido', $user->apellido) }}" placeholder="Ingresa tu apellido" required>
                        @error('apellido')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Teléfono --}}
                    <div class="form-group @error('telefono') has-error @enderror">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" class="form-input"
                            value="{{ old('telefono', $user->telefono) }}" placeholder="Ingresa tu teléfono">
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



        {{-- ═══════════════════════════════════════════
             SECCIÓN 1 — ACTUALIZAR CONTRASEÑA
        ════════════════════════════════════════════ --}}
        <div class="profile-card">

            <h2 class="section-title">Actualizar Contraseña</h2>
            <p class="section-subtitle">
                Usa una contraseña larga y aleatoria para mantener tu cuenta segura.
            </p>
            <hr class="section-divider">

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                {{-- Contraseña actual --}}
                <div class="form-group">
                    <label class="field-label" for="current_password">Contraseña Actual</label>
                    <div class="input-wrap">
                        <span class="input-icon">🔒</span>
                        <input type="password" id="current_password" name="current_password" placeholder="••••••••"
                            autocomplete="current-password">
                    </div>
                    @if ($errors->updatePassword->get('current_password'))
                        @foreach ($errors->updatePassword->get('current_password') as $error)
                            <p class="input-error">⚠ {{ $error }}</p>
                        @endforeach
                    @endif
                </div>

                {{-- Nueva contraseña --}}
                <div class="form-group">
                    <label class="field-label" for="password">Nueva Contraseña</label>
                    <div class="input-wrap">
                        <span class="input-icon">🔑</span>
                        <input type="password" id="password" name="password" placeholder="••••••••"
                            autocomplete="new-password">
                    </div>
                    @if ($errors->updatePassword->get('password'))
                        @foreach ($errors->updatePassword->get('password') as $error)
                            <p class="input-error">⚠ {{ $error }}</p>
                        @endforeach
                    @endif
                </div>

                {{-- Confirmar contraseña --}}
                <div class="form-group">
                    <label class="field-label" for="password_confirmation">Confirmar Contraseña</label>
                    <div class="input-wrap">
                        <span class="input-icon">🔑</span>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="••••••••" autocomplete="new-password">
                    </div>
                    @if ($errors->updatePassword->get('password_confirmation'))
                        @foreach ($errors->updatePassword->get('password_confirmation') as $error)
                            <p class="input-error">⚠ {{ $error }}</p>
                        @endforeach
                    @endif
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-primary">Actualizar Contraseña</button>
                    @if (session('status') === 'password-updated')
                        <span class="saved-flash">✓ Contraseña actualizada</span>
                    @endif
                </div>
            </form>
        </div>

        {{-- ═══════════════════════════════════════════
             SECCIÓN 2 — ELIMINAR CUENTA
        ════════════════════════════════════════════ --}}
        <div class="profile-card danger-card">

            <h2 class="section-title">Eliminar Cuenta</h2>
            <p class="section-subtitle">
                Una vez eliminada tu cuenta, todos sus datos y recursos serán borrados
                permanentemente. Descarga cualquier información que desees conservar antes de proceder.
            </p>
            <hr class="section-divider" style="border-color: rgba(192,57,43,0.2);">

            <button type="button" class="btn-danger" onclick="openDeleteModal()">
                Eliminar Cuenta
            </button>
        </div>

    </main>

    {{-- ═══════════════════════════════════════════
             SECCIÓN 3 — Ubicación
        ════════════════════════════════════════════ --}}

        <div class="profile-card">
    <h2 class="section-title">📍 Mi ubicación</h2>
    <p style="color: rgba(245, 230, 211, 0.7); font-size: 0.9rem; margin-bottom: 1.5rem; font-family: 'Montserrat', sans-serif;">
        Mueve el marcador o haz clic en el mapa para fijar tu dirección exacta.
    </p>

    {{-- Contenedor del mapa con la misma estética --}}
    <div id="map"
         style="height: 350px; width: 100%; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid rgba(212, 165, 116, 0.3);"
         data-lat="{{ $user->latitude ?? 36.5936 }}"
         data-lng="{{ $user->longitude ?? -6.2341 }}">
    </div>

    <form action="{{ route('profile.location.update') }}" method="POST">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 1rem;">
            <div class="form-group">
                <label class="form-label">Latitud</label>
                <input type="text" id="lat" name="latitude" class="form-input" value="{{ $user->latitude }}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Longitud</label>
                <input type="text" id="lng" name="longitude" class="form-input" value="{{ $user->longitude }}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Dirección Detectada</label>
            <textarea id="address" name="address" class="form-input" rows="2" readonly
                      style="resize: none;">{{ $user->address }}</textarea>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; margin-top: 0.5rem;">
            CONFIRMAR UBICACIÓN
        </button>
    </form>
</div>

    {{-- ═══════════════════════════════════════════
         MODAL DE CONFIRMACIÓN DE BORRADO
    ════════════════════════════════════════════ --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal">

            <div class="modal-icon">⚠️</div>
            <h2 class="modal-title">¿Eliminar Cuenta?</h2>
            <p class="modal-text">
                Esta acción es <strong style="color:#e87070;">irreversible</strong>.
                Todos tus datos serán eliminados permanentemente.
                Introduce tu contraseña para confirmar.
            </p>

            <hr class="modal-divider">

            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="form-group">
                    <label class="field-label" for="delete_password">Contraseña</label>
                    <div class="input-wrap">
                        <span class="input-icon">🔒</span>
                        <input type="password" id="delete_password" name="password"
                            placeholder="Introduce tu contraseña" autocomplete="current-password">
                    </div>
                    @if ($errors->userDeletion->get('password'))
                        @foreach ($errors->userDeletion->get('password') as $error)
                            <p class="input-error">⚠ {{ $error }}</p>
                        @endforeach
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Cancelar</button>
                    <button type="submit" class="btn-danger">Eliminar Definitivamente</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        © {{ date('Y') }} CERVECERÍA TÍO MINGO — Hecho con pasión 🍺
    </footer>

    <script>
        function openDeleteModal() {
            const modal = document.getElementById('deleteModal');
            if (modal) {
                modal.classList.add('open');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            if (modal) {
                modal.classList.remove('open');
                document.body.style.overflow = '';
            }
        }

        /**
         * Usamos comillas simples para que VS Code crea que es un texto.
         * Laravel renderizará '1' (true) o '' (false).
         */
        const hasDeletionErrors = "{{ $errors->userDeletion->isNotEmpty() ? '1' : '' }}";

        if (hasDeletionErrors === '1') {
            document.addEventListener('DOMContentLoaded', () => {
                openDeleteModal();
            });
        }

        // Manejadores de cierre
        const modalElement = document.getElementById('deleteModal');
        if (modalElement) {
            modalElement.addEventListener('click', function(e) {
                if (e.target === this) closeDeleteModal();
            });
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeDeleteModal();
        });

    </script>

    <script>
    let map, marker, geocoder;

    function initMap() {
        // Obtenemos el contenedor del mapa y las coordenadas iniciales
        const mapElement = document.getElementById('map');
        const initialLoc = {
            lat: parseFloat(mapElement.dataset.lat) || 36.5936,
            lng: parseFloat(mapElement.dataset.lng) || -6.2341
        };

        geocoder = new google.maps.Geocoder();

        // Inicializamos el mapa
        map = new google.maps.Map(mapElement, {
            zoom: 15,
            center: initialLoc,
            disableDefaultUI: false, // Permite controles básicos
            styles: [
                { "featureType": "all", "elementType": "labels.text.fill", "stylers": [{ "color": "#ffffff" }] },
                { "featureType": "all", "elementType": "labels.text.stroke", "stylers": [{ "color": "#000000" }, { "lightness": 13 }] },
                { "featureType": "administrative", "elementType": "geometry.fill", "stylers": [{ "color": "#000000" }, { "lightness": 20 }] },
                { "featureType": "landscape", "elementType": "geometry", "stylers": [{ "color": "#2c1810" }] }, // Color de tu web
                { "featureType": "water", "elementType": "geometry", "stylers": [{ "color": "#1a1a1a" }] }
    ]
        });

        // Añadimos el marcador arrastrable
        marker = new google.maps.Marker({
            position: initialLoc,
            map: map,
            draggable: true,
            title: "Arrastra para ubicar tu dirección"
        });

        // Eventos para capturar la nueva posición
        map.addListener("click", (e) => updatePos(e.latLng));
        marker.addListener("dragend", (e) => updatePos(e.latLng));
    }

    function updatePos(latLng) {
        marker.setPosition(latLng);
        map.panTo(latLng);

        // Actualizamos los inputs del formulario
        document.getElementById("lat").value = latLng.lat().toFixed(8);
        document.getElementById("lng").value = latLng.lng().toFixed(8);

        // Obtener la dirección escrita (Geocoding inverso)
        geocoder.geocode({ location: latLng }, (results, status) => {
            if (status === "OK" && results[0]) {
                document.getElementById("address").value = results[0].formatted_address;
            }
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}&callback=initMap" async defer></script>



</body>

</html>
