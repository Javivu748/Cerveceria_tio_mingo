<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mis Pedidos - Cervecería Tío Mingo</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
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

*{margin:0;padding:0;box-sizing:border-box;}

body{
    font-family:'Montserrat',sans-serif;
    background:var(--dark-brown);
    color:var(--warm-cream);
    overflow-x:hidden;
}

body::before{
    content:'';
    position:fixed;
    width:100%;
    height:100%;
    background-image:repeating-linear-gradient(
        90deg,
        transparent,
        transparent 2px,
        rgba(212,165,116,0.03) 2px,
        rgba(212,165,116,0.03) 4px
    );
    z-index:1;
    pointer-events:none;
}

.container{position:relative;z-index:2;}

/* HEADER */
header{
    padding:1.5rem 5%;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:2px solid var(--primary-gold);
    background:rgba(44,24,16,0.95);
    position:sticky;
    top:0;
    z-index:100;
}

.logo{
    font-family:'Bebas Neue',sans-serif;
    font-size:2rem;
    letter-spacing:3px;
    color:var(--primary-gold);
    text-decoration:none;
}

.nav-container{
    display:flex;
    align-items:center;
    gap:2rem;
}

nav{
    display:flex;
    gap:2rem;
}

nav a{
    color:var(--warm-cream);
    text-decoration:none;
    font-weight:600;
    font-size:0.9rem;
    text-transform:uppercase;
    letter-spacing:1px;
    position:relative;
}

nav a.active,
nav a:hover{color:var(--primary-gold);}

.auth-buttons{
    display:flex;
    gap:1rem;
    align-items:center;
}

.user-greeting{
    color:var(--primary-gold);
    font-weight:600;
    font-size:0.85rem;
}

.btn-profile,
.btn-logout{
    padding:0.6rem 1.2rem;
    border:2px solid var(--primary-gold);
    background:transparent;
    color:var(--primary-gold);
    font-size:0.8rem;
    cursor:pointer;
    text-transform:uppercase;
    transition:0.3s;
}

.btn-profile:hover{
    background:var(--primary-gold);
    color:var(--dark-brown);
}

.btn-logout{
    border-color:rgba(245,230,211,0.3);
    color:rgba(245,230,211,0.6);
}

.btn-logout:hover{
    border-color:#ff6b6b;
    color:#ff6b6b;
}

/* HERO */
.hero{
    padding:5rem 5%;
    text-align:center;
}

.hero h1{
    font-family:'Bebas Neue',sans-serif;
    font-size:4rem;
    color:var(--primary-gold);
    letter-spacing:2px;
}

.hero span{
    display:block;
    font-size:2rem;
    color:var(--warm-cream);
}

/* FEATURES (cards pedidos) */
.features{
    padding:4rem 5%;
}

.features-title{
    text-align:center;
    font-family:'Bebas Neue',sans-serif;
    font-size:3rem;
    color:var(--primary-gold);
    margin-bottom:3rem;
}

.features-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:2rem;
}

.feature-card{
    background:rgba(245,230,211,0.05);
    padding:2rem;
    border:2px solid var(--primary-gold);
    position:relative;
    transition:0.3s;
}

.feature-card:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 30px rgba(212,165,116,0.2);
}

.card-badge{
    position:absolute;
    top:1rem;
    right:1rem;
    background:var(--forest-green);
    color:white;
    font-size:0.7rem;
    padding:0.3rem 0.6rem;
    text-transform:uppercase;
}

.feature-card h3{
    font-family:'Bebas Neue',sans-serif;
    font-size:1.6rem;
    color:var(--primary-gold);
    margin-bottom:1rem;
}

.feature-card p{
    line-height:1.6;
    font-size:0.95rem;
}

.cta-button{
    display:inline-block;
    margin-top:2rem;
    padding:1rem 2.5rem;
    background:linear-gradient(135deg,var(--primary-gold),var(--deep-amber));
    color:var(--dark-brown);
    text-decoration:none;
    font-weight:700;
    text-transform:uppercase;
}

/* FOOTER */
footer{
    padding:2rem 5%;
    border-top:1px solid rgba(212,165,116,0.3);
    text-align:center;
    font-size:0.8rem;
    color:rgba(245,230,211,0.5);
}
</style>
</head>

<body>
<div class="container">

<header>
    <a href="{{ url('/') }}" class="logo">CERVECERÍA TÍO MINGO</a>

    <div class="nav-container">
        <nav>
            <a href="#">Cervezas</a>
            <a href="#">Nosotros</a>
            <a href="#">Tienda</a>
            <a href="{{ route('pedidos.index') }}" class="active">Pedidos</a>
        </nav>

        <div class="auth-buttons">
            <span class="user-greeting">
                ¡Hola, {{ Auth::user()->nombre }}!
            </span>

            <a href="{{ route('profile.edit') }}" class="btn-profile">Mi Perfil</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Salir</button>
            </form>
        </div>
    </div>
</header>

<section class="hero">
    <h1>
        MIS PEDIDOS
        <span>Historial y Seguimiento</span>
    </h1>
</section>

<section class="features">
    <h2 class="features-title">Listado de Pedidos</h2>

    <div class="features-grid">

        @if($pedidos->isEmpty())
            <div class="feature-card">
                <h3>Sin Pedidos</h3>
                <p>Aún no has realizado ningún pedido.</p>
            </div>
        @else
            @foreach($pedidos as $pedido)
                <div class="feature-card">
                    <span class="card-badge">
                        {{ ucfirst($pedido->estado) }}
                    </span>

                    <h3>Pedido #{{ $pedido->id }}</h3>

                    <p>
                        <strong>Fecha:</strong> {{ $pedido->fecha->format('d/m/Y') }}<br>
                        <strong>Total:</strong> €{{ number_format($pedido->total, 2) }}
                    </p>
                </div>
            @endforeach
        @endif

    </div>

    <div style="text-align:center;">
        <a href="{{ route('pedidos.create') }}" class="cta-button">
            Nuevo Pedido
        </a>
    </div>
</section>

<footer>
    © {{ date('Y') }} — Cervecería Tío Mingo 🍺
</footer>

</div>

<script>
// Aquí puedes añadir JS adicional si lo necesitas
console.log("Vista de pedidos cargada correctamente");
</script>

</body>
</html>
