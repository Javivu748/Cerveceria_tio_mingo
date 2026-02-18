<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Cerveza - Admin</title>
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
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 5%;
        }

        .page-header {
            margin-bottom: 2rem;
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

        .form-card {
            background: rgba(212, 165, 116, 0.05);
            border: 2px solid var(--primary-gold);
            padding: 2.5rem;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            color: var(--primary-gold);
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        input[type="number"],
        input[type="url"],
        textarea,
        select {
            width: 100%;
            padding: 0.9rem 1.2rem;
            background: rgba(44, 24, 16, 0.5);
            border: 1px solid rgba(212, 165, 116, 0.3);
            color: var(--warm-cream);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: var(--primary-gold);
            background: rgba(44, 24, 16, 0.7);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        select {
            cursor: pointer;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .error-text {
            color: var(--danger);
            font-size: 0.75rem;
            margin-top: 0.3rem;
            display: block;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(212, 165, 116, 0.2);
        }

        .btn-submit {
            flex: 1;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-gold), var(--deep-amber));
            color: var(--dark-brown);
            border: none;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(212, 165, 116, 0.4);
        }

        .btn-cancel {
            padding: 1rem 2rem;
            background: transparent;
            color: rgba(245, 230, 211, 0.6);
            border: 2px solid rgba(245, 230, 211, 0.3);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-cancel:hover {
            border-color: var(--danger);
            color: var(--danger);
        }

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
            .form-row {
                grid-template-columns: 1fr;
            }
            .form-actions {
                flex-direction: column-reverse;
            }
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

        <div class="page-header">
            <h1>🍺 Nueva Cerveza</h1>
            <p>Añade una nueva cerveza al catálogo</p>
        </div>

        <div class="form-card">
            <form method="POST" action="{{ route('admin.cervezas.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nombre *</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required
                    >
                    @error('name')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea 
                        id="descripcion" 
                        name="descripcion"
                    >{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="estilo_id">Estilo *</label>
                        <select id="estilo_id" name="estilo_id" required>
                            <option value="">Seleccionar estilo</option>
                            @foreach($estilos as $estilo)
                                <option 
                                    value="{{ $estilo->id }}"
                                    {{ old('estilo_id') == $estilo->id ? 'selected' : '' }}
                                >
                                    {{ $estilo->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('estilo_id')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cerveceria_id">Cervecería *</label>
                        <select id="cerveceria_id" name="cerveceria_id" required>
                            <option value="">Seleccionar cervecería</option>
                            @foreach($cervecerias as $cerveceria)
                                <option 
                                    value="{{ $cerveceria->id }}"
                                    {{ old('cerveceria_id') == $cerveceria->id ? 'selected' : '' }}
                                >
                                    {{ $cerveceria->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('cerveceria_id')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="formato">Formato *</label>
                        <select id="formato" name="formato" required>
                            <option value="">Seleccionar formato</option>
                            <option value="Lata" {{ old('formato') == 'Lata' ? 'selected' : '' }}>
                                🥫 Lata
                            </option>
                            <option value="Botella" {{ old('formato') == 'Botella' ? 'selected' : '' }}>
                                🍾 Botella
                            </option>
                        </select>
                        @error('formato')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="capacidad">Capacidad (ml) *</label>
                        <input 
                            type="number" 
                            id="capacidad" 
                            name="capacidad" 
                            value="{{ old('capacidad') }}" 
                            min="1"
                            step="1"
                            required
                        >
                        @error('capacidad')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="precio_eur">Precio (EUR) *</label>
                    <input 
                        type="number" 
                        id="precio_eur" 
                        name="precio_eur" 
                        value="{{ old('precio_eur') }}" 
                        min="0"
                        step="0.01"
                        required
                    >
                    @error('precio_eur')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="imagen_url">URL de Imagen</label>
                    <input 
                        type="url" 
                        id="imagen_url" 
                        name="imagen_url" 
                        value="{{ old('imagen_url') }}"
                        placeholder="https://ejemplo.com/imagen.jpg"
                    >
                    @error('imagen_url')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.cervezas') }}" class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-submit">✨ Crear Cerveza</button>
                </div>
            </form>
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