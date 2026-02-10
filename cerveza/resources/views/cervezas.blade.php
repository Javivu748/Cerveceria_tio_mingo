<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuestras Cervezas - Cervecería Tío Mingo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-gold: #D4A574;
            --deep-amber: #B8860B;
            --dark-brown: #2C1810;
            --warm-cream: #F5E6D3;
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
        }

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
        }

        .logo::after {
            content: ' 🍺';
        }

        .volver {
            text-decoration: none;
            color: var(--primary-gold);
            border: 2px solid var(--primary-gold);
            padding: 0.6rem 1.2rem;
            transition: 0.3s ease;
            font-weight: 600;
        }

        .volver:hover {
            background: var(--primary-gold);
            color: var(--dark-brown);
        }

        .titulo {
            text-align: center;
            margin: 4rem 0 2rem;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3.5rem;
            letter-spacing: 3px;
            color: var(--primary-gold);
        }

        .grid {
            max-width: 1200px;
            margin: 0 auto 5rem;
            padding: 0 5%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
        }

        .card {
            background: rgba(245, 230, 211, 0.05);
            border: 2px solid var(--primary-gold);
            padding: 2rem;
            transition: 0.4s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(212,165,116,0.2);
        }

        .card h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            color: var(--primary-gold);
            margin-bottom: 0.5rem;
        }

        .estilo {
            margin-bottom: 1.2rem;
            font-weight: 600;
            opacity: 0.9;
        }

        .formatos {
            border-top: 1px solid rgba(212,165,116,0.3);
            padding-top: 1rem;
        }

        .formatos li {
            list-style: none;
            margin-bottom: 0.4rem;
            font-size: 0.95rem;
        }

        .empty {
            text-align: center;
            margin: 4rem 0;
            font-size: 1.2rem;
            opacity: 0.8;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">CERVECERÍA TÍO MINGO</div>
    <a href="{{ url('/') }}" class="volver">Volver al Inicio</a>
</header>

<h1 class="titulo">Nuestras Cervezas</h1>

@if($cervezas->count() > 0)

<div class="grid">
    @foreach($cervezas as $cerveza)
        <div class="card">

            <h3>{{ $cerveza->nombre }}</h3>

            <div class="estilo">
                Estilo: {{ $cerveza->estilo }}
            </div>

            <div class="formatos">
                <strong>Formato disponible:</strong>
                <ul>
                    <li>
                        🍺 {{ $cerveza->formato }} - {{ $cerveza->capacidad }}
                    </li>
                </ul>
            </div>


        </div>
    @endforeach
</div>

@else
    <div class="empty">
        No hay cervezas registradas todavía 🍻
    </div>
@endif

</body>
</html>
