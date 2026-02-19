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

   /*ALERTAS*/
.alert{
    margin:2rem 5%;
    padding:1rem 1.5rem;
    border-radius:8px;
    border:2px solid;
    animation:slideDown 0.3s ease;
}

@keyframes slideDown{
    from{opacity:0;transform:translateY(-20px);}
    to{opacity:1;transform:translateY(0);}
}

.alert-success{
    background:rgba(81,207,102,0.1);
    border-color:#51cf66;
    color:#51cf66;
}

.alert-error{
    background:rgba(255,107,107,0.1);
    border-color:#ff6b6b;
    color:#ff6b6b;
}

.alert-warning{
    background:rgba(255,169,77,0.1);
    border-color:#ffa94d;
    color:#ffa94d;
}

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
    transition:0.3s;
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
    text-decoration:none;
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

/*  HERO */
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

/* PEDIDOS GRID */
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
    margin-bottom:3rem;
}

.feature-card{
    background:rgba(245,230,211,0.05);
    padding:2rem;
    border:2px solid var(--primary-gold);
    position:relative;
    transition:0.3s;
    cursor:pointer;
}

.feature-card:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 30px rgba(212,165,116,0.2);
    border-color:var(--deep-amber);
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
    border-radius:4px;
}

.card-badge.completado{background:#51cf66;}
.card-badge.pendiente{background:#ffa94d;}
.card-badge.cancelado{background:#ff6b6b;}

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

.card-actions{
    margin-top:1.5rem;
    display:flex;
    gap:1rem;
}

.btn-ver,
.btn-cancelar{
    padding:0.7rem 1.2rem;
    border:2px solid;
    background:transparent;
    cursor:pointer;
    text-transform:uppercase;
    font-weight:600;
    font-size:0.8rem;
    transition:0.3s;
}

.btn-ver{
    border-color:var(--primary-gold);
    color:var(--primary-gold);
    flex:1;
}

.btn-ver:hover{
    background:var(--primary-gold);
    color:var(--dark-brown);
}

.btn-cancelar{
    border-color:#ff6b6b;
    color:#ff6b6b;
}

.btn-cancelar:hover{
    background:#ff6b6b;
    color:white;
}

.cta-button{
    display:inline-block;
    margin:2rem auto 0;
    padding:1rem 2.5rem;
    background:linear-gradient(135deg,var(--primary-gold),var(--deep-amber));
    color:var(--dark-brown);
    text-decoration:none;
    font-weight:700;
    text-transform:uppercase;
    transition:0.3s;
    border:none;
    cursor:pointer;
}

.cta-button:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(212,165,116,0.4);
}

.text-center{text-align:center;}

/* MODAL */
.modal-overlay{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.8);
    z-index:1000;
    align-items:center;
    justify-content:center;
    animation:fadeIn 0.3s ease;
}

.modal-overlay.active{display:flex;}

@keyframes fadeIn{
    from{opacity:0;}
    to{opacity:1;}
}

.modal{
    background:var(--dark-brown);
    border:3px solid var(--primary-gold);
    border-radius:10px;
    padding:2rem;
    max-width:600px;
    width:90%;
    max-height:80vh;
    overflow-y:auto;
    position:relative;
    animation:scaleIn 0.3s ease;
}

@keyframes scaleIn{
    from{transform:scale(0.8);opacity:0;}
    to{transform:scale(1);opacity:1;}
}

.modal-close{
    position:absolute;
    top:1rem;
    right:1rem;
    background:transparent;
    border:none;
    color:var(--primary-gold);
    font-size:2rem;
    cursor:pointer;
    width:40px;
    height:40px;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:0.3s;
}

.modal-close:hover{
    color:#ff6b6b;
    transform:rotate(90deg);
}

.modal h2{
    font-family:'Bebas Neue',sans-serif;
    font-size:2.5rem;
    color:var(--primary-gold);
    margin-bottom:1.5rem;
    letter-spacing:2px;
}

.modal-section{
    margin-bottom:2rem;
}

.modal-section h3{
    font-family:'Bebas Neue',sans-serif;
    color:var(--primary-gold);
    font-size:1.5rem;
    margin-bottom:1rem;
    border-bottom:2px solid var(--primary-gold);
    padding-bottom:0.5rem;
}

.detail-row{
    display:flex;
    justify-content:space-between;
    padding:0.7rem 0;
    border-bottom:1px solid rgba(212,165,116,0.2);
}

.detail-row:last-child{border-bottom:none;}

.detail-label{
    font-weight:600;
    color:var(--primary-gold);
}

.detail-value{
    color:var(--warm-cream);
}

.cerveza-item{
    background:rgba(245,230,211,0.05);
    padding:1rem;
    margin-bottom:0.5rem;
    border-left:3px solid var(--primary-gold);
}

.cerveza-item h4{
    color:var(--primary-gold);
    margin-bottom:0.3rem;
    font-size:1.1rem;
}

.total-section{
    background:rgba(212,165,116,0.1);
    padding:1rem;
    border:2px solid var(--primary-gold);
    margin-top:1.5rem;
}

.total-row{
    display:flex;
    justify-content:space-between;
    font-size:1.5rem;
    font-weight:700;
    color:var(--primary-gold);
}

/* MODAL DE CONFIRMACIÓN */
.confirm-modal{
    max-width:400px;
    text-align:center;
}

.confirm-modal h2{
    font-size:2rem;
    margin-bottom:1rem;
}

.confirm-modal p{
    font-size:1.1rem;
    margin-bottom:2rem;
    line-height:1.6;
}

.confirm-actions{
    display:flex;
    gap:1rem;
}

.btn-confirm-yes,
.btn-confirm-no{
    flex:1;
    padding:1rem;
    border:2px solid;
    background:transparent;
    cursor:pointer;
    text-transform:uppercase;
    font-weight:700;
    font-size:0.9rem;
    transition:0.3s;
}

.btn-confirm-yes{
    border-color:#ff6b6b;
    color:#ff6b6b;
}

.btn-confirm-yes:hover{
    background:#ff6b6b;
    color:white;
}

.btn-confirm-no{
    border-color:var(--primary-gold);
    color:var(--primary-gold);
}

.btn-confirm-no:hover{
    background:var(--primary-gold);
    color:var(--dark-brown);
}

/* FOOTER */
footer{
    padding:2rem 5%;
    border-top:1px solid rgba(212,165,116,0.3);
    text-align:center;
    font-size:0.8rem;
    color:rgba(245,230,211,0.5);
}

/* SCROLLBAR PERSONALIZADA */
.modal::-webkit-scrollbar{width:10px;}
.modal::-webkit-scrollbar-track{background:rgba(0,0,0,0.3);}
.modal::-webkit-scrollbar-thumb{background:var(--primary-gold);border-radius:5px;}
.modal::-webkit-scrollbar-thumb:hover{background:var(--deep-amber);}
</style>
</head>

<body>
<div class="container">

{{-- HEADER --}}
<header>
    <a href="{{ url('/') }}" class="logo">CERVECERÍA TÍO MINGO</a>

    <div class="nav-container">
        <nav>
            @if (auth()->check() && auth()->user()->role === 'ADMIN')
                    <a href="{{ route('admin.cervezas') }}">
                            Cervezas
                        </a>
                    @else
                    <a href="{{ route('cervezas') }}">Cervezas</a>
            @endif
            <a href="{{ route('nosotros.index') }}">Nosotros</a>
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

{{-- ALERTAS --}}
@if(session('success'))
    <div class="alert alert-success">
        ✅ {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error">
        ❌ {{ session('error') }}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">
        ⚠️ {{ session('warning') }}
    </div>
@endif

{{-- HERO --}}
<section class="hero">
    <h1>
        MIS PEDIDOS
        <span>Historial y Seguimiento</span>
    </h1>
</section>

{{-- LISTADO DE PEDIDOS --}}
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
                    <span class="card-badge {{ $pedido->estado }}">
                        {{ ucfirst($pedido->estado) }}
                    </span>

                    <h3>Pedido #{{ $pedido->id }}</h3>

                    <p>
                        <strong>Fecha:</strong> {{ $pedido->fecha->format('d/m/Y H:i') }}<br>
                        <strong>Total:</strong> €{{ number_format($pedido->total, 2) }}
                    </p>

                    <div class="card-actions">
                        <button class="btn-ver" onclick="verDetalle({{ $pedido->id }})">
                            👁️ Ver Detalle
                        </button>
                        
                        @if($pedido->estado !== 'cancelado')
                            <button class="btn-cancelar" onclick="confirmarCancelacion({{ $pedido->id }})">
                                ❌ Cancelar
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif

    </div>

    <div class="text-center">
        <a href="{{ route('pedidos.create') }}" class="cta-button">
            🍺 Nuevo Pedido
        </a>
    </div>
</section>

{{-- MODAL DETALLE DEL PEDIDO --}}
<div class="modal-overlay" id="modalDetalle">
    <div class="modal">
        <button class="modal-close" onclick="cerrarModal('modalDetalle')">&times;</button>
        
        <h2>Detalle del Pedido</h2>
        
        <div id="modalContent">
            <!-- Aquí se cargará el contenido dinámicamente -->
        </div>
    </div>
</div>

{{-- MODAL CONFIRMACIÓN CANCELACIÓN --}}
<div class="modal-overlay" id="modalConfirmar">
    <div class="modal confirm-modal">
        <button class="modal-close" onclick="cerrarModal('modalConfirmar')">&times;</button>
        
        <h2>⚠️ Confirmar Cancelación</h2>
        <p>¿Estás seguro de que deseas cancelar este pedido? Esta acción no se puede deshacer.</p>
        
        <form id="formCancelar" method="POST" action="">
            @csrf
            @method('DELETE')
            
            <div class="confirm-actions">
                <button type="submit" class="btn-confirm-yes">Sí, cancelar</button>
                <button type="button" class="btn-confirm-no" onclick="cerrarModal('modalConfirmar')">No, volver</button>
            </div>
        </form>
    </div>
</div>

{{-- FOOTER --}}
<footer>
    © {{ date('Y') }} — Cervecería Tío Mingo 🍺
</footer>

</div>

<script>


// FUNCIONES DEL MODAL

function verDetalle(pedidoId) {
    // Hacer petición AJAX para obtener el detalle
    fetch(`/pedidos/${pedidoId}/detalle`)
        .then(response => response.json())
        .then(data => {
            mostrarDetalle(data);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al cargar el detalle del pedido');
        });
}

function mostrarDetalle(pedido) {
    const content = `
        <div class="modal-section">
            <h3>Información General</h3>
            <div class="detail-row">
                <span class="detail-label">Número de Pedido:</span>
                <span class="detail-value">#${pedido.id}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Fecha:</span>
                <span class="detail-value">${pedido.fecha}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Estado:</span>
                <span class="detail-value">${pedido.estado}</span>
            </div>
            ${pedido.paypal_order_id ? `
                <div class="detail-row">
                    <span class="detail-label">ID PayPal:</span>
                    <span class="detail-value">${pedido.paypal_order_id.substring(0, 20)}...</span>
                </div>
            ` : ''}
        </div>

        <div class="modal-section">
            <h3>Productos</h3>
            ${pedido.detalles.map(detalle => `
                <div class="cerveza-item">
                    <h4>${detalle.cerveza_nombre}</h4>
                    <div class="detail-row">
                        <span class="detail-label">Cantidad:</span>
                        <span class="detail-value">${detalle.cantidad} unidades</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Precio unitario:</span>
                        <span class="detail-value">€${parseFloat(detalle.precio_unitario).toFixed(2)}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Subtotal:</span>
                        <span class="detail-value">€${parseFloat(detalle.subtotal).toFixed(2)}</span>
                    </div>
                </div>
            `).join('')}
        </div>

        <div class="total-section">
            <div class="total-row">
                <span>TOTAL:</span>
                <span>€${parseFloat(pedido.total).toFixed(2)}</span>
            </div>
        </div>
    `;

    document.getElementById('modalContent').innerHTML = content;
    document.getElementById('modalDetalle').classList.add('active');
}

function confirmarCancelacion(pedidoId) {
    const form = document.getElementById('formCancelar');
    form.action = `/pedidos/${pedidoId}`;
    document.getElementById('modalConfirmar').classList.add('active');
}

function cerrarModal(modalId) {
    document.getElementById(modalId).classList.remove('active');
}

// Cerrar modal al hacer clic fuera
document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('active');
        }
    });
});

// Cerrar modal con tecla ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.classList.remove('active');
        });
    }
});
</script>

</body>
</html>