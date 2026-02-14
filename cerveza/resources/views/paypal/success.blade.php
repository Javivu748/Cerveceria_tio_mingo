<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>¡Pago Exitoso! - Cervecería Tío Mingo</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
:root{
    --primary-gold:#D4A574;
    --deep-amber:#B8860B;
    --dark-brown:#2C1810;
    --warm-cream:#F5E6D3;
    --success-green:#51cf66;
}

*{margin:0;padding:0;box-sizing:border-box;}

body{
    font-family:'Montserrat',sans-serif;
    background:var(--dark-brown);
    color:var(--warm-cream);
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:2rem;
}

.success-container{
    background:rgba(245,230,211,0.05);
    border:3px solid var(--primary-gold);
    border-radius:20px;
    padding:3rem;
    max-width:700px;
    width:100%;
    text-align:center;
    box-shadow:0 20px 60px rgba(0,0,0,0.5);
}

.success-icon{
    width:120px;
    height:120px;
    background:var(--success-green);
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 2rem;
    animation:scaleIn 0.5s ease;
}

@keyframes scaleIn{
    from{transform:scale(0);opacity:0;}
    to{transform:scale(1);opacity:1;}
}

.checkmark{
    font-size:4rem;
    color:white;
}

h1{
    font-family:'Bebas Neue',sans-serif;
    font-size:3rem;
    color:var(--primary-gold);
    margin-bottom:1rem;
    letter-spacing:3px;
}

.lead{
    font-size:1.2rem;
    margin-bottom:2rem;
    opacity:0.9;
}

.order-details{
    background:rgba(0,0,0,0.2);
    border:2px solid var(--primary-gold);
    border-radius:10px;
    padding:2rem;
    margin:2rem 0;
    text-align:left;
}

.order-details h3{
    font-family:'Bebas Neue',sans-serif;
    color:var(--primary-gold);
    font-size:1.5rem;
    margin-bottom:1.5rem;
    text-align:center;
}

.detail-row{
    display:flex;
    justify-content:space-between;
    padding:0.8rem 0;
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

.total-row{
    font-size:1.3rem;
    font-weight:700;
    color:var(--primary-gold);
    margin-top:1rem;
    padding-top:1rem;
    border-top:2px solid var(--primary-gold);
}

.btn-home{
    display:inline-block;
    margin-top:2rem;
    padding:1rem 3rem;
    background:linear-gradient(135deg,var(--primary-gold),var(--deep-amber));
    color:var(--dark-brown);
    text-decoration:none;
    font-weight:700;
    text-transform:uppercase;
    border-radius:8px;
    transition:all 0.3s;
    font-size:1.1rem;
}

.btn-home:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(212,165,116,0.4);
}

.info-text{
    margin-top:2rem;
    font-size:0.9rem;
    opacity:0.7;
}
</style>
</head>
<body>

<div class="success-container">
    <div class="success-icon">
        <div class="checkmark">✓</div>
    </div>
    
    <h1>¡Pago Exitoso!</h1>
    <p class="lead">Tu pedido ha sido procesado correctamente 🎉</p>
    
    <div class="order-details">
        <h3>Detalles del Pedido</h3>
        
        <div class="detail-row">
            <span class="detail-label">Número de Pedido:</span>
            <span class="detail-value">#{{ $pedido->id }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">ID de Transacción PayPal:</span>
            <span class="detail-value">{{ substr($pedido->paypal_order_id, 0, 20) }}...</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Estado:</span>
            <span class="detail-value">✅ {{ strtoupper($paypalData['status']) }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Email:</span>
            <span class="detail-value">{{ $pedido->paypal_payer_email }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Fecha:</span>
            <span class="detail-value">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
        </div>
        
        <div class="detail-row total-row">
            <span class="detail-label">Total Pagado:</span>
            <span class="detail-value">€{{ number_format($pedido->total, 2) }}</span>
        </div>
    </div>
    
    <p class="info-text">
        📧 Recibirás un email de confirmación en <strong>{{ $pedido->paypal_payer_email }}</strong>
    </p>
    
    <a href="{{ route('pedidos.index') }}" class="btn-home">
        Ver Mis Pedidos
    </a>
</div>

</body>
</html>