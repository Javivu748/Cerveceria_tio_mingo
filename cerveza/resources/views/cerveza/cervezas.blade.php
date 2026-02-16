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
            right: -40px; top: -5px;
            font-size: 1.8rem;
        }

        .nav-container {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

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

        .btn-profile, .btn-logout {
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
            background: transparent;
        }

        .btn-profile { color: var(--primary-gold); }
        .btn-profile:hover {
            background: var(--primary-gold);
            color: var(--dark-brown);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 165, 116, 0.3);
        }

        .btn-logout {
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

        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            z-index: 101;
        }
        .menu-toggle span {
            width: 30px; height: 3px;
            background: var(--primary-gold);
            transition: all 0.3s ease;
        }

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

        .page-hero-divider::before,
        .page-hero-divider::after {
            content: '';
            width: 80px; height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-gold));
        }

        .page-hero-divider::after {
            background: linear-gradient(90deg, var(--primary-gold), transparent);
        }

        .page-hero-divider span {
            font-size: 1.5rem;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        

        .results-info {
            font-size: 0.8rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(245, 230, 211, 0.5);
        }

        .results-info span {
            color: var(--primary-gold);
            font-weight: 700;
        }

        .filter-tags {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .filter-tag {
            padding: 0.4rem 1rem;
            border: 1px solid rgba(212, 165, 116, 0.3);
            background: transparent;
            color: rgba(245, 230, 211, 0.6);
            font-size: 0.75rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .filter-tag:hover,
        .filter-tag.active {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            background: rgba(212, 165, 116, 0.1);
        }

        /* ── GRID DE CERVEZAS ── */
        .beers-section {
            padding: 0 5% 5rem;
        }

        .beers-grid {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
        }

        /* ── BEER CARD ── */
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

        .beer-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(212, 165, 116, 0.4);
            border-color: rgba(212, 165, 116, 0.5);
        }

        /* Imagen */
        .beer-image-wrapper {
            position: relative;
            height: 280px;
            overflow: hidden;
            background: linear-gradient(180deg,
                rgba(212, 165, 116, 0.05) 0%,
                rgba(44, 24, 16, 0.8) 100%
            );
        }

        .beer-image-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 100%; height: 60%;
            background: linear-gradient(to top, rgba(44, 24, 16, 0.9), transparent);
            z-index: 1;
        }

        .beer-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            padding: 1.5rem;
            transition: transform 0.6s ease;
            position: relative;
            z-index: 0;
        }

        .beer-card:hover .beer-image {
            transform: scale(1.06);
        }

        /* Badge de formato */
        .beer-formato-badge {
            position: absolute;
            top: 1rem; left: 1rem;
            background: rgba(44, 24, 16, 0.9);
            border: 1px solid rgba(212, 165, 116, 0.4);
            color: var(--primary-gold);
            font-size: 0.65rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 0.3rem 0.7rem;
            font-weight: 700;
            z-index: 2;
        }

        /* Badge de estilo */
        .beer-estilo-badge {
            position: absolute;
            top: 1rem; right: 1rem;
            background: rgba(27, 67, 50, 0.9);
            border: 1px solid rgba(27, 67, 50, 0.8);
            color: #6fcf97;
            font-size: 0.6rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 0.3rem 0.7rem;
            font-weight: 700;
            z-index: 2;
        }

        /* Contenido de la card */
        .beer-content {
            padding: 1.5rem;
        }

        .beer-cerveceria {
            font-size: 0.7rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(212, 165, 116, 0.6);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .beer-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.6rem;
            color: var(--warm-cream);
            letter-spacing: 1.5px;
            line-height: 1.1;
            margin-bottom: 1rem;
        }

        /* Atributos */
        .beer-attributes {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
            margin-bottom: 1.2rem;
        }

        .beer-attr {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.72rem;
            color: rgba(245, 230, 211, 0.6);
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .beer-attr-icon {
            font-size: 0.85rem;
        }

        /* Separador */
        .beer-divider {
            height: 1px;
            background: linear-gradient(90deg, rgba(212, 165, 116, 0.3), transparent);
            margin-bottom: 1.2rem;
        }

        /* Footer de la card (precio + acción) */
        .beer-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .beer-price {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            color: var(--primary-gold);
            letter-spacing: 1px;
            line-height: 1;
        }

        .beer-price-label {
            font-size: 0.65rem;
            letter-spacing: 1px;
            color: rgba(212, 165, 116, 0.5);
            text-transform: uppercase;
            margin-top: 0.2rem;
            font-weight: 600;
        }

        .beer-btn {
            padding: 0.7rem 1.4rem;
            background: transparent;
            border: 1px solid var(--primary-gold);
            color: var(--primary-gold);
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 0.7rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .beer-btn:hover {
            background: var(--primary-gold);
            color: var(--dark-brown);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 165, 116, 0.3);
        }

        /* ── PAGINACIÓN ── */
        .pagination-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 0 6rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .pagination-wrapper .page-info {
            font-size: 0.75rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(245, 230, 211, 0.4);
            margin: 0 1.5rem;
        }

        /* Estilos personalizados para la paginación de Laravel */
        .pagination-wrapper nav {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .pagination-wrapper nav svg {
            width: 14px;
            height: 14px;
        }

        .pagination-wrapper span[aria-current="page"] > span,
        .pagination-wrapper a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            height: 42px;
            padding: 0 0.8rem;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 1px;
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
            transform: translateY(-2px);
        }

        .pagination-wrapper span[aria-disabled="true"] > span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            height: 42px;
            padding: 0 0.8rem;
            border: 1px solid rgba(212, 165, 116, 0.1);
            color: rgba(245, 230, 211, 0.2);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8rem;
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

        /* ── ESTADO VACÍO ── */
        .empty-state {
            text-align: center;
            padding: 6rem 2rem;
            grid-column: 1 / -1;
        }

        .empty-state .empty-icon { font-size: 4rem; margin-bottom: 1.5rem; }

        .empty-state h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            color: var(--primary-gold);
            letter-spacing: 2px;
            margin-bottom: 0.8rem;
        }

        .empty-state p {
            color: rgba(245, 230, 211, 0.5);
            font-weight: 300;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1100px) {
            .beers-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 968px) {
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
            .auth-buttons { flex-direction: column; width: 100%; gap: 1rem; }
            .btn-profile, .btn-logout { width: 100%; text-align: center; padding: 1rem 1.5rem; }
            .user-greeting { text-align: center; }
            .menu-toggle { display: flex; }
            .page-hero h1 { font-size: 3.5rem; }
        }

        @media (max-width: 640px) {
            .beers-grid { grid-template-columns: 1fr; }
            .page-hero h1 { font-size: 2.8rem; }
            .beers-section { padding: 0 4% 4rem; }
            .filters-bar { padding: 0 4% 2rem; }
        }
    </style>
