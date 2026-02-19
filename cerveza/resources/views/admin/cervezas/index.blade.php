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

        /* ─── FILTROS ─────────────────────────────────────── */
        .filter-panel {
            margin-bottom: 1.5rem;
            background: rgba(212, 165, 116, 0.05);
            border: 2px solid var(--primary-gold);
            animation: fadeInUp 0.8s ease-out 0.1s both;
        }

        .filter-panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 1.5rem;
            cursor: pointer;
            user-select: none;
            border-bottom: 1px solid rgba(212,165,116,0.2);
            transition: background 0.2s;
        }

        .filter-panel-header:hover {
            background: rgba(212,165,116,0.08);
        }

        .filter-panel-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.2rem;
            letter-spacing: 2px;
            color: var(--primary-gold);
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .filter-toggle-icon {
            font-size: 0.9rem;
            transition: transform 0.3s ease;
            color: rgba(245,230,211,0.5);
        }

        .filter-toggle-icon.open { transform: rotate(180deg); }

        .active-filters-count {
            background: var(--primary-gold);
            color: var(--dark-brown);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
        }

        .filter-body {
            padding: 1.5rem;
            display: none;
        }

        .filter-body.open { display: block; }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.2rem;
        }

        .filter-group { display: flex; flex-direction: column; gap: 0.4rem; }

        .filter-label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--primary-gold);
        }

        .filter-input,
        .filter-select {
            padding: 0.75rem 1rem;
            background: rgba(44, 24, 16, 0.6);
            border: 1px solid rgba(212, 165, 116, 0.3);
            color: var(--warm-cream);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            width: 100%;
            appearance: none;
            -webkit-appearance: none;
        }

        .filter-input:focus,
        .filter-select:focus {
            outline: none;
            border-color: var(--primary-gold);
            background: rgba(44, 24, 16, 0.8);
        }

        .filter-select option {
            background: #2C1810;
            color: var(--warm-cream);
        }

        /* Selector de rango de precio */
        .price-range { display: flex; gap: 0.5rem; align-items: center; }
        .price-range .filter-input { min-width: 0; }
        .price-range span { color: rgba(245,230,211,0.4); font-size: 0.8rem; white-space: nowrap; }

        .filter-actions {
            display: flex;
            gap: 0.8rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-apply-filters {
            padding: 0.75rem 2rem;
            background: linear-gradient(135deg, var(--primary-gold), var(--deep-amber));
            color: var(--dark-brown);
            border: none;
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Montserrat', sans-serif;
        }

        .btn-apply-filters:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(212, 165, 116, 0.4);
        }

        .btn-clear-filters {
            padding: 0.75rem 1.5rem;
            background: transparent;
            color: rgba(245, 230, 211, 0.6);
            border: 2px solid rgba(245, 230, 211, 0.3);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.8rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            font-family: 'Montserrat', sans-serif;
            cursor: pointer;
        }

        .btn-clear-filters:hover {
            border-color: var(--danger);
            color: var(--danger);
        }

        /* Barra de búsqueda de texto */
        .search-bar {
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.8s ease-out 0.05s both;
        }

        .search-form {
            display: flex;
            gap: 0;
            background: rgba(212, 165, 116, 0.05);
            border: 2px solid var(--primary-gold);
        }

        .search-input {
            flex: 1;
            padding: 1rem 1.4rem;
            background: transparent;
            border: none;
            color: var(--warm-cream);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
        }

        .search-input:focus { outline: none; }
        .search-input::placeholder { color: rgba(245, 230, 211, 0.35); }

        .btn-search {
            padding: 1rem 1.8rem;
            background: linear-gradient(135deg, var(--primary-gold), var(--deep-amber));
            color: var(--dark-brown);
            border: none;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            font-family: 'Montserrat', sans-serif;
        }

        .btn-search:hover { opacity: 0.9; }

        /* Chips de filtros activos */
        .active-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.8rem;
            background: rgba(212,165,116,0.15);
            border: 1px solid var(--primary-gold);
            color: var(--primary-gold);
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .chip-remove {
            cursor: pointer;
            opacity: 0.6;
            font-size: 0.9rem;
            line-height: 1;
            transition: opacity 0.2s;
            text-decoration: none;
            color: inherit;
        }

        .chip-remove:hover { opacity: 1; }

        /* Info de resultados */
        .results-info {
            color: rgba(245, 230, 211, 0.5);
            font-size: 0.8rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .results-info strong { color: var(--primary-gold); }

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
            padding: 1.2rem 2rem;
            border-bottom: 2px solid var(--primary-gold);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .table-header h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.6rem;
            color: var(--primary-gold);
            letter-spacing: 2px;
        }

        .table-header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .count-badge {
            background: var(--primary-gold);
            color: var(--dark-brown);
            padding: 0.5rem 1.5rem;
            font-weight: 700;
            font-size: 0.85rem;
            border-radius: 50px;
            white-space: nowrap;
        }

        /* Ordenación inline */
        .sort-select {
            padding: 0.5rem 0.8rem;
            background: rgba(44, 24, 16, 0.6);
            border: 1px solid rgba(212, 165, 116, 0.3);
            color: var(--warm-cream);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.75rem;
            cursor: pointer;
        }

        .sort-select:focus { outline: none; border-color: var(--primary-gold); }
        .sort-select option { background: #2C1810; }

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
            white-space: nowrap;
        }

        th.sortable { cursor: pointer; user-select: none; }
        th.sortable:hover { color: #fff; }
        th .sort-icon { margin-left: 0.3rem; opacity: 0.4; }
        th.sort-active .sort-icon { opacity: 1; }

        td {
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid rgba(212, 165, 116, 0.1);
            color: var(--warm-cream);
            font-size: 0.9rem;
        }

        tbody tr { transition: background 0.3s ease; }
        tbody tr:hover { background: rgba(212, 165, 116, 0.08); }
        tbody tr:last-child td { border-bottom: none; }

        .beer-thumb {
            width: 50px;
            height: 50px;
            object-fit: contain;
            border: 1px solid rgba(212, 165, 116, 0.2);
            background: rgba(212, 165, 116, 0.05);
            padding: 4px;
        }

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

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: rgba(245, 230, 211, 0.5);
        }

        .empty-state-icon { font-size: 3.5rem; margin-bottom: 1rem; }

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

        @media (max-width: 900px) {
            .filter-grid { grid-template-columns: 1fr 1fr; }
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
            .filter-grid { grid-template-columns: 1fr; }
            .table-header { flex-direction: column; align-items: flex-start; }
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
                <a href="{{ route('admin.usuarios') }}">Dashboard</a>
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

        <div class="page-header">
            <div>
                <h1>🍺 Gestión de Cervezas</h1>
                <p>Administra el catálogo completo de cervezas</p>
            </div>
            <a href="{{ route('admin.cervezas.create') }}" class="btn-crear">
                + Nueva Cerveza
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- Formulario unificado con búsqueda + filtros --}}
        <form method="GET" action="{{ route('admin.cervezas') }}" id="filterForm">

            {{-- Barra de búsqueda de texto --}}
            <div class="search-bar">
                <div class="search-form">
                    <input
                        type="text"
                        name="search"
                        class="search-input"
                        placeholder="🔍 Buscar por nombre, cervecería o estilo..."
                        value="{{ request('search') }}"
                    >
                    <button type="submit" class="btn-search">Buscar</button>
                </div>
            </div>

            {{-- Panel de filtros avanzados --}}
            <div class="filter-panel">
                <div class="filter-panel-header" onclick="toggleFilters()">
                    <div class="filter-panel-title">
                        🎛️ Filtros avanzados
                        @php
                            $activeCount = collect(['cerveceria_id','estilo_id','formato','capacidad','precio_min','precio_max','sort_by'])
                                ->filter(fn($k) => request()->filled($k))
                                ->count();
                        @endphp
                        @if($activeCount > 0)
                            <span class="active-filters-count">{{ $activeCount }} activos</span>
                        @endif
                    </div>
                    <span class="filter-toggle-icon" id="filterIcon">▼</span>
                </div>

                <div class="filter-body" id="filterBody">
                    <div class="filter-grid">

                        {{-- Cervecería --}}
                        <div class="filter-group">
                            <label class="filter-label">Cervecería</label>
                            <select name="cerveceria_id" class="filter-select">
                                <option value="">Todas</option>
                                @foreach($cervecerias as $c)
                                    <option value="{{ $c->id }}" {{ request('cerveceria_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Estilo --}}
                        <div class="filter-group">
                            <label class="filter-label">Estilo</label>
                            <select name="estilo_id" class="filter-select">
                                <option value="">Todos</option>
                                @foreach($estilos as $e)
                                    <option value="{{ $e->id }}" {{ request('estilo_id') == $e->id ? 'selected' : '' }}>
                                        {{ $e->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Formato --}}
                        <div class="filter-group">
                            <label class="filter-label">Formato</label>
                            <select name="formato" class="filter-select">
                                <option value="">Todos</option>
                                <option value="Lata"    {{ request('formato') === 'Lata'    ? 'selected' : '' }}>🥫 Lata</option>
                                <option value="Botella" {{ request('formato') === 'Botella' ? 'selected' : '' }}>🍾 Botella</option>
                            </select>
                        </div>

                        {{-- Capacidad --}}
                        <div class="filter-group">
                            <label class="filter-label">Capacidad</label>
                            <select name="capacidad" class="filter-select">
                                <option value="">Todas</option>
                                @foreach($capacidades as $cap)
                                    <option value="{{ $cap }}" {{ request('capacidad') == $cap ? 'selected' : '' }}>
                                        {{ $cap }} ml
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Precio mín/máx --}}
                        <div class="filter-group">
                            <label class="filter-label">Precio (€)</label>
                            <div class="price-range">
                                <input type="number" name="precio_min" class="filter-input"
                                    placeholder="Mín" step="0.01" min="0"
                                    value="{{ request('precio_min') }}">
                                <span>—</span>
                                <input type="number" name="precio_max" class="filter-input"
                                    placeholder="Máx" step="0.01" min="0"
                                    value="{{ request('precio_max') }}">
                            </div>
                        </div>

                        {{-- Ordenar por --}}
                        <div class="filter-group">
                            <label class="filter-label">Ordenar por</label>
                            <select name="sort_by" class="filter-select">
                                <option value="id"        {{ request('sort_by','id') === 'id'        ? 'selected' : '' }}>ID</option>
                                <option value="name"      {{ request('sort_by') === 'name'           ? 'selected' : '' }}>Nombre A-Z</option>
                                <option value="precio_eur" {{ request('sort_by') === 'precio_eur'   ? 'selected' : '' }}>Precio</option>
                                <option value="capacidad" {{ request('sort_by') === 'capacidad'     ? 'selected' : '' }}>Capacidad</option>
                            </select>
                        </div>

                        {{-- Orden --}}
                        <div class="filter-group">
                            <label class="filter-label">Orden</label>
                            <select name="sort_order" class="filter-select">
                                <option value="asc"  {{ request('sort_order','asc') === 'asc'  ? 'selected' : '' }}>↑ Ascendente</option>
                                <option value="desc" {{ request('sort_order') === 'desc' ? 'selected' : '' }}>↓ Descendente</option>
                            </select>
                        </div>

                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn-apply-filters">✅ Aplicar filtros</button>
                        <a href="{{ route('admin.cervezas') }}" class="btn-clear-filters">✖ Limpiar todo</a>
                    </div>
                </div>
            </div>

        </form>

        {{-- Chips de filtros activos (fuera del form para no duplicar en submit) --}}
        @php
            $filterLabels = [
                'search'        => ['label' => 'Búsqueda', 'value' => request('search')],
                'cerveceria_id' => ['label' => 'Cervecería', 'value' => $cervecerias->find(request('cerveceria_id'))?->nombre ?? null],
                'estilo_id'     => ['label' => 'Estilo', 'value' => $estilos->find(request('estilo_id'))?->nombre ?? null],
                'formato'       => ['label' => 'Formato', 'value' => request('formato')],
                'capacidad'     => ['label' => 'Capacidad', 'value' => request('capacidad') ? request('capacidad').' ml' : null],
                'precio_min'    => ['label' => 'Precio mín', 'value' => request('precio_min') ? '€'.request('precio_min') : null],
                'precio_max'    => ['label' => 'Precio máx', 'value' => request('precio_max') ? '€'.request('precio_max') : null],
            ];
            $hasActiveFilters = collect($filterLabels)->filter(fn($f) => $f['value'])->count() > 0;
        @endphp

        @if($hasActiveFilters)
        <div class="active-chips">
            @foreach($filterLabels as $key => $filter)
                @if($filter['value'])
                    @php
                        $removeParams = request()->except($key);
                    @endphp
                    <span class="chip">
                        {{ $filter['label'] }}: <strong>{{ $filter['value'] }}</strong>
                        <a href="{{ route('admin.cervezas', $removeParams) }}" class="chip-remove" title="Quitar filtro">✕</a>
                    </span>
                @endif
            @endforeach
        </div>
        @endif

        {{-- Info de resultados --}}
        <div class="results-info">
            📊 Mostrando <strong>{{ $cervezas->firstItem() }}–{{ $cervezas->lastItem() }}</strong>
            de <strong>{{ $cervezas->total() }}</strong> {{ $cervezas->total() == 1 ? 'cerveza' : 'cervezas' }}
            @if(request('search'))
                para <strong>"{{ request('search') }}"</strong>
            @endif
        </div>

        {{-- Tabla --}}
        <div class="table-wrapper">
            <div class="table-header">
                <h2>Catálogo de Cervezas</h2>
                <div class="table-header-right">
                    <span class="count-badge">{{ $cervezas->total() }} cervezas</span>
                </div>
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

            @if($cervezas->hasPages())
            <div class="pagination-wrapper">
                {{ $cervezas->appends(request()->query())->links() }}
            </div>
            @endif

            @else
            <div class="empty-state">
                <div class="empty-state-icon">🍺</div>
                <h3>No se encontraron cervezas</h3>
                @if($hasActiveFilters || request('search'))
                    <p style="margin-top:0.5rem;">Prueba a ajustar los filtros.</p>
                    <p style="margin-top:0.5rem;">
                        <a href="{{ route('admin.cervezas') }}" style="color: var(--primary-gold);">Ver todas las cervezas</a>
                    </p>
                @else
                    <p>Crea la primera cerveza del catálogo.</p>
                @endif
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
    }

    // ── Filtros: abrir/cerrar panel ──────────────────────────────
    const filterBody = document.getElementById('filterBody');
    const filterIcon = document.getElementById('filterIcon');

    // Si hay filtros activos, abrir panel automáticamente
    const hasActive = {{ $activeCount > 0 ? 'true' : 'false' }};
    if (hasActive) {
        filterBody.classList.add('open');
        filterIcon.classList.add('open');
    }

    function toggleFilters() {
        filterBody.classList.toggle('open');
        filterIcon.classList.toggle('open');
    }

    // Guardar posición de scroll al enviar form
    document.getElementById('filterForm').addEventListener('submit', function () {
        sessionStorage.setItem('scrollY', window.scrollY);
    });

    window.addEventListener('load', function () {
        const y = sessionStorage.getItem('scrollY');
        if (y) { window.scrollTo(0, parseInt(y)); sessionStorage.removeItem('scrollY'); }
    });
</script>
</body>
</html>