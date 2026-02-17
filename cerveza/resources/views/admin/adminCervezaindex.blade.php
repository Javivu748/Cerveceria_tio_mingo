<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Cervezas - Cervecería Tío Mingo</title>
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

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--dark-brown);
            color: var(--warm-cream);
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-image: repeating-linear-gradient(90deg,
                transparent, transparent 2px,
                rgba(212, 165, 116, 0.03) 2px,
                rgba(212, 165, 116, 0.03) 4px);
            pointer-events: none;
            z-index: 1;
        }

        .container { position: relative; z-index: 2; }

        header {
            padding: 1.5rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--primary-gold);
            background: rgba(44, 24, 16, 0.95);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0; z-index: 100;
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
            content: '👨‍💼';
            position: absolute;
            right: -40px; top: -5px;
            font-size: 1.8rem;
        }

        .nav-container { display: flex; align-items: center; gap: 2rem; }
        nav { display: flex; gap: 2rem; align-items: center; }

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
            bottom: -5px; left: 0;
            width: 0; height: 2px;
            background: var(--primary-gold);
            transition: width 0.3s ease;
        }

        nav a:hover { color: var(--primary-gold); }
        nav a:hover::after { width: 100%; }
        nav a.active { color: var(--primary-gold); }
        nav a.active::after { width: 100%; }

        .auth-buttons { display: flex; gap: 1rem; align-items: center; }

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
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-logout:hover {
            background: rgba(255, 60, 60, 0.15);
            color: #ff6b6b;
            border-color: #ff6b6b;
            transform: translateY(-2px);
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            background: none;
            border: none;
        }

        .menu-toggle span {
            width: 28px; height: 3px;
            background: var(--primary-gold);
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        /* ── CONTENT ── */
        .admin-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 3rem 5%;
        }

        .page-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 1.5rem;
            animation: fadeInUp 0.8s ease-out;
        }

        .page-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3rem;
            letter-spacing: 2px;
            color: var(--primary-gold);
            text-shadow: 2px 2px 0 var(--deep-amber);
        }

        .page-header p {
            color: rgba(245, 230, 211, 0.6);
            font-size: 0.85rem;
            letter-spacing: 1px;
            margin-top: 0.3rem;
        }

        .btn-crear {
            padding: 0.9rem 2rem;
            background: linear-gradient(135deg, var(--primary-gold), var(--deep-amber));
            color: var(--dark-brown);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: inline-block;
        }

        .btn-crear:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(212, 165, 116, 0.4);
        }

        /* Alertas */
        .alert-success {
            background: rgba(81, 207, 102, 0.1);
            border: 1px solid var(--success);
            color: var(--success);
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            letter-spacing: 1px;
            animation: fadeInUp 0.5s ease-out;
        }

        /* Tabla */
        .table-wrapper {
            background: rgba(212, 165, 116, 0.05);
            border: 2px solid var(--primary-gold);
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(212, 165, 116, 0.15);
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .table-header {
            background: linear-gradient(135deg, rgba(212, 165, 116, 0.2), rgba(184, 134, 11, 0.1));
            padding: 1.5rem 2rem;
            border-bottom: 2px solid var(--primary-gold);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.6rem;
            color: var(--primary-gold);
            letter-spacing: 2px;
        }

        .count-badge {
            background: var(--primary-gold);
            color: var(--dark-brown);
            padding: 0.5rem 1.5rem;
            font-weight: 700;
            font-size: 0.85rem;
            border-radius: 50px;
        }

        table { width: 100%; border-collapse: collapse; }

        thead { background: rgba(184, 134, 11, 0.15); }

        th {
            padding: 1.2rem 1.5rem;
            text-align: left;
            color: var(--primary-gold);
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 0.8rem;
            text-transform: uppercase;
            border-bottom: 1px solid rgba(212, 165, 116, 0.3);
        }

        td {
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid rgba(212, 165, 116, 0.1);
            color: var(--warm-cream);
            font-size: 0.9rem;
        }

        tbody tr { transition: background 0.3s ease; }
        tbody tr:hover { background: rgba(212, 165, 116, 0.08); }
        tbody tr:last-child td { border-bottom: none; }

        /* Imagen miniatura */
        .beer-thumb {
            width: 50px;
            height: 50px;
            object-fit: contain;
            border: 1px solid rgba(212, 165, 116, 0.2);
            background: rgba(212, 165, 116, 0.05);
            padding: 4px;
        }

        /* Badge formato */
        .formato-badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: 1px solid rgba(212, 165, 116, 0.4);
            color: var(--primary-gold);
            background: rgba(212, 165, 116, 0.1);
        }

        .precio {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.3rem;
            color: var(--primary-gold);
            letter-spacing: 1px;
        }

        /* Botones acción */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .btn-action {
            padding: 0.45rem 0.9rem;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            white-space: nowrap;
            font-family: 'Montserrat', sans-serif;
        }

        .btn-edit {
            background: rgba(27, 67, 50, 0.6);
            color: #51cf66;
            border: 1px solid #51cf66;
        }

        .btn-edit:hover {
            background: rgba(27, 67, 50, 0.9);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(81, 207, 102, 0.2);
        }

        .btn-delete {
            background: rgba(255, 107, 107, 0.1);
            color: #ff6b6b;
            border: 1px solid #ff6b6b;
        }

        .btn-delete:hover {
            background: rgba(255, 107, 107, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.2);
        }

        /* Paginación */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            border-top: 1px solid rgba(212, 165, 116, 0.2);
        }

        .pagination-wrapper nav { display: flex; gap: 0.4rem; align-items: center; }

        .pagination-wrapper span[aria-current="page"] > span,
        .pagination-wrapper a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 0.7rem;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid rgba(212, 165, 116, 0.3);
            color: rgba(245, 230, 211, 0.6);
            text-decoration: none;
            transition: all 0.3s ease;
            background: transparent;
        }

        .pagination-wrapper span[aria-current="page"] > span {
            background: var(--primary-gold);
            border-color: var(--primary-gold);
            color: var(--dark-brown);
            font-weight: 700;
        }

        .pagination-wrapper a:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            background: rgba(212, 165, 116, 0.1);
        }

        .pagination-wrapper span[aria-disabled="true"] > span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 0.7rem;
            border: 1px solid rgba(212, 165, 116, 0.1);
            color: rgba(245, 230, 211, 0.2);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8rem;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: rgba(245, 230, 211, 0.5);
        }

        .empty-state-icon { font-size: 3.5rem; margin-bottom: 1rem; }

        /* Footer */
        footer {
            margin-top: 5rem;
            padding: 2.5rem 5%;
            border-top: 2px solid rgba(212, 165, 116, 0.3);
            text-align: center;
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
            margin-top: 0.3rem;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .menu-toggle { display: flex; }
            .nav-container {
                position: absolute;
                top: 70px; left: 0; right: 0;
                flex-direction: column;
                background: rgba(44, 24, 16, 0.98);
                padding: 2rem; gap: 1rem;
                max-height: 0; overflow: hidden;
                transition: max-height 0.3s ease;
                border-bottom: 2px solid var(--primary-gold);
            }
            .nav-container.active { max-height: 400px; }
            nav { flex-direction: column; gap: 1rem; width: 100%; }
            .auth-buttons { flex-direction: column; width: 100%; }
            .page-header { flex-direction: column; align-items: flex-start; }
            th, td { padding: 0.8rem 1rem; font-size: 0.8rem; }
            .action-buttons { flex-direction: column; }
        }
    </style>
