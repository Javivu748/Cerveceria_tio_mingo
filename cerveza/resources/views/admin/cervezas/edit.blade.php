<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cerveza - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gold: #D4A574;
            --deep-amber: #B8860B;
            --dark-brown: #2C1810;
            --warm-cream: #F5E6D3;
            --danger: #ff6b6b;
            --success: #51cf66;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--dark-brown);
            color: var(--warm-cream);
            min-height: 100vh;
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
        }

        .logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            letter-spacing: 3px;
            color: var(--primary-gold);
            text-shadow: 3px 3px 0 var(--deep-amber);
            text-decoration: none;
        }

        .btn-back {
            padding: 0.7rem 1.5rem;
            background: transparent;
            color: var(--warm-cream);
            border: 2px solid rgba(245, 230, 211, 0.3);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            border-color: var(--primary-gold);
            color: var(--primary-gold);
            transform: translateY(-2px);
        }

        .form-content {
            max-width: 800px;
            margin: 3rem auto;
            padding: 0 5%;
        }

        .page-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.5rem;
            color: var(--primary-gold);
            text-shadow: 2px 2px 0 var(--deep-amber);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: rgba(245, 230, 211, 0.6);
            font-size: 0.85rem;
            margin-bottom: 2rem;
        }

        .form-card {
            background: rgba(212, 165, 116, 0.05);
            border: 2px solid var(--primary-gold);
            padding: 2.5rem;
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

        @media (max-width: 768px) {
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
        <a href="{{ route('admin.cervezas') }}" class="logo">← ADMIN</a>
        <a href="{{ route('admin.cervezas') }}" class="btn-back">Volver al listado</a>
    </header>

    <div class="form-content">
        <h1 class="page-title">✏️ Editar Cerveza</h1>
        <p class="page-subtitle">Modificando: {{ $cerveza->name }}</p>

        <div class="form-card">
            <form method="POST" action="{{ route('admin.cervezas.update', $cerveza->id) }}">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name">Nombre *</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $cerveza->name) }}" 
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
                    >{{ old('descripcion', $cerveza->descripcion) }}</textarea>
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
                                    {{ old('estilo_id', $cerveza->estilo_id) == $estilo->id ? 'selected' : '' }}
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
                                    {{ old('cerveceria_id', $cerveza->cerveceria_id) == $cerveceria->id ? 'selected' : '' }}
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
                            <option value="Lata" {{ old('formato', $cerveza->formato) == 'Lata' ? 'selected' : '' }}>
                                🥫 Lata
                            </option>
                            <option value="Botella" {{ old('formato', $cerveza->formato) == 'Botella' ? 'selected' : '' }}>
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
                            value="{{ old('capacidad', $cerveza->capacidad) }}" 
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
                        value="{{ old('precio_eur', $cerveza->precio_eur) }}" 
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
                        value="{{ old('imagen_url', $cerveza->imagen_url) }}"
                        placeholder="https://ejemplo.com/imagen.jpg"
                    >
                    @error('imagen_url')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.cervezas') }}" class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-submit">💾 Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>