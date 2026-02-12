<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $cerveza->name }} — Cervecería Tío Mingo</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-gold: #D4A574;
            --dark-brown: #2C1810;
            --warm-cream: #F5E6D3
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--dark-brown);
            color: var(--warm-cream);
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2rem 1rem
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 2px solid var(--primary-gold)
        }

        .logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.6rem;
            color: var(--primary-gold);
            letter-spacing: 2px
        }

        .hero {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
            padding: 2rem 0
        }

        .hero .image {
            flex: 0 0 360px;
            background: rgba(255, 255, 255, 0.02);
            padding: 1rem;
            border: 1px solid rgba(212, 165, 116, 0.08)
        }

        .hero img {
            width: 100%;
            height: 100%;
            object-fit: contain
        }

        .meta {
            flex: 1
        }

        .meta h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.6rem;
            color: var(--primary-gold);
            margin-bottom: 0.4rem
        }

        .meta .sub {
            color: rgba(245, 230, 211, 0.6);
            letter-spacing: 1px;
            margin-bottom: 1rem
        }

        .attributes {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1rem
        }

        .attr {
            background: rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0.8rem;
            border-radius: 6px;
            font-weight: 600;
            color: rgba(245, 230, 211, 0.85)
        }

        .price-box {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-top: 1.2rem
        }

        .price {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.4rem;
            color: var(--primary-gold)
        }

        .price-small {
            font-size: 0.85rem;
            color: rgba(245, 230, 211, 0.6);
            display: block
        }

        .controls {
            display: flex;
            gap: 0.8rem;
            align-items: center
        }

        select,
        input[type=number] {
            padding: 0.5rem;
            border-radius: 6px;
            border: 1px solid rgba(212, 165, 116, 0.2);
            background: transparent;
            color: inherit
        }

        .btn {
            padding: 0.6rem 1rem;
            border: 1px solid var(--primary-gold);
            background: transparent;
            color: var(--primary-gold);
            font-weight: 700;
            border-radius: 6px;
            cursor: pointer
        }

        .desc {
            margin-top: 1.4rem;
            color: rgba(245, 230, 211, 0.7);
            line-height: 1.6
        }

        @media (max-width:800px) {
            .hero {
                flex-direction: column
            }

            .hero .image {
                width: 100%;
                height: 320px
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">CERVECERÍA TÍO MINGO</div>
            <nav>
                <a href="{{ route('cervezas') }}"
                    style="color:var(--warm-cream);text-decoration:none;font-weight:600">Volver</a>
            </nav>
        </header>

        <main class="hero">
            <div class="image">
                @if ($cerveza->imagen_url)
                    <img src="{{ $cerveza->imagen_url }}" alt="{{ $cerveza->name }}">
                @else
                    <img src="/build/images/placeholder-beer.png" alt="sin imagen">
                @endif
            </div>

            <div class="meta">
                <h1>{{ $cerveza->name }}</h1>
                <div class="sub">{{ optional($cerveza->cerveceria)->nombre ?? '—' }} ·
                    {{ optional($cerveza->estilo)->nombre ?? '—' }}</div>

                @if ($cerveza->estilo)
                    <div class="estilo-box"
                        style="margin-top:0.6rem;margin-bottom:0.8rem;padding:0.8rem;border-radius:8px;background:rgba(0,0,0,0.06);">
                        <strong style="color:var(--primary-gold);display:block;margin-bottom:0.3rem">Estilo:
                            {{ $cerveza->estilo->nombre }}</strong>
                        <div style="color:rgba(245,230,211,0.7);font-weight:600">Tipo:
                            {{ $cerveza->estilo->tipo_fermentacion ?? 'N/D' }}</div>
                        @if (!empty($cerveza->estilo->descripcion))
                            <div style="color:rgba(245,230,211,0.6);margin-top:0.5rem">
                                {{ $cerveza->estilo->descripcion }}</div>
                        @endif
                    </div>
                @endif

                <div class="attributes">
                    <div class="attr">Formato: {{ $cerveza->formato ?? 'N/D' }}</div>
                    <div class="attr">Capacidad: {{ $cerveza->capacidad ?? 'N/D' }} ml</div>
                </div>

                <div class="price-box">
                    <div>
                        <div class="price" id="priceEUR">€ {{ number_format($cerveza->precio_eur, 2) }}</div>
                        <div class="price-small">Precio base: EUR</div>
                    </div>

                    <div class="controls">
                        <label for="currency" style="font-weight:700;color:rgba(245,230,211,0.7)">Convertir a</label>
                        <select id="currency">
                            @if(!empty($availableCurrencies) && is_array($availableCurrencies))
                                @foreach($availableCurrencies as $cur)
                                    <option value="{{ $cur }}">{{ $cur }}</option>
                                @endforeach
                            @else
                                <option value="USD">USD</option>
                                <option value="GBP">GBP</option>
                                <option value="JPY">JPY</option>
                                <option value="MXN">MXN</option>
                                <option value="CAD">CAD</option>
                                <option value="AUD">AUD</option>
                                <option value="CHF">CHF</option>
                                <option value="CNY">CNY</option>
                            @endif
                        </select>

                        <button class="btn" id="convertBtn">Convertir</button>
                    </div>
                </div>

                <div style="margin-top:0.8rem">
                    <strong style="color:var(--primary-gold)" id="convertedOutput">—</strong>
                </div>

                <p class="desc">{{ $cerveza->descripcion ?? 'Cerveza artesanal con carácter único.' }}</p>
            </div>
        </main>

    </div>

    <script>
        (function() {
            const btn = document.getElementById('convertBtn');
            const sel = document.getElementById('currency');
            const out = document.getElementById('convertedOutput');
            const amount = {{ $cerveza->precio_eur ?? 0 }};

            async function convert(to) {
                try {
                    const res = await fetch('/api/currency/convert', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({
                            amount: amount,
                            from: 'EUR',
                            to: to
                        })
                    });

                    if (!res.ok) {
                        let msg = `HTTP ${res.status} ${res.statusText}`;
                        try {
                            const err = await res.json();
                            msg = err.message || JSON.stringify(err);
                        } catch (e) {
                            // no JSON
                        }
                        out.textContent = 'Error: ' + msg;
                        return;
                    }

                    const data = await res.json();
                    if (data && data.success) {
                        out.textContent = `${data.converted.formatted} (${data.converted.currency})`;
                    } else {
                        out.textContent = data && data.message ? data.message : 'Error en la conversión';
                    }
                } catch (e) {
                    console.error('Fetch error:', e);
                    out.textContent = 'Error de red';
                }
            }

            btn.addEventListener('click', () => convert(sel.value));
        })();
    </script>
</body>

</html>