</head>
<body>
<div class="container">

    <header>
        <a href="{{ url('/') }}" class="logo">ADMIN</a>

        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span><span></span><span></span>
        </div>

        <div class="nav-container" id="navContainer">
            <nav>
                <a href="{{ route('admin.usuarios') }}">Usuarios</a>
                <a href="{{ route('admin.cervezas') }}" class="active">Cervezas</a>
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </nav>
            <div class="auth-buttons">
                <span class="user-greeting">{{ Auth::user()->nombre }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <div class="admin-content">

        {{-- Header de página --}}
        <div class="page-header">
            <div>
                <h1>🍺 Gestión de Cervezas</h1>
                <p>Administra el catálogo completo de cervezas</p>
            </div>
            <a href="{{ route('admin.cervezas.create') }}" class="btn-crear">
                + Nueva Cerveza
            </a>
        </div>

        {{-- Alerta de éxito --}}
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- Tabla --}}
        <div class="table-wrapper">
            <div class="table-header">
                <h2>Catálogo de Cervezas</h2>
                <span class="count-badge">{{ $cervezas->total() }} cervezas</span>
            </div>

            @if($cervezas->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Cervecería</th>
                        <th>Estilo</th>
                        <th>Formato</th>
                        <th>Capacidad</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cervezas as $cerveza)
                    <tr>
                        <td style="color: rgba(245,230,211,0.4); font-size:0.8rem;">#{{ $cerveza->id }}</td>
                        <td>
                            <img
                                src="{{ $cerveza->imagen_url }}"
                                alt="{{ $cerveza->name }}"
                                class="beer-thumb"
                                onerror="this.src='https://picsum.photos/seed/beer{{ $cerveza->id }}/100/100'"
                            >
                        </td>
                        <td>
                            <strong style="color: var(--primary-gold);">{{ $cerveza->name }}</strong>
                        </td>
                        <td>{{ $cerveza->cerveceria->nombre ?? '—' }}</td>
                        <td style="color: rgba(245,230,211,0.6); font-size:0.85rem;">
                            {{ $cerveza->estilo->nombre ?? '—' }}
                        </td>
                        <td>
                            <span class="formato-badge">
                                {{ $cerveza->formato === 'Lata' ? '🥫' : '🍾' }}
                                {{ $cerveza->formato }}
                            </span>
                        </td>
                        <td style="color: rgba(245,230,211,0.7);">{{ $cerveza->capacidad }} ml</td>
                        <td>
                            <span class="precio">€{{ number_format($cerveza->precio_eur, 2) }}</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.cervezas.edit', $cerveza->id) }}" class="btn-action btn-edit">
                                    ✏️ Editar
                                </a>
                                <form method="POST" action="{{ route('admin.cervezas.destroy', $cerveza->id) }}" style="display:inline;"
                                      onsubmit="return confirm('¿Eliminar {{ $cerveza->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">🗑️ Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Paginación --}}
            @if($cervezas->hasPages())
            <div class="pagination-wrapper">
                {{ $cervezas->links() }}
            </div>
            @endif

            @else
            <div class="empty-state">
                <div class="empty-state-icon">🍺</div>
                <h3>No hay cervezas</h3>
                <p>Crea la primera cerveza del catálogo.</p>
            </div>
            @endif
        </div>

    </div>

    <footer>
        <div class="footer-logo">CERVECERÍA TÍO MINGO</div>
        <div class="footer-text">© {{ date('Y') }} — Panel de Administración</div>
    </footer>

</div>
<script>
    function toggleMenu() {
        document.getElementById('navContainer').classList.toggle('active');
        document.querySelector('.menu-toggle').classList.toggle('active');
    }
</script>
</body>
</html>