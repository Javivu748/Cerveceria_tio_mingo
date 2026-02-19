<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cervezas - Cervecería Tío Mingo</title>
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
            background-image: repeating-linear-gradient(
                90deg,
                transparent, transparent 2px,
                rgba(212, 165, 116, 0.03) 2px,
                rgba(212, 165, 116, 0.03) 4px
            );
            pointer-events: none;
            z-index: 1;
        }

        .container { position: relative; z-index: 2; }

        /* ── HEADER ── */
        header {
            padding: 1.2rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
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
            font-size: 1.6rem;
            letter-spacing: 3px;
            color: var(--primary-gold);
            text-shadow: 3px 3px 0 var(--deep-amber);
            position: relative;
            white-space: nowrap;
            text-decoration: none;
            flex-shrink: 0;
        }

        .logo::after {
            content: '🍺';
            position: absolute;
            right: -36px; top: -4px;
            font-size: 1.5rem;
        }

        .nav-container {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            flex: 1;
            justify-content: flex-end;
        }

        nav { display: flex; gap: 2rem; align-items: center; }

        nav a {
            color: var(--warm-cream);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
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

        .nav-divider { width: 1px; height: 20px; background: rgba(212, 165, 116, 0.3); }

        .nav-admin-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.45rem 1rem;
            border: 1px solid rgba(212, 165, 116, 0.5);
            color: var(--primary-gold) !important;
            font-size: 0.75rem !important;
            letter-spacing: 1.5px;
            transition: all 0.3s ease !important;
        }

        .nav-admin-link:hover { background: rgba(212, 165, 116, 0.15); border-color: var(--primary-gold); }
        .nav-admin-link::after { display: none !important; }

        .auth-buttons {
            display: flex;
            gap: 0.8rem;
            align-items: center;
            border-left: 1px solid rgba(212, 165, 116, 0.25);
            padding-left: 2rem;
        }

        .user-greeting {
            color: rgba(245, 230, 211, 0.7);
            font-weight: 600;
            font-size: 0.78rem;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        .user-greeting strong { color: var(--primary-gold); }

        .btn-profile {
            padding: 0.55rem 1.2rem;
            background: transparent;
            color: var(--primary-gold);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.78rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: 1px solid var(--primary-gold);
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: inline-block;
        }

        .btn-profile:hover { background: var(--primary-gold); color: var(--dark-brown); transform: translateY(-2px); }

        .btn-logout {
            padding: 0.55rem 1rem;
            background: transparent;
            color: rgba(245, 230, 211, 0.45);
            border: 1px solid rgba(245, 230, 211, 0.2);
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            font-family: 'Montserrat', sans-serif;
        }

        .btn-logout:hover { background: rgba(255,60,60,0.15); color: #ff6b6b; border-color: #ff6b6b; transform: translateY(-2px); }

        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            z-index: 101;
            flex-shrink: 0;
            background: none;
            border: none;
        }

        .menu-toggle span {
            width: 26px; height: 2px;
            background: var(--primary-gold);
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .menu-toggle.active span:nth-child(1) { transform: rotate(45deg) translate(7px, 7px); }
        .menu-toggle.active span:nth-child(2) { opacity: 0; }
        .menu-toggle.active span:nth-child(3) { transform: rotate(-45deg) translate(6px, -6px); }

        /* ── PAGE HERO ── */
        .page-hero {
            padding: 5rem 5% 4rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: -30%; left: 50%;
            transform: translateX(-50%);
            width: 600px; height: 600px;
            background: radial-gradient(circle, var(--deep-amber) 0%, transparent 70%);
            opacity: 0.08;
            pointer-events: none;
        }

        .page-hero h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 5rem;
            color: var(--primary-gold);
            letter-spacing: 4px;
            text-shadow: 4px 4px 0 rgba(184, 134, 11, 0.3);
            animation: fadeInUp 0.8s ease-out both;
            line-height: 1;
        }

        .page-hero p {
            font-size: 1rem;
            color: rgba(245, 230, 211, 0.6);
            font-weight: 300;
            letter-spacing: 2px;
            margin-top: 1rem;
            text-transform: uppercase;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .page-hero-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 2rem;
            animation: fadeInUp 0.8s ease-out 0.3s both;
        }

        .page-hero-divider::before { content: ''; width: 80px; height: 1px; background: linear-gradient(90deg, transparent, var(--primary-gold)); }
        .page-hero-divider::after  { content: ''; width: 80px; height: 1px; background: linear-gradient(90deg, var(--primary-gold), transparent); }
        .page-hero-divider span { font-size: 1.5rem; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ══════════════════════════════════════
           FILTROS — estilo idéntico al admin index
        ══════════════════════════════════════ */
        .filters-bar {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 5% 2.5rem;
            animation: fadeInUp 0.8s ease-out 0.1s both;
        }

        /* Info resultados */
        .results-info {
            color: rgba(245, 230, 211, 0.5);
            font-size: 0.8rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .results-info strong { color: var(--primary-gold); }

        /* Barra de búsqueda separada */
        .search-bar { margin-bottom: 1.5rem; }

        .search-form {
            display: flex;
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
            transition: opacity 0.2s;
            white-space: nowrap;
            font-family: 'Montserrat', sans-serif;
        }

        .btn-search:hover { opacity: 0.9; }

        /* Panel colapsable de filtros */
        .filter-panel {
            margin-bottom: 1rem;
            background: rgba(212, 165, 116, 0.05);
            border: 2px solid var(--primary-gold);
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

        .filter-panel-header:hover { background: rgba(212,165,116,0.08); }

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

        .filter-body { padding: 1.5rem; display: none; }
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
        .filter-select:focus { outline: none; border-color: var(--primary-gold); background: rgba(44,24,16,0.8); }

        .filter-select option { background: #2C1810; color: var(--warm-cream); }

        .price-range { display: flex; gap: 0.5rem; align-items: center; }
        .price-range .filter-input { min-width: 0; }
        .price-range span { color: rgba(245,230,211,0.4); font-size: 0.8rem; white-space: nowrap; }

        .filter-actions { display: flex; gap: 0.8rem; align-items: center; flex-wrap: wrap; }

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

        .btn-apply-filters:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(212,165,116,0.4); }

        .btn-clear-filters {
            padding: 0.75rem 1.5rem;
            background: transparent;
            color: rgba(245,230,211,0.6);
            border: 2px solid rgba(245,230,211,0.3);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.8rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            font-family: 'Montserrat', sans-serif;
            cursor: pointer;
            display: inline-block;
        }

        .btn-clear-filters:hover { border-color: var(--danger); color: var(--danger); }

        /* Chips */
        .active-chips { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 1rem; }

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

        /* ── GRID DE CERVEZAS ── */
        .beers-section { padding: 0 5% 5rem; }

        .beers-grid {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
        }

        .beer-card {
            background: rgba(245, 230, 211, 0.04);
            border: 1px solid rgba(212, 165, 116, 0.2);
            position: relative;
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
            animation: fadeInUp 0.6s ease-out both;
        }

        .beer-card:nth-child(1) { animation-delay: 0.05s; }
        .beer-card:nth-child(2) { animation-delay: 0.10s; }
        .beer-card:nth-child(3) { animation-delay: 0.15s; }
        .beer-card:nth-child(4) { animation-delay: 0.20s; }
        .beer-card:nth-child(5) { animation-delay: 0.25s; }
        .beer-card:nth-child(6) { animation-delay: 0.30s; }

        .beer-card::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212,165,116,0.06), transparent);
            transition: left 0.6s ease;
        }

        .beer-card:hover::before { left: 100%; }
        .beer-card:hover { transform: translateY(-8px); box-shadow: 0 20px 50px rgba(0,0,0,0.4), 0 0 0 1px rgba(212,165,116,0.4); border-color: rgba(212,165,116,0.5); }

        .beer-image-wrapper {
            position: relative;
            height: 280px;
            overflow: hidden;
            background: linear-gradient(180deg, rgba(212,165,116,0.05) 0%, rgba(44,24,16,0.8) 100%);
        }

        .beer-image-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 100%; height: 60%;
            background: linear-gradient(to top, rgba(44,24,16,0.9), transparent);
            z-index: 1;
        }

        .beer-image {
            width: 100%; height: 100%;
            object-fit: contain; object-position: center;
            padding: 1.5rem;
            transition: transform 0.6s ease;
            position: relative; z-index: 0;
        }

        .beer-card:hover .beer-image { transform: scale(1.06); }

        .beer-formato-badge {
            position: absolute; top: 1rem; left: 1rem;
            background: rgba(44,24,16,0.9);
            border: 1px solid rgba(212,165,116,0.4);
            color: var(--primary-gold);
            font-size: 0.65rem; letter-spacing: 1.5px; text-transform: uppercase;
            padding: 0.3rem 0.7rem; font-weight: 700; z-index: 2;
        }

        .beer-estilo-badge {
            position: absolute; top: 1rem; right: 1rem;
            background: rgba(27,67,50,0.9);
            border: 1px solid rgba(27,67,50,0.8);
            color: #6fcf97;
            font-size: 0.6rem; letter-spacing: 1px; text-transform: uppercase;
            padding: 0.3rem 0.7rem; font-weight: 700; z-index: 2;
        }

        .beer-content { padding: 1.5rem; }

        .beer-cerveceria { font-size: 0.7rem; letter-spacing: 2px; text-transform: uppercase; color: rgba(212,165,116,0.6); font-weight: 600; margin-bottom: 0.5rem; }

        .beer-name { font-family: 'Bebas Neue', sans-serif; font-size: 1.6rem; color: var(--warm-cream); letter-spacing: 1.5px; line-height: 1.1; margin-bottom: 1rem; }

        .beer-attributes { display: flex; flex-wrap: wrap; gap: 0.6rem; margin-bottom: 1.2rem; }

        .beer-attr { display: flex; align-items: center; gap: 0.4rem; font-size: 0.72rem; color: rgba(245,230,211,0.6); font-weight: 600; letter-spacing: 0.5px; }
        .beer-attr-icon { font-size: 0.85rem; }

        .beer-divider { height: 1px; background: linear-gradient(90deg, rgba(212,165,116,0.3), transparent); margin-bottom: 1.2rem; }

        .beer-footer { display: flex; justify-content: space-between; align-items: center; }

        .beer-price { font-family: 'Bebas Neue', sans-serif; font-size: 2rem; color: var(--primary-gold); letter-spacing: 1px; line-height: 1; }
        .beer-price-label { font-size: 0.65rem; letter-spacing: 1px; color: rgba(212,165,116,0.5); text-transform: uppercase; margin-top: 0.2rem; font-weight: 600; }

        .beer-btn {
            padding: 0.7rem 1.4rem;
            background: transparent;
            border: 1px solid var(--primary-gold);
            color: var(--primary-gold);
            font-family: 'Montserrat', sans-serif;
            font-weight: 700; font-size: 0.7rem; letter-spacing: 1.5px; text-transform: uppercase;
            cursor: pointer; text-decoration: none; transition: all 0.3s ease; display: inline-block;
        }

        .beer-btn:hover { background: var(--primary-gold); color: var(--dark-brown); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(212,165,116,0.3); }

        /* Paginación */
        .pagination-wrapper {
            max-width: 1400px; margin: 0 auto; padding: 0 0 6rem;
            display: flex; justify-content: center; align-items: center; gap: 0.5rem; flex-wrap: wrap;
        }

        .pagination-wrapper nav { display: flex; align-items: center; gap: 0.4rem; }
        .pagination-wrapper nav svg { width: 14px; height: 14px; }

        .pagination-wrapper span[aria-current="page"] > span,
        .pagination-wrapper a {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 42px; height: 42px; padding: 0 0.8rem;
            font-family: 'Montserrat', sans-serif; font-size: 0.8rem; font-weight: 600; letter-spacing: 1px;
            border: 1px solid rgba(212,165,116,0.3); color: rgba(245,230,211,0.6);
            text-decoration: none; transition: all 0.3s ease; background: transparent;
        }

        .pagination-wrapper span[aria-current="page"] > span { background: var(--primary-gold); border-color: var(--primary-gold); color: var(--dark-brown); font-weight: 700; }
        .pagination-wrapper a:hover { border-color: var(--primary-gold); color: var(--primary-gold); background: rgba(212,165,116,0.1); transform: translateY(-2px); }
        .pagination-wrapper span[aria-disabled="true"] > span { display: inline-flex; align-items: center; justify-content: center; min-width: 42px; height: 42px; padding: 0 0.8rem; border: 1px solid rgba(212,165,116,0.1); color: rgba(245,230,211,0.2); font-family: 'Montserrat', sans-serif; font-size: 0.8rem; }

        /* Footer */
        footer { padding: 2.5rem 5%; border-top: 2px solid rgba(212,165,116,0.3); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; background: rgba(20,10,5,0.5); }
        .footer-logo { font-family: 'Bebas Neue', sans-serif; font-size: 1.4rem; letter-spacing: 3px; color: var(--primary-gold); opacity: 0.7; }
        .footer-text { font-size: 0.8rem; color: rgba(245,230,211,0.4); letter-spacing: 1px; }

        /* Estado vacío */
        .empty-state { text-align: center; padding: 6rem 2rem; grid-column: 1 / -1; }
        .empty-state .empty-icon { font-size: 4rem; margin-bottom: 1.5rem; }
        .empty-state h3 { font-family: 'Bebas Neue', sans-serif; font-size: 2rem; color: var(--primary-gold); letter-spacing: 2px; margin-bottom: 0.8rem; }
        .empty-state p { color: rgba(245,230,211,0.5); font-weight: 300; }
        .empty-state a { color: var(--primary-gold); }

        /* Responsive */
        @media (max-width: 1100px) {
            .beers-grid { grid-template-columns: repeat(2, 1fr); }
            .filter-grid { grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); }
        }

        @media (max-width: 968px) {
            .menu-toggle { display: flex; }
            .nav-container { position: fixed; top: 0; right: -100%; height: 100vh; width: 290px; background: rgba(30,15,8,0.98); backdrop-filter: blur(20px); flex-direction: column; justify-content: center; padding: 5rem 2rem 2rem; gap: 2rem; transition: right 0.4s ease; border-left: 2px solid var(--primary-gold); }
            .nav-container.active { right: 0; }
            nav { flex-direction: column; gap: 1.2rem; width: 100%; }
            .nav-divider { width: 100%; height: 1px; }
            .nav-admin-link { width: 100%; justify-content: center; padding: 0.7rem 1rem; }
            nav a { font-size: 0.95rem; padding: 0.4rem 0; width: 100%; text-align: center; }
            .auth-buttons { flex-direction: column; width: 100%; border-left: none; border-top: 1px solid rgba(212,165,116,0.25); padding-left: 0; padding-top: 1.5rem; gap: 0.8rem; }
            .btn-profile, .btn-logout { width: 100%; text-align: center; padding: 0.85rem 1.5rem; font-size: 0.85rem; }
            .user-greeting { text-align: center; }
            .page-hero h1 { font-size: 3.5rem; }
            .filter-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 640px) {
            .beers-grid { grid-template-columns: 1fr; }
            .page-hero h1 { font-size: 2.8rem; }
            .beers-section { padding: 0 4% 4rem; }
            .filters-bar { padding: 0 4% 2rem; }
            .filter-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="container">

    {{-- ── HEADER ── --}}
    <header>
        <a href="{{ url('/') }}" class="logo">CERVECERÍA TÍO MINGO</a>

        <button class="menu-toggle" onclick="toggleMenu()" aria-label="Abrir menú">
            <span></span><span></span><span></span>
        </button>

        <div class="nav-container" id="navContainer">
            <nav>
                @if(auth()->check() && auth()->user()->role === 'ADMIN')
                    <a href="{{ route('admin.cervezas') }}" class="active">Cervezas</a>
                @else
                    <a href="{{ route('cervezas') }}" class="active">Cervezas</a>
                @endif
                <a href="#">Nosotros</a>
                <a href="#">Tienda</a>
                <a href="{{ route('pedidos.index') }}">Pedidos</a>

                @if(auth()->check() && auth()->user()->role === 'ADMIN')
                    <span class="nav-divider"></span>
                    <a href="{{ route('admin.usuarios') }}" class="nav-admin-link">⚙️ Panel Admin</a>
                @endif
            </nav>

            <div class="auth-buttons">
                <span class="user-greeting">¡Hola, <strong>{{ Auth::user()->nombre }}</strong>!</span>
                <a href="{{ route('profile.edit') }}" class="btn-profile">Mi Perfil</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Salir</button>
                </form>
            </div>
        </div>
    </header>

    {{-- ── PAGE HERO ── --}}
    <section class="page-hero">
        <h1>NUESTRAS CERVEZAS</h1>
        <p>{{ $cervezas->total() }} referencias disponibles</p>
        <div class="page-hero-divider"><span>🍺</span></div>
    </section>

    {{-- ══════════════════════════════════════
         FILTROS — mismo estilo que admin index
    ══════════════════════════════════════ --}}
    <div class="filters-bar">

        @php
            $activeCount = collect(['cerveceria_id','estilo_id','formato','capacidad','precio_min','precio_max','sort_by'])
                ->filter(fn($k) => request()->filled($k))
                ->count();
            $hasActiveFilters = $activeCount > 0 || request()->filled('search');
        @endphp

        {{-- Info resultados --}}
        <div class="results-info">
            📊 Mostrando <strong>{{ $cervezas->firstItem() }}–{{ $cervezas->lastItem() }}</strong>
            de <strong>{{ $cervezas->total() }}</strong> {{ $cervezas->total() == 1 ? 'cerveza' : 'cervezas' }}
            @if(request('search'))
                para <strong>"{{ request('search') }}"</strong>
            @endif
        </div>

        <form method="GET" action="{{ route('cervezas') }}" id="filterForm">

            {{-- Barra de búsqueda SEPARADA --}}
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

            {{-- Panel colapsable de filtros --}}
            <div class="filter-panel">
                <div class="filter-panel-header" onclick="toggleFilters()">
                    <div class="filter-panel-title">
                        🎛️ Filtros avanzados
                        @if($activeCount > 0)
                            <span class="active-filters-count">{{ $activeCount }} activos</span>
                        @endif
                    </div>
                    <span class="filter-toggle-icon {{ $activeCount > 0 ? 'open' : '' }}" id="filterIcon">▼</span>
                </div>

                <div class="filter-body {{ $activeCount > 0 ? 'open' : '' }}" id="filterBody">
                    <div class="filter-grid">

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

                        <div class="filter-group">
                            <label class="filter-label">Formato</label>
                            <select name="formato" class="filter-select">
                                <option value="">Todos</option>
                                <option value="Lata"    {{ request('formato') === 'Lata'    ? 'selected' : '' }}>🥫 Lata</option>
                                <option value="Botella" {{ request('formato') === 'Botella' ? 'selected' : '' }}>🍾 Botella</option>
                            </select>
                        </div>

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

                        <div class="filter-group">
                            <label class="filter-label">Ordenar por</label>
                            <select name="sort_by" class="filter-select">
                                <option value="id"         {{ request('sort_by','id') === 'id'      ? 'selected' : '' }}>Por defecto</option>
                                <option value="name"       {{ request('sort_by') === 'name'         ? 'selected' : '' }}>Nombre A-Z</option>
                                <option value="precio_eur" {{ request('sort_by') === 'precio_eur'   ? 'selected' : '' }}>Precio</option>
                                <option value="capacidad"  {{ request('sort_by') === 'capacidad'    ? 'selected' : '' }}>Capacidad</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Orden</label>
                            <select name="sort_order" class="filter-select">
                                <option value="asc"  {{ request('sort_order','asc') === 'asc'  ? 'selected' : '' }}>↑ Ascendente</option>
                                <option value="desc" {{ request('sort_order') === 'desc'       ? 'selected' : '' }}>↓ Descendente</option>
                            </select>
                        </div>

                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn-apply-filters">✅ Aplicar filtros</button>
                        <a href="{{ route('cervezas') }}" class="btn-clear-filters">✖ Limpiar todo</a>
                    </div>
                </div>
            </div>

        </form>

        {{-- Chips de filtros activos --}}
        @php
            $filterLabels = [
                'search'        => ['label' => 'Búsqueda',   'value' => request('search')],
                'cerveceria_id' => ['label' => 'Cervecería', 'value' => $cervecerias->find(request('cerveceria_id'))?->nombre ?? null],
                'estilo_id'     => ['label' => 'Estilo',     'value' => $estilos->find(request('estilo_id'))?->nombre ?? null],
                'formato'       => ['label' => 'Formato',    'value' => request('formato')],
                'capacidad'     => ['label' => 'Capacidad',  'value' => request('capacidad') ? request('capacidad').' ml' : null],
                'precio_min'    => ['label' => 'Precio mín', 'value' => request('precio_min') ? '€'.request('precio_min') : null],
                'precio_max'    => ['label' => 'Precio máx', 'value' => request('precio_max') ? '€'.request('precio_max') : null],
            ];
        @endphp

        @if($hasActiveFilters)
        <div class="active-chips">
            @foreach($filterLabels as $key => $filter)
                @if($filter['value'])
                    <span class="chip">
                        {{ $filter['label'] }}: <strong>{{ $filter['value'] }}</strong>
                        <a href="{{ route('cervezas', request()->except($key)) }}" class="chip-remove" title="Quitar filtro">✕</a>
                    </span>
                @endif
            @endforeach
        </div>
        @endif

    </div>

    {{-- ── GRID DE CERVEZAS ── --}}
    <section class="beers-section">
        <div class="beers-grid">

            @forelse($cervezas as $cerveza)
            <article class="beer-card">

                <div class="beer-image-wrapper">
                    <span class="beer-formato-badge">
                        @if($cerveza->formato === 'Lata') 🥫 @else 🍾 @endif
                        {{ $cerveza->formato }}
                    </span>

                    @if($cerveza->estilo)
                    <span class="beer-estilo-badge">
                        {{ $cerveza->estilo->name ?? $cerveza->estilo->nombre ?? 'Estilo' }}
                    </span>
                    @endif

                    <img
                        src="{{ $cerveza->imagen_url }}"
                        alt="{{ $cerveza->name }}"
                        class="beer-image"
                        loading="lazy"
                        onerror="this.src='https://picsum.photos/seed/beer{{ $cerveza->id }}/400/600'"
                    >
                </div>

                <div class="beer-content">

                    @if($cerveza->cerveceria)
                    <div class="beer-cerveceria">
                        {{ $cerveza->cerveceria->name ?? $cerveza->cerveceria->nombre }}
                    </div>
                    @endif

                    <h2 class="beer-name">{{ $cerveza->name }}</h2>

                    <div class="beer-attributes">
                        <div class="beer-attr">
                            <span class="beer-attr-icon">📏</span>
                            <span>{{ $cerveza->capacidad }} ml</span>
                        </div>
                        @if($cerveza->estilo)
                        <div class="beer-attr">
                            <span class="beer-attr-icon">🏷️</span>
                            <span>{{ $cerveza->estilo->nombre ?? '—' }}</span>
                        </div>
                        @endif
                        @if($cerveza->cerveceria)
                        <div class="beer-attr">
                            <span class="beer-attr-icon">🏭</span>
                            <span>{{ $cerveza->cerveceria->nombre ?? '—' }}</span>
                        </div>
                        @endif
                        <div class="beer-attr">
                            <span class="beer-attr-icon">🥫</span>
                            <span>{{ $cerveza->formato }}</span>
                        </div>
                    </div>

                    <div class="beer-divider"></div>

                    <div class="beer-footer">
                        <div>
                            <div class="beer-price">€{{ number_format($cerveza->precio_eur, 2) }}</div>
                            <div class="beer-price-label">Precio unidad</div>
                        </div>
                        <a href="{{ route('cervezas.show', $cerveza->id) }}" class="beer-btn">Ver más</a>
                    </div>
                </div>
            </article>
            @empty
            <div class="empty-state">
                <div class="empty-icon">🍺</div>
                <h3>No hay cervezas disponibles</h3>
                @if($hasActiveFilters)
                    <p>Prueba a ajustar los filtros.</p>
                    <p style="margin-top:0.5rem;"><a href="{{ route('cervezas') }}">Ver todas las cervezas</a></p>
                @else
                    <p>Pronto tendremos nuevas referencias en stock.</p>
                @endif
            </div>
            @endforelse

        </div>

        @if($cervezas->hasPages())
        <div class="pagination-wrapper">
            {{ $cervezas->appends(request()->query())->links() }}
        </div>
        @endif

    </section>

    <footer>
        <div class="footer-logo">CERVECERÍA TÍO MINGO</div>
        <div class="footer-text">© {{ date('Y') }} — Hecho con pasión 🍺</div>
    </footer>

</div>

<script>
    function toggleMenu() {
        document.getElementById('navContainer').classList.toggle('active');
        document.querySelector('.menu-toggle').classList.toggle('active');
    }

    // Filtros: abrir/cerrar panel
    const filterBody = document.getElementById('filterBody');
    const filterIcon = document.getElementById('filterIcon');

    const hasActive = {{ $activeCount > 0 ? 'true' : 'false' }};
    if (hasActive) {
        filterBody.classList.add('open');
        filterIcon.classList.add('open');
    }

    function toggleFilters() {
        filterBody.classList.toggle('open');
        filterIcon.classList.toggle('open');
    }

    // Guardar scroll al enviar form
    document.getElementById('filterForm').addEventListener('submit', function () {
        sessionStorage.setItem('scrollY', window.scrollY);
    });

    window.addEventListener('load', function () {
        const y = sessionStorage.getItem('scrollY');
        if (y) { window.scrollTo(0, parseInt(y)); sessionStorage.removeItem('scrollY'); }
    });

    document.querySelectorAll('.nav-container a, .nav-container button[type="submit"]').forEach(el => {
        el.addEventListener('click', () => {
            document.getElementById('navContainer').classList.remove('active');
            document.querySelector('.menu-toggle').classList.remove('active');
        });
    });

    document.addEventListener('click', (e) => {
        const nav = document.getElementById('navContainer');
        const toggle = document.querySelector('.menu-toggle');
        if (!nav.contains(e.target) && !toggle.contains(e.target)) {
            nav.classList.remove('active');
            toggle.classList.remove('active');
        }
    });
</script>
</body>
</html>