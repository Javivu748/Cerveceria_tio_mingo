<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Realizar Pedido - Cervecería Tío Mingo</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
:root{
    --primary-gold:#D4A574;
    --deep-amber:#B8860B;
    --dark-brown:#2C1810;
    --warm-cream:#F5E6D3;
    --forest-green:#1B4332;
}

/* ─────────── Estilos generales ─────────── */
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Montserrat',sans-serif;background:var(--dark-brown);color:var(--warm-cream);}
.container{padding:2rem 5%;position:relative;z-index:2;}

/* TITULOS */
.page-title{font-family:'Bebas Neue',sans-serif;font-size:3.5rem;color:var(--primary-gold);text-align:center;margin-bottom:3rem;letter-spacing:3px;}

/* GRID PRINCIPAL */
.grid-layout{display:grid;grid-template-columns:3fr 1fr;gap:3rem;}

/* CARD CERVEZA */
.beer-card{background:rgba(245,230,211,0.05);border:2px solid var(--primary-gold);padding:1.5rem;text-align:center;transition:0.3s;}
.beer-card:hover{transform:translateY(-8px);box-shadow:0 15px 30px rgba(212,165,116,0.2);}
.beer-card img{width:80px;height:80px;object-fit:cover;border-radius:8px;margin-bottom:1rem;}
.beer-card h4{font-family:'Bebas Neue',sans-serif;font-size:1.3rem;color:var(--primary-gold);margin-bottom:0.5rem;}
.beer-price{font-size:0.9rem;margin-bottom:0.5rem;}
.beer-card input{width:60px;padding:0.4rem;background:transparent;border:1px solid var(--primary-gold);color:var(--warm-cream);text-align:center;}

/* GRID CERVEZAS */
.beers-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:2rem;}

/* RESUMEN */
.summary{border:2px solid var(--primary-gold);padding:2rem;background:rgba(245,230,211,0.05);position:sticky;top:20px;height:fit-content;}
.summary h3{font-family:'Bebas Neue',sans-serif;color:var(--primary-gold);margin-bottom:1.5rem;letter-spacing:2px;}
.summary-item{display:flex;justify-content:space-between;margin-bottom:0.5rem;font-size:0.9rem;}
.total{display:flex;justify-content:space-between;font-size:1.2rem;font-weight:bold;margin-top:1rem;}
.cta-button{display:block;margin-top:2rem;padding:1rem;background:linear-gradient(135deg,var(--primary-gold),var(--deep-amber));color:var(--dark-brown);text-align:center;font-weight:700;border:none;cursor:pointer;text-transform:uppercase;transition:all 0.3s;}
.cta-button:hover{transform:translateY(-3px);box-shadow:0 10px 25px rgba(212,165,116,0.4);}
.cta-button:disabled{opacity:0.5;cursor:not-allowed;transform:none;}

/* ALERTAS */
.alert{padding:1rem;margin-bottom:2rem;border-radius:8px;border:2px solid;}
.alert-danger{background:rgba(255,0,0,0.1);border-color:#ff6b6b;color:#ff6b6b;}
.alert-success{background:rgba(0,255,0,0.1);border-color:#51cf66;color:#51cf66;}
.alert-warning{background:rgba(255,165,0,0.1);border-color:#ffa94d;color:#ffa94d;}

/* ───────── HEADER y FOOTER ───────── */
header{
    padding:1.5rem 5%;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:2px solid var(--primary-gold);
    background: rgba(44,24,16,0.95);
    backdrop-filter: blur(10px);
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
    position:relative;
}
.logo::after{content:'🍺';position:absolute;right:-40px;top:-5px;font-size:1.8rem;}

.nav-container{display:flex;align-items:center;gap:2rem;}
nav{display:flex;gap:2rem;align-items:center;}
nav a{color:var(--warm-cream);text-decoration:none;font-weight:600;font-size:0.9rem;text-transform:uppercase;position:relative;transition:color 0.3s ease;}
nav a::after{content:'';position:absolute;bottom:-5px;left:0;width:0;height:2px;background:var(--primary-gold);transition:width 0.3s ease;}
nav a:hover{color:var(--primary-gold);}
nav a:hover::after{width:100%;}
nav a.active{color:var(--primary-gold);} 
nav a.active::after{width:100%;}

.auth-buttons{display:flex;gap:1rem;align-items:center;}
.user-greeting{color:var(--primary-gold);font-weight:600;font-size:0.85rem;}
.btn-profile,.btn-logout{padding:0.7rem 1.5rem;text-decoration:none;font-weight:600;font-size:0.85rem;text-transform:uppercase;border:2px solid var(--primary-gold);cursor:pointer;display:inline-block;transition:all 0.3s;}
.btn-profile{background:transparent;color:var(--primary-gold);}
.btn-profile:hover{background:var(--primary-gold);color:var(--dark-brown);transform:translateY(-2px);box-shadow:0 5px 15px rgba(212,165,116,0.3);}
.btn-logout{background:transparent;color:rgba(245,230,211,0.6);border-color:rgba(245,230,211,0.3);font-size:0.8rem;}
.btn-logout:hover{background:rgba(255,60,60,0.15);color:#ff6b6b;border-color:#ff6b6b;transform:translateY(-2px);}

footer{
    padding:2.5rem 5%;
    border-top:2px solid rgba(212,165,116,0.3);
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:1rem;
    background:rgba(20,10,5,0.5);
}
.footer-logo{font-family:'Bebas Neue',sans-serif;font-size:1.4rem;letter-spacing:3px;color:var(--primary-gold);opacity:0.7;}
.footer-text{font-size:0.8rem;color:rgba(245,230,211,0.4);letter-spacing:1px;}
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
            <a href="#">Cervezas</a>
            <a href="#">Nosotros</a>
            <a href="#">Tienda</a>
            <a href="{{ route('pedidos.index') }}">Pedidos</a>
        </nav>

        <div class="auth-buttons">
            <span class="user-greeting">
                ¡Hola, {{ Auth::user()->nombre }}!
            </span>
            <a href="{{ route('profile.edit') }}" class="btn-profile">Mi Perfil</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Salir</button>
            </form>
        </div>
    </div>
</header>

{{-- TITULO DE LA PÁGINA --}}
<h1 class="page-title">Realizar Pedido</h1>

{{-- MENSAJES DE ALERTA --}}
@if(session('error'))
    <div class="alert alert-danger">
        ❌ {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        ✅ {{ session('success') }}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">
        ⚠️ {{ session('warning') }}
    </div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul style="margin:0;padding-left:1.5rem;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- FORMULARIO --}}
<form method="POST" action="{{ route('paypal.payment') }}" id="pedidoForm">
@csrf

<div class="grid-layout">

    <!-- CERVEZAS -->
    <div class="beers-grid">
        @foreach($cervezas as $cerveza)
        <div class="beer-card">
            <img src="{{ $cerveza->imagen_url }}" alt="{{ $cerveza->name }}">
            <h4>{{ $cerveza->name }}</h4>
            <div class="beer-price">€{{ number_format($cerveza->precio_eur,2) }}</div>

            <input type="number"
                   name="cervezas[{{ $cerveza->id }}][cantidad]"
                   min="0"
                   value="0"
                   class="cantidad"
                   data-nombre="{{ $cerveza->name }}"
                   data-precio="{{ $cerveza->precio_eur }}">
        </div>
        @endforeach
    </div>

    <!-- RESUMEN -->
    <div class="summary">
        <h3>Resumen del Pedido</h3>

        <div id="resumen">
            <p style="opacity:0.6;">No hay productos seleccionados.</p>
        </div>

        <div class="total">
            <span>Total:</span>
            <span>€<span id="total">0.00</span></span>
        </div>

        <button type="submit" class="cta-button" id="btnPagar">
            💳 Pagar con PayPal
        </button>

        <p style="font-size:0.75rem;opacity:0.6;margin-top:0.5rem;text-align:center;">
            Pasarela segura de PayPal
        </p>
    </div>

</div>
</form>

{{-- FOOTER --}}
<footer>
    <div class="footer-logo">CERVECERÍA TÍO MINGO</div>
    <div class="footer-text">© {{ date('Y') }} — Hecho con pasión 🍺</div>
</footer>

</div>

<script>
const inputs = document.querySelectorAll('.cantidad');
const resumenDiv = document.getElementById('resumen');
const totalSpan = document.getElementById('total');
const form = document.getElementById('pedidoForm');
const btnPagar = document.getElementById('btnPagar');

inputs.forEach(input=>{
    input.addEventListener('input',actualizarResumen);
});

// Validar antes de enviar
form.addEventListener('submit', function (e) {
    const total = parseFloat(totalSpan.innerText);
    
    if (total <= 0) {
        e.preventDefault();
        alert('⚠️ Debes seleccionar al menos un producto para continuar.');
        return false;
    }
    
    // Deshabilitar botón para evitar doble clic
    btnPagar.disabled = true;
    btnPagar.innerText = 'Procesando...';
});

function actualizarResumen(){
    let total=0;
    let contenido='';
    let cantidadProductos = 0;

    inputs.forEach(input=>{
        const cantidad=parseInt(input.value)||0;
        if(cantidad>0){
            const nombre=input.dataset.nombre;
            const precio=parseFloat(input.dataset.precio);
            const subtotal=cantidad*precio;
            total+=subtotal;
            cantidadProductos += cantidad;

            contenido+=`
                <div class="summary-item">
                    <span>${nombre} x${cantidad}</span>
                    <span>€${subtotal.toFixed(2)}</span>
                </div>
            `;
        }
    });

    if(contenido===''){
        contenido='<p style="opacity:0.6;">No hay productos seleccionados.</p>';
        btnPagar.disabled = true;
    } else {
        btnPagar.disabled = false;
    }

    resumenDiv.innerHTML=contenido;
    totalSpan.innerText=total.toFixed(2);
}

// Toggle menú responsive
function toggleMenu() {
    const navContainer = document.getElementById('navContainer');
    const menuToggle   = document.querySelector('.menu-toggle');
    navContainer.classList.toggle('active');
    menuToggle.classList.toggle('active');
}

// Cerrar menú al hacer clic en enlaces o fuera
document.querySelectorAll('.nav-container a, .nav-container button').forEach(el=>{
    el.addEventListener('click', ()=> {
        document.getElementById('navContainer').classList.remove('active');
        document.querySelector('.menu-toggle').classList.remove('active');
    });
});
document.addEventListener('click', (e)=>{
    const navContainer = document.getElementById('navContainer');
    const menuToggle   = document.querySelector('.menu-toggle');
    if(!navContainer.contains(e.target) && !menuToggle.contains(e.target)){
        navContainer.classList.remove('active');
        menuToggle.classList.remove('active');
    }
});

// Inicializar
actualizarResumen();
</script>

</body>
</html>