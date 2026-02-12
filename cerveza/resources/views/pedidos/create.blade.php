<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Realizar Pedido - Cervecería Tío Mingo</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
:root{
    --primary-gold:#D4A574;
    --deep-amber:#B8860B;
    --dark-brown:#2C1810;
    --warm-cream:#F5E6D3;
    --forest-green:#1B4332;
}

*{margin:0;padding:0;box-sizing:border-box;}

body{
    font-family:'Montserrat',sans-serif;
    background:var(--dark-brown);
    color:var(--warm-cream);
}

.container{padding:2rem 5%;}

/* TITULOS */
.page-title{
    font-family:'Bebas Neue',sans-serif;
    font-size:3.5rem;
    color:var(--primary-gold);
    text-align:center;
    margin-bottom:3rem;
    letter-spacing:3px;
}

/* GRID PRINCIPAL */
.grid-layout{
    display:grid;
    grid-template-columns:3fr 1fr;
    gap:3rem;
}

/* CARD CERVEZA */
.beer-card{
    background:rgba(245,230,211,0.05);
    border:2px solid var(--primary-gold);
    padding:1.5rem;
    text-align:center;
    transition:0.3s;
}

.beer-card:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 30px rgba(212,165,116,0.2);
}

.beer-card img{
    width:80px;
    height:80px;
    object-fit:cover;
    border-radius:8px;
    margin-bottom:1rem;
}

.beer-card h4{
    font-family:'Bebas Neue',sans-serif;
    font-size:1.3rem;
    color:var(--primary-gold);
    margin-bottom:0.5rem;
}

.beer-price{
    font-size:0.9rem;
    margin-bottom:0.5rem;
}

.beer-card input{
    width:60px;
    padding:0.4rem;
    background:transparent;
    border:1px solid var(--primary-gold);
    color:var(--warm-cream);
    text-align:center;
}

/* GRID CERVEZAS */
.beers-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(180px,1fr));
    gap:2rem;
}

/* RESUMEN */
.summary{
    border:2px solid var(--primary-gold);
    padding:2rem;
    background:rgba(245,230,211,0.05);
    position:sticky;
    top:20px;
    height:fit-content;
}

.summary h3{
    font-family:'Bebas Neue',sans-serif;
    color:var(--primary-gold);
    margin-bottom:1.5rem;
    letter-spacing:2px;
}

.summary-item{
    display:flex;
    justify-content:space-between;
    margin-bottom:0.5rem;
    font-size:0.9rem;
}

.total{
    display:flex;
    justify-content:space-between;
    font-size:1.2rem;
    font-weight:bold;
    margin-top:1rem;
}

.cta-button{
    display:block;
    margin-top:2rem;
    padding:1rem;
    background:linear-gradient(135deg,var(--primary-gold),var(--deep-amber));
    color:var(--dark-brown);
    text-align:center;
    font-weight:700;
    border:none;
    cursor:pointer;
    text-transform:uppercase;
}

.error-box{
    background:rgba(255,0,0,0.1);
    border:1px solid #ff6b6b;
    padding:1rem;
    margin-bottom:2rem;
    color:#ff6b6b;
}
</style>
</head>

<body>

<div class="container">

<h1 class="page-title">Realizar Pedido</h1>

@if ($errors->any())
<div class="error-box">
    <ul>
        @foreach ($errors->all() as $error)
            <li>• {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('pedidos.store') }}">
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

        <button type="submit" class="cta-button">
            Pagar
        </button>

        <p style="font-size:0.75rem;opacity:0.6;margin-top:0.5rem;text-align:center;">
            *La pasarela de pago se implementará próximamente.
        </p>
    </div>

</div>
</form>
</div>

<script>
const inputs = document.querySelectorAll('.cantidad');
const resumenDiv = document.getElementById('resumen');
const totalSpan = document.getElementById('total');
const form = document.querySelector('form');

inputs.forEach(input=>{
    input.addEventListener('input',actualizarResumen);
});

// 🔥 SOLUCIÓN: antes de enviar, desactivar inputs con 0
form.addEventListener('submit', function () {
    inputs.forEach(input => {
        const cantidad = parseInt(input.value) || 0;
        if (cantidad <= 0) {
            input.disabled = true;
        }
    });
});

function actualizarResumen(){
    let total=0;
    let contenido='';

    inputs.forEach(input=>{
        const cantidad=parseInt(input.value)||0;
        if(cantidad>0){
            const nombre=input.dataset.nombre;
            const precio=parseFloat(input.dataset.precio);
            const subtotal=cantidad*precio;
            total+=subtotal;

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
    }

    resumenDiv.innerHTML=contenido;
    totalSpan.innerText=total.toFixed(2);
}
</script>


</body>
</html>