</head>
<body>
<div class="container">

    {{-- ── HEADER ── --}}
    <header>
        <a href="{{ url('/') }}" class="logo">CERVECERÍA TÍO MINGO</a>

        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span><span></span><span></span>
        </div>

        <div class="nav-container" id="navContainer">
            <nav>
                <a href="#" class="active">Cervezas</a>
                <a href="#">Nosotros</a>
                <a href="#">Tienda</a>
                <a href="{{ route('pedidos.index') }}">Pedidos</a>
            </nav>

            <div class="auth-buttons">
                <span class="user-greeting">¡Hola, {{ Auth::user()->nombre }}!</span>
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
        <div class="page-hero-divider">
            <span>🍺</span>
        </div>
    </section>

    {{-- ── FILTROS ── --}}
    <div class="filters-bar">
        <div class="results-info">
            Mostrando <span>{{ $cervezas->firstItem() }}–{{ $cervezas->lastItem() }}</span>
            de <span>{{ $cervezas->total() }}</span> cervezas
            &nbsp;·&nbsp; Página <span>{{ $cervezas->currentPage() }}</span>
            de <span>{{ $cervezas->lastPage() }}</span>
        </div>

        
    </div>

    {{-- ── GRID DE CERVEZAS ── --}}
    <section class="beers-section">
        <div class="beers-grid">

            @forelse($cervezas as $cerveza)
            <article class="beer-card">

                {{-- Imagen --}}
                <div class="beer-image-wrapper">
                    {{-- Badge formato --}}
                    <span class="beer-formato-badge">
                        @if($cerveza->formato === 'Lata') 🥫 @else 🍾 @endif
                        {{ $cerveza->formato }}
                    </span>

                    {{-- Badge estilo --}}
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

                {{-- Contenido --}}
                <div class="beer-content">

                    {{-- Cervecería --}}
                    @if($cerveza->cerveceria)
                    <div class="beer-cerveceria">
                        {{ $cerveza->cerveceria->name ?? $cerveza->cerveceria->nombre }}
                    </div>
                    @endif

                    {{-- Nombre --}}
                    <h2 class="beer-name">{{ $cerveza->name }}</h2>

                    {{-- Atributos --}}
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

                    {{-- Footer: precio + botón --}}
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
                <p>Pronto tendremos nuevas referencias en stock.</p>
            </div>
            @endforelse

        </div>

        {{-- ── PAGINACIÓN ── --}}
        @if($cervezas->hasPages())
        <div class="pagination-wrapper">
            {{ $cervezas->links() }}
        </div>
        @endif

    </section>

    {{-- ── FOOTER ── --}}
    <footer>
        <div class="footer-logo">CERVECERÍA TÍO MINGO</div>
        <div class="footer-text">© {{ date('Y') }} — Hecho con pasión 🍺</div>
    </footer>

</div>

<script>
    function toggleMenu() {
        const nav = document.getElementById('navContainer');
        const toggle = document.querySelector('.menu-toggle');
        nav.classList.toggle('active');
        toggle.classList.toggle('active');
    }

    document.querySelectorAll('.nav-container a, .nav-container button').forEach(el => {
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