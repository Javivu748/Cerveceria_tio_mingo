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

        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Montserrat',sans-serif; background: var(--dark-brown); color: var(--warm-cream); overflow-x:hidden; }
        header { padding:1.5rem 5%; display:flex; justify-content:space-between; align-items:center; border-bottom:2px solid var(--primary-gold); background: rgba(44,24,16,0.95); backdrop-filter: blur(10px); position:sticky; top:0; z-index:100; }
        .logo { font-family:'Bebas Neue',sans-serif; font-size:2rem; letter-spacing:3px; color: var(--primary-gold); text-shadow: 3px 3px 0 var(--deep-amber); position:relative; }
        .logo::after { content:'🍺'; position:absolute; right:-40px; top:-5px; font-size:1.8rem; }
        nav { display:flex; gap:2rem; align-items:center; }
        nav a { color: var(--warm-cream); text-decoration:none; font-weight:600; font-size:0.9rem; letter-spacing:1px; text-transform:uppercase; position:relative; transition: color 0.3s ease; }
        nav a::after { content:''; position:absolute; bottom:-5px; left:0; width:0; height:2px; background:var(--primary-gold); transition: width 0.3s ease; }
        nav a:hover { color: var(--primary-gold); }
        nav a:hover::after { width:100%; }
        .features { padding:6rem 5%; background:linear-gradient(180deg,var(--dark-brown) 0%,#1a0f0a 100%); }
        .features-title { text-align:center; font-family:'Bebas Neue',sans-serif; font-size:3.5rem; color:var(--primary-gold); margin-bottom:4rem; letter-spacing:3px; }
        .features-grid { max-width:1200px; margin:0 auto; display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:3rem; }
        .feature-card { background: rgba(245,230,211,0.05); padding:2.5rem; border:2px solid var(--primary-gold); border-radius:0; position:relative; overflow:hidden; transition: transform 0.4s ease, box-shadow 0.4s ease; }
        .feature-card:hover { transform:translateY(-10px); box-shadow:0 20px 40px rgba(212,165,116,0.2); }
        .feature-card h3 { font-family:'Bebas Neue',sans-serif; font-size:1.8rem; color:var(--primary-gold); margin-bottom:1rem; letter-spacing:2px; }
        .feature-card p { color: rgba(245,230,211,0.8); line-height:1.7; font-weight:300; }
        img { border-radius: 5px; }

        /* Responsive */
        @media(max-width:640px){ .features { padding:4rem 4%; } .features-title { font-size:2.5rem; margin-bottom:2.5rem; } .feature-card { padding:2rem; } .feature-card h3 { font-size:1.5rem; } .feature-card p { font-size:0.95rem; } }
    </style>
</head>
<body>
    <header>
        <div class="logo">CERVECERÍA TÍO MINGO</div>
        <nav>
            <a href="#cervezas">Cervezas</a>
            <a href="#nosotros">Nosotros</a>
            <a href="#tienda">Tienda</a>
        </nav>
    </header>

    <section class="features" id="cervezas">
        <h2 class="features-title">Nuestras Cervezas</h2>
        <div class="features-grid">
            <div class="feature-card">
                <img src="https://images.unsplash.com/photo-1592928304205-6f446cdba409?auto=format&fit=crop&w=400&q=80" alt="Cerveza Rubia">
                <h3>Cerveza Rubia</h3>
                <p>Formato: Lata <br> Capacidad: 330 ml</p>
            </div>
            <div class="feature-card">
                <img src="https://images.unsplash.com/photo-1603076348675-c67f6bcbff5b?auto=format&fit=crop&w=400&q=80" alt="Cerveza Roja">
                <h3>Cerveza Roja</h3>
                <p>Formato: Botellín <br> Capacidad: 355 ml</p>
            </div>
            <div class="feature-card">
                <img src="https://images.unsplash.com/photo-1617196038597-ff39630b5f33?auto=format&fit=crop&w=400&q=80" alt="Cerveza Negra">
                <h3>Cerveza Negra</h3>
                <p>Formato: Lata <br> Capacidad: 330 ml</p>
            </div>
            <div class="feature-card">
                <img src="https://images.unsplash.com/photo-1580910051071-5e7b7a3b1a57?auto=format&fit=crop&w=400&q=80" alt="Cerveza IPA">
                <h3>Cerveza IPA</h3>
                <p>Formato: Botellín <br> Capacidad: 500 ml</p>
            </div>
        </div>
    </section>
</body>
</html>
