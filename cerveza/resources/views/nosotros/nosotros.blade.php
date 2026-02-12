<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros - Cervecería Tío Mingo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gold: #D4A574;
            --deep-amber: #B8860B;
            --dark-brown: #2C1810;
            --warm-cream: #F5E6D3;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--dark-brown);
            color: var(--warm-cream);
            overflow-x: hidden;
        }

        .container { position: relative; z-index: 2; }

        header {
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--primary-gold);
            background: rgba(44, 24, 16, 0.95);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        /* Estilos del Botón Volver */
        .btn-back {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border: 1px solid var(--primary-gold);
            color: var(--primary-gold);
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            margin-right: 20px;
        }

        .btn-back:hover {
            background: var(--primary-gold);
            color: var(--dark-brown);
            box-shadow: 0 0 15px rgba(212, 165, 116, 0.4);
        }

        .logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            color: var(--primary-gold);
            text-decoration: none;
            letter-spacing: 1px;
        }

        /* --- SECCIÓN HERO --- */
        .hero {
            text-align: center; 
            padding: 6rem 10% 3rem 10%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(3rem, 8vw, 5rem);
            color: var(--primary-gold);
            letter-spacing: 2px;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.1rem;
            font-weight: 300;
            line-height: 1.6;
            color: var(--warm-cream);
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-divider {
            width: 60px;
            height: 3px;
            background: var(--primary-gold);
            margin: 1.5rem auto;
        }

        /* --- ESTILOS DEL MAPA --- */
        .map-wrapper { padding: 0 5% 5rem 5%; }
        .map-card {
            background: rgba(245, 230, 211, 0.04);
            border: 1px solid rgba(212, 165, 116, 0.3);
            padding: 1rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        }
        #map {
            width: 100%;
            height: 600px;
            background: #1a0f0a;
        }

        .info-window {
            color: #2C1810;
            padding: 10px;
            font-family: 'Montserrat', sans-serif;
        }

        footer {
            padding: 2.5rem 5%;
            text-align: center;
            border-top: 1px solid rgba(212, 165, 116, 0.2);
            margin-top: 2rem;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <div style="display: flex; align-items: center;">
            <a href="{{ url('/dashboard') }}" class="btn-back">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Volver
            </a>
            <a href="{{ url('/dashboard') }}" class="logo">CERVECERÍA TÍO MINGO</a>
        </div>
        
        <nav>
            <a href="{{ route('nosotros.index') }}" style="color: var(--primary-gold); text-decoration: none; font-weight: 600; border-bottom: 2px solid var(--primary-gold); padding-bottom: 5px;">NOSOTROS</a>
        </nav>
    </header>

    <section class="hero">
        <h1>Nuestra Presencia</h1>
        <div class="hero-divider"></div>
        <p>Explora las ubicaciones de las cervecerías con las que colaboramos a nivel mundial. <br> 
           Unimos fronteras a través de la pasión por la cultura cervecera artesanal.</p>
    </section>

    <div class="map-wrapper">
        <div class="map-card">
            <div id="map"></div>
        </div>
    </div>

    <footer>
        <div class="footer-text" style="opacity: 0.7; font-size: 0.9rem;">
            © {{ date('Y') }} — CERVECERÍA TÍO MINGO — Hecho con pasión 🍺
        </div>
    </footer>
</div>

<script>
    const cervecerias = JSON.parse('@json($cervecerias)');

    let map;
    let markers = [];

    function initMap() {
        if (!cervecerias || cervecerias.length === 0) return;

        const center = {
            lat: parseFloat(cervecerias[0].latitud),
            lng: parseFloat(cervecerias[0].longitud)
        };

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: center,
            styles: [
                { "elementType": "geometry", "stylers": [{"color": "#1a0f0a"}] },
                { "elementType": "labels.text.fill", "stylers": [{"color": "#D4A574"}] },
                { "elementType": "labels.text.stroke", "stylers": [{"color": "#1a0f0a"}] },
                { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{"color": "#4b2e20"}] },
                { "featureType": "road", "elementType": "geometry", "stylers": [{"color": "#2c1810"}] },
                { "featureType": "water", "stylers": [{"color": "#0f0a07"}] }
            ]
        });

        const infoWindow = new google.maps.InfoWindow();

        cervecerias.forEach(lugar => {
            if (lugar.latitud && lugar.longitud) {
                const marker = new google.maps.Marker({
                    position: { 
                        lat: parseFloat(lugar.latitud), 
                        lng: parseFloat(lugar.longitud) 
                    },
                    map: map,
                    title: lugar.nombre,
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        fillColor: '#D4A574',
                        fillOpacity: 1,
                        strokeWeight: 2,
                        strokeColor: '#F5E6D3',
                        scale: 8
                    },
                    animation: google.maps.Animation.DROP
                });

                marker.addListener("click", () => {
                    const content = `
                        <div class="info-window">
                            <h3 style="margin: 0 0 5px 0; color: #2C1810;">${lugar.nombre}</h3>
                            <p style="margin: 0 0 10px 0; font-size: 0.9rem;">${lugar.pais_ciudad || ''}</p>
                            <a href="${lugar.sitio_web}" target="_blank" style="color: #B8860B; text-decoration: none; font-weight: bold;">Visitar sitio web →</a>
                        </div>
                    `;
                    infoWindow.setContent(content);
                    infoWindow.open(map, marker);
                });

                markers.push(marker);
            }
        });

        if (markers.length > 1) {
            const bounds = new google.maps.LatLngBounds();
            markers.forEach(m => bounds.extend(m.getPosition()));
            map.fitBounds(bounds);
        }
    }
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ $googleMapsApiKey }}&callback=initMap">
</script>

</body>
</html>