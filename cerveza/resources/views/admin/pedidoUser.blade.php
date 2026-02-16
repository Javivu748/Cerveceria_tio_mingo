<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Cervecería Tío Mingo</title>
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
            max-width: 1400px;
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

        /* SECCIÓN DE INFORMACIÓN DEL USUARIO */
        .user-info-section {
            background: rgba(212, 165, 116, 0.05);
            border: 2px solid var(--primary-gold);
            border-radius: 8px;
            padding: 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 10px 40px rgba(212, 165, 116, 0.15);
            animation: fadeInUp 0.8s ease-out 0.1s both;
        }

        .user-info-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            gap: 1.5rem;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-gold), var(--deep-amber));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            flex-shrink: 0;
        }

        .user-details h2 {
            font-size: 1.8rem;
            color: var(--primary-gold);
            margin-bottom: 0.3rem;
        }

        .user-details p {
            color: rgba(245, 230, 211, 0.8);
            font-size: 0.95rem;
        }

        .user-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .info-card {
            background: rgba(212, 165, 116, 0.08);
            padding: 1.5rem;
            border-radius: 6px;
            border-left: 4px solid var(--primary-gold);
        }

        .info-label {
            font-size: 0.8rem;
            color: rgba(245, 230, 211, 0.6);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .info-value {
            font-size: 1.1rem;
            color: var(--primary-gold);
            font-weight: 700;
        }

        /* TABLA DE PEDIDOS */
        .pedidos-section {
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            letter-spacing: 2px;
            color: var(--primary-gold);
            margin-bottom: 1.5rem;
            text-shadow: 1px 1px 0 var(--deep-amber);
        }

        .pedidos-table-wrapper {
            background: rgba(212, 165, 116, 0.05);
            border: 2px solid var(--primary-gold);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(212, 165, 116, 0.15);
        }

        .table-header {
            background: linear-gradient(135deg, rgba(212, 165, 116, 0.2), rgba(184, 134, 11, 0.1));
            padding: 1.5rem 2rem;
            border-bottom: 2px solid var(--primary-gold);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            font-size: 1.4rem;
            color: var(--primary-gold);
            letter-spacing: 1px;
        }

        .pedidos-count {
            background: var(--primary-gold);
            color: var(--dark-brown);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(184, 134, 11, 0.15);
        }

        th {
            padding: 1.2rem 2rem;
            text-align: left;
            color: var(--primary-gold);
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 0.9rem;
            text-transform: uppercase;
            border-bottom: 1px solid rgba(212, 165, 116, 0.3);
        }

        td {
            padding: 1.2rem 2rem;
            border-bottom: 1px solid rgba(212, 165, 116, 0.1);
            color: var(--warm-cream);
        }

        tbody tr {
            transition: background 0.3s ease;
        }

        tbody tr:hover {
            background: rgba(212, 165, 116, 0.08);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Badge de estado */
        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .status-badge.completado {
            background: rgba(81, 207, 102, 0.2);
            color: var(--success);
            border: 1px solid var(--success);
        }

        .status-badge.pendiente {
            background: rgba(212, 165, 116, 0.2);
            color: var(--primary-gold);
            border: 1px solid var(--primary-gold);
        }

        .status-badge.cancelado {
            background: rgba(255, 107, 107, 0.2);
            color: var(--danger);
            border: 1px solid var(--danger);
        }

        /* Sin pedidos */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: rgba(245, 230, 211, 0.6);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .cervezas-list {
            font-size: 0.85rem;
            color: rgba(245, 230, 211, 0.8);
            line-height: 1.6;
        }

        .cervezas-list li {
            margin-bottom: 0.3rem;
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

            .user-info-header {
                flex-direction: column;
                text-align: center;
            }

            .user-info-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .table-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            th, td {
                padding: 1rem;
                font-size: 0.85rem;
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

            .user-avatar {
                width: 60px;
                height: 60px;
                font-size: 2rem;
            }

            .user-details h2 {
                font-size: 1.4rem;
            }

            .section-title {
                font-size: 1.3rem;
            }

            table {
                font-size: 0.75rem;
            }

            th, td {
                padding: 0.8rem 0.5rem;
            }

            .pedidos-count {
                padding: 0.4rem 1rem;
                font-size: 0.8rem;
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
                <a href="{{ route('pedidos.index') }}">Mis Pedidos</a>
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
            <h1>Mi Perfil 👤</h1>
        </div>

        {{-- INFORMACIÓN DEL USUARIO --}}
        <div class="user-info-section">
            <div class="user-info-header">
                <div class="user-avatar">👤</div>
                <div class="user-details">
                    <h2>{{ $user->nombre }} {{ $user->apellido }}</h2>
                    <p>Miembro desde {{ $user->created_at->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="user-info-grid">
                <div class="info-card">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $user->email }}</div>
                </div>

                <div class="info-card">
                    <div class="info-label">Teléfono</div>
                    <div class="info-value">{{ $user->telefono ?? 'No registrado' }}</div>
                </div>

                <div class="info-card">
                    <div class="info-label">Rol</div>
                    <div class="info-value" style="text-transform: uppercase;">{{ $user->role }}</div>
                </div>

                <div class="info-card">
                    <div class="info-label">Total de Pedidos</div>
                    <div class="info-value">{{ count($pedidos) }}</div>
                </div>
            </div>
        </div>

        {{-- TABLA DE PEDIDOS --}}
        <div class="pedidos-section">
            <h2 class="section-title">Mis Pedidos 🛍️</h2>

            @if($pedidos->count() > 0)
                <div class="pedidos-table-wrapper">
                    <div class="table-header">
                        <h3>Historial de Pedidos</h3>
                        <span class="pedidos-count">{{ count($pedidos) }} pedido{{ count($pedidos) !== 1 ? 's' : '' }}</span>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Método de Pago</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido->fecha->format('d/m/Y H:i') }}</td>
                                    <td><strong>${{ number_format($pedido->total, 2, ',', '.') }}</strong></td>
                                    <td>
                                        <span class="status-badge {{ strtolower($pedido->estado) }}">
                                            {{ ucfirst($pedido->estado) }}
                                        </span>
                                    </td>
                                    <td>{{ ucfirst($pedido->metodoPago) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="pedidos-table-wrapper">
                    <div class="empty-state">
                        <div class="empty-state-icon">📭</div>
                        <h3>No tienes pedidos aún</h3>
                        <p>Realiza tu primer pedido visitando nuestra tienda.</p>
                        <br>
                        <a href="{{ route('cervezas') }}" style="color: var(--primary-gold); text-decoration: none; font-weight: 600;">Ver Cervezas →</a>
                    </div>
                </div>
            @endif
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
