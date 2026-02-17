<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cervecería Tío Mingo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold:   #D4A574;
            --amber:  #B8860B;
            --brown:  #2C1810;
            --cream:  #F5E6D3;
            --copper: #B87333;
            --dark:   #180D08;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body {
            width: 100%; height: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--dark);
            color: var(--cream);
        }

        .bg {
            position: fixed; inset: 0; z-index: 0;
            background:
                radial-gradient(ellipse 80% 60% at 15% 50%,  rgba(184,134,11,.18) 0%, transparent 65%),
                radial-gradient(ellipse 60% 80% at 85% 20%,  rgba(212,165,116,.12) 0%, transparent 60%),
                radial-gradient(ellipse 50% 50% at 60% 90%,  rgba(184,100,11,.10) 0%, transparent 60%),
                var(--dark);
        }

        .bg::after {
            content: '';
            position: absolute; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
            opacity: .045;
            pointer-events: none;
        }

        .bg::before {
            content: '';
            position: absolute; inset: 0;
            background-image: repeating-linear-gradient(
                90deg,
                transparent, transparent 120px,
                rgba(212,165,116,.04) 120px, rgba(212,165,116,.04) 121px
            );
            pointer-events: none;
        }

        .page {
            position: relative; z-index: 1;
            width: 100vw; height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .left {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 5% 6% 5% 8%;
            position: relative;
            border-right: 1px solid rgba(212,165,116,.15);
        }

        .left::before {
            content: '';
            position: absolute;
            left: 0; top: 15%; bottom: 15%;
            width: 3px;
            background: linear-gradient(to bottom, transparent, var(--gold), transparent);
        }

        .eyebrow {
            font-size: .72rem;
            letter-spacing: .35em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 2rem;
            opacity: 0;
            animation: fadeUp .7s ease-out .2s forwards;
        }

        .brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(4rem, 7vw, 7.5rem);
            line-height: .88;
            letter-spacing: .02em;
            color: var(--cream);
            margin-bottom: 1.8rem;
            opacity: 0;
            animation: fadeUp .7s ease-out .35s forwards;
        }

        .brand em {
            display: block;
            color: var(--gold);
            font-style: normal;
            text-shadow: 0 0 60px rgba(212,165,116,.35);
        }

        .tagline {
            font-size: clamp(.85rem, 1.1vw, 1rem);
            font-weight: 300;
            font-style: italic;
            line-height: 1.75;
            color: rgba(245,230,211,.65);
            max-width: 380px;
            margin-bottom: 3rem;
            opacity: 0;
            animation: fadeUp .7s ease-out .5s forwards;
        }

        .badges {
            display: flex; gap: 1.2rem; flex-wrap: wrap;
            opacity: 0;
            animation: fadeUp .7s ease-out .65s forwards;
        }

        .badge {
            display: flex; align-items: center; gap: .5rem;
            font-size: .72rem; letter-spacing: .12em;
            text-transform: uppercase;
            color: rgba(245,230,211,.5);
        }

        .badge::before {
            content: '';
            width: 22px; height: 1px;
            background: var(--gold);
            opacity: .6;
        }

        .right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 5%;
            position: relative;
            overflow: hidden;
        }

        .glass-bg {
            position: absolute;
            bottom: -5%; right: -8%;
            width: 55%;
            aspect-ratio: 1;
            border-radius: 0 0 50% 50% / 0 0 30% 30%;
            background: linear-gradient(180deg,
                rgba(255,193,7,.05)  0%,
                rgba(255,111,0,.12) 50%,
                rgba(200,70,0,.18) 100%);
            box-shadow: inset 0 -40px 80px rgba(255,193,7,.08);
            animation: fillGlass 2.5s ease-out .5s both;
            pointer-events: none;
        }

        .foam-bg {
            position: absolute;
            bottom: 20%; right: -8%;
            width: 55%;
            height: 60px;
            background: radial-gradient(ellipse at center,
                rgba(255,255,255,.08) 0%,
                rgba(255,248,220,.04) 60%,
                transparent 100%);
            filter: blur(8px);
            animation: foamDrift 4s ease-in-out 3s infinite;
            pointer-events: none;
        }

        @keyframes foamDrift {
            0%, 100% { transform: translateY(0) scaleX(1); }
            50%       { transform: translateY(-8px) scaleX(1.03); }
        }

        @keyframes fillGlass {
            from { clip-path: inset(100% 0 0 0); }
            to   { clip-path: inset(0 0 0 0); }
        }

        .card {
            width: 100%;
            max-width: 400px;
            position: relative; z-index: 2;
            opacity: 0;
            animation: fadeUp .7s ease-out .8s forwards;
        }

        .card-label {
            font-size: .68rem;
            letter-spacing: .3em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .btn-main {
            display: block;
            width: 100%;
            padding: 1.15rem 2rem;
            text-align: center;
            text-decoration: none;
            font-weight: 700;
            font-size: .9rem;
            letter-spacing: .18em;
            text-transform: uppercase;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform .3s ease, box-shadow .3s ease;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--gold) 0%, var(--amber) 100%);
            color: var(--dark);
            border: none;
        }

        .btn-primary::before {
            content: '';
            position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%;
            background: rgba(255,255,255,.25);
            transition: left .5s ease;
        }

        .btn-primary:hover::before { left: 100%; }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(212,165,116,.45);
        }

        .btn-outline {
            background: transparent;
            color: var(--gold);
            border: 1.5px solid var(--gold);
        }

        .btn-outline:hover {
            background: rgba(212,165,116,.1);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(212,165,116,.15);
        }

        .divider {
            display: flex; align-items: center; gap: 1rem;
            margin: 1.5rem 0;
            color: rgba(245,230,211,.25);
            font-size: .72rem;
            letter-spacing: .15em;
            text-transform: uppercase;
        }

        .divider::before,
        .divider::after {
            content: ''; flex: 1;
            height: 1px;
            background: rgba(212,165,116,.2);
        }

        .card-note {
            text-align: center;
            font-size: .72rem;
            color: rgba(245,230,211,.3);
            margin-top: 2rem;
            letter-spacing: .05em;
        }

        .year-stamp {
            position: fixed;
            bottom: 1.5rem; left: 50%;
            transform: translateX(-50%);
            font-family: 'Bebas Neue', sans-serif;
            font-size: .9rem;
            letter-spacing: .4em;
            color: rgba(212,165,116,.18);
            white-space: nowrap;
            z-index: 10;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(22px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .sec-comentarios {
            margin-top: 3.5rem;
            padding-top: 2.5rem;
            border-top: 1px solid rgba(212,165,116,.15);
        }

        .sec-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .sec-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.4rem;
            letter-spacing: .15em;
            color: var(--gold);
        }

        .btn-add {
            padding: .6rem 1rem;
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold);
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .15em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all .25s;
        }

        .btn-add:hover {
            background: var(--gold);
            color: var(--dark);
        }

        .carr-wrap { overflow: hidden; }
        .carr-track {
            display: flex;
            transition: transform .5s cubic-bezier(.4,0,.2,1);
        }

        .carr-item {
            min-width: 100%;
            padding: 0 .25rem;
        }

        .carr-box {
            background: rgba(212,165,116,.03);
            border: 1px solid rgba(212,165,116,.15);
            padding: 1.5rem 1.8rem;
            position: relative;
        }

        .carr-box::before {
            content: '"';
            position: absolute;
            top: .5rem; left: .8rem;
            font-family: Georgia, serif;
            font-size: 3.5rem;
            color: var(--gold);
            opacity: .08;
            line-height: 1;
        }

        .carr-text {
            font-size: .85rem;
            line-height: 1.7;
            font-weight: 300;
            font-style: italic;
            color: rgba(245,230,211,.75);
            margin-bottom: 1.2rem;
        }

        .carr-foot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .carr-name {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--gold);
        }

        .carr-stars {
            display: flex;
            align-items: center;
            gap: 1px;
        }

        .carr-st {
            font-size: .75rem;
            color: rgba(212,165,116,.2);
        }

        .carr-st.on { color: var(--gold); }

        .carr-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: .95rem;
            color: var(--gold);
            margin-left: 4px;
        }

        .carr-ctrls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .carr-btn {
            width: 32px; height: 32px;
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold);
            font-size: .9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s;
        }

        .carr-btn:hover {
            background: var(--gold);
            color: var(--dark);
        }

        .carr-dots { display: flex; gap: 6px; }
        .carr-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: rgba(212,165,116,.2);
            border: none;
            cursor: pointer;
            padding: 0;
            transition: all .25s;
        }

        .carr-dot.active {
            background: var(--gold);
            transform: scale(1.3);
        }

        .no-com {
            text-align: center;
            padding: 2rem;
            border: 1px dashed rgba(212,165,116,.15);
            color: rgba(245,230,211,.3);
            font-size: .8rem;
        }

        .modal-bg {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.75);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            backdrop-filter: blur(4px);
        }

        .modal-bg.open { display: flex; }

        .modal {
            background: var(--dark);
            border: 2px solid var(--gold);
            padding: 2rem;
            width: 100%;
            max-width: 450px;
            position: relative;
        }

        .modal-x {
            position: absolute;
            top: .8rem; right: 1rem;
            background: none;
            border: none;
            color: rgba(245,230,211,.4);
            font-size: 1.5rem;
            cursor: pointer;
            line-height: 1;
        }

        .modal-x:hover { color: var(--gold); }

        .modal h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            color: var(--gold);
            letter-spacing: .15em;
            margin-bottom: .3rem;
        }

        .modal-sub {
            font-size: .72rem;
            color: rgba(245,230,211,.4);
            margin-bottom: 1.5rem;
        }

        .fld { margin-bottom: 1.2rem; }

        .fld label {
            display: block;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: .4rem;
        }

        .fld input,
        .fld textarea {
            width: 100%;
            background: rgba(212,165,116,.05);
            border: 1px solid rgba(212,165,116,.2);
            color: var(--cream);
            font-family: 'Montserrat', sans-serif;
            font-size: .85rem;
            padding: .65rem .8rem;
            outline: none;
            transition: border-color .3s;
        }

        .fld input:focus,
        .fld textarea:focus { border-color: var(--gold); }

        .fld textarea {
            min-height: 90px;
            resize: vertical;
        }

        .stars-sel { display: flex; align-items: center; gap: 2px; }

        .st-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: rgba(212,165,116,.2);
            cursor: pointer;
            padding: 0;
            line-height: 1;
            transition: all .15s;
        }

        .st-btn:hover,
        .st-btn.sel { color: var(--gold); }

        .st-btn.sel { transform: scale(1.1); }

        .st-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.3rem;
            color: var(--gold);
            margin-left: 6px;
            min-width: 2ch;
        }

        #puntuacion { display: none; }

        .err {
            font-size: .7rem;
            color: #d88;
            margin-top: .3rem;
        }

        .btn-send {
            width: 100%;
            margin-top: .5rem;
            padding: .9rem;
            background: linear-gradient(135deg, var(--gold), var(--amber));
            color: var(--dark);
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: .8rem;
            letter-spacing: .15em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: transform .3s, box-shadow .3s;
        }

        .btn-send:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(212,165,116,.35);
        }

        .flash {
            margin-bottom: 1.5rem;
            padding: .8rem 1rem;
            background: rgba(27,67,50,.4);
            border: 1px solid rgba(45,106,79,.7);
            color: #95d5b2;
            font-size: .75rem;
            display: flex;
            align-items: center;
            gap: .6rem;
        }

        .flash span { font-size: 1.1rem; }

        @media (max-width: 768px) {
            html, body { overflow: auto; }

            .page {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto;
                min-height: 100vh; height: auto;
            }

            .left {
                padding: 4rem 8% 3rem;
                border-right: none;
                border-bottom: 1px solid rgba(212,165,116,.15);
                text-align: center;
            }

            .left::before { display: none; }
            .tagline { max-width: 100%; }
            .badges { justify-content: center; }

            .right { padding: 3rem 8% 5rem; }
            .glass-bg, .foam-bg { display: none; }

            .sec-head { flex-direction: column; text-align: center; }
            .carr-box { padding: 1.2rem 1.4rem; }
            .modal { padding: 1.5rem; }
        }
    </style>
</head>
<body>

    <div class="bg"></div>

    <div class="page">

        <div class="left">
            <p class="eyebrow">Desde 1987 · Artesanal · Premium</p>

            <h1 class="brand">
                CERVECERÍA
                <em>TÍO MINGO</em>
            </h1>

            <p class="tagline">
                Cada sorbo es el resultado de décadas de oficio,
                ingredientes naturales y la pasión que solo encuentra
                un maestro cervecero de verdad.
            </p>

            <div class="badges">
                <div class="badge">100% Natural</div>
                <div class="badge">Receta Artesanal</div>
                <div class="badge">Sabor Premium</div>
            </div>
        </div>

        <div class="right">
            <div class="glass-bg"></div>
            <div class="foam-bg"></div>

            <div class="card">
                <p class="card-label">Accede al catálogo completo</p>

                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-main btn-primary">
                        Ir al Dashboard
                    </a>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn-main btn-primary">
                            Iniciar Sesión
                        </a>
                    @endif

                    <div class="divider">o</div>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-main btn-outline">
                            Crear Cuenta
                        </a>
                    @endif

                    <p class="card-note">
                        Regístrate gratis y accede al catálogo completo 🍺
                    </p>
                @endauth

                <section class="sec-comentarios">
                    @if (session('mensaje'))
                        <div class="flash">
                            <span>🍺</span>
                            <p>{{ session('mensaje') }}</p>
                        </div>
                    @endif

                    <div class="sec-head">
                        <h2 class="sec-title">Lo Que Opinan</h2>
                        <button class="btn-add" onclick="openModal()">+ Añadir</button>
                    </div>

                    @if ($comentarios->isEmpty())
                        <div class="no-com">
                            Aún no hay comentarios. ¡Sé el primero!
                        </div>
                    @else
                        <div class="carr-wrap">
                            <div class="carr-track" id="track">
                                @foreach ($comentarios as $c)
                                    <div class="carr-item">
                                        <div class="carr-box">
                                            <p class="carr-text">{{ $c->texto }}</p>
                                            <div class="carr-foot">
                                                <span class="carr-name">{{ $c->nombre }}</span>
                                                <div class="carr-stars">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        <span class="carr-st {{ $i <= $c->puntuacion ? 'on' : '' }}">★</span>
                                                    @endfor
                                                    <span class="carr-num">{{ $c->puntuacion }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="carr-ctrls">
                            <button class="carr-btn" id="prev">◀</button>
                            <div class="carr-dots" id="dots"></div>
                            <button class="carr-btn" id="next">▶</button>
                        </div>
                    @endif
                </section>
            </div>
        </div>

    </div>

    <span class="year-stamp">CERVECERÍA TÍO MINGO · {{ date('Y') }}</span>

    <div class="modal-bg" id="modalBg">
        <div class="modal">
            <button class="modal-x" onclick="closeModal()">&times;</button>

            <h3>Tu Opinión</h3>
            <p class="modal-sub">Sin necesidad de cuenta</p>

            <form action="{{ route('comentarios.store') }}" method="POST">
                @csrf

                <div class="fld">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre"
                           placeholder="Tu nombre"
                           maxlength="100"
                           value="{{ old('nombre') }}">
                    @error('nombre') <p class="err">{{ $message }}</p> @enderror
                </div>

                <div class="fld">
                    <label>Puntuación (1–10)</label>
                    <div class="stars-sel" id="starsSel">
                        @for ($i = 1; $i <= 10; $i++)
                            <button type="button"
                                    class="st-btn {{ old('puntuacion') >= $i ? 'sel' : '' }}"
                                    data-v="{{ $i }}">★</button>
                        @endfor
                        <span class="st-val" id="stVal">{{ old('puntuacion') ?: '—' }}</span>
                    </div>
                    <input type="hidden" id="puntuacion" name="puntuacion" value="{{ old('puntuacion') }}">
                    @error('puntuacion') <p class="err">{{ $message }}</p> @enderror
                </div>

                <div class="fld">
                    <label for="texto">Comentario</label>
                    <textarea id="texto" name="texto"
                              placeholder="Tu experiencia..."
                              maxlength="1000">{{ old('texto') }}</textarea>
                    @error('texto') <p class="err">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn-send">Publicar</button>
            </form>
        </div>
    </div>

<script>
const modalBg = document.getElementById('modalBg');

function openModal()  { modalBg.classList.add('open'); document.body.style.overflow = 'hidden'; }
function closeModal() { modalBg.classList.remove('open'); document.body.style.overflow = ''; }

modalBg.addEventListener('click', e => { if (e.target === modalBg) closeModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

@if ($errors->any()) window.addEventListener('DOMContentLoaded', openModal); @endif

const btns   = document.querySelectorAll('.st-btn');
const stVal  = document.getElementById('stVal');
const pInput = document.getElementById('puntuacion');
let   curr   = parseInt(pInput.value) || 0;

function paint(n) { btns.forEach((b, i) => b.classList.toggle('sel', i < n)); }

btns.forEach(b => {
    const v = parseInt(b.dataset.v);
    b.addEventListener('mouseenter', () => paint(v));
    b.addEventListener('mouseleave', () => paint(curr));
    b.addEventListener('click', () => {
        curr = v;
        pInput.value = v;
        stVal.textContent = v;
        paint(v);
    });
});

paint(curr);

(function () {
    const track = document.getElementById('track');
    const dotsW = document.getElementById('dots');
    const prev  = document.getElementById('prev');
    const next  = document.getElementById('next');
    if (!track) return;

    const items = track.querySelectorAll('.carr-item');
    const total = items.length;
    if (total === 0) return;

    let idx = 0;
    let tmr = null;

    for (let i = 0; i < total; i++) {
        const d = document.createElement('button');
        d.className = 'carr-dot' + (i === 0 ? ' active' : '');
        d.addEventListener('click', () => { go(i); reset(); });
        dotsW.appendChild(d);
    }

    function go(n) {
        idx = (n + total) % total;
        track.style.transform = `translateX(-${idx * 100}%)`;
        document.querySelectorAll('.carr-dot').forEach((d, i) =>
            d.classList.toggle('active', i === idx)
        );
    }

    function nxt() { go(idx + 1); }
    function prv() { go(idx - 1); }

    function start() { tmr = setInterval(nxt, 5000); }
    function reset() { clearInterval(tmr); start(); }

    next.addEventListener('click', () => { nxt(); reset(); });
    prev.addEventListener('click', () => { prv(); reset(); });

    track.closest('.carr-wrap').addEventListener('mouseenter', () => clearInterval(tmr));
    track.closest('.carr-wrap').addEventListener('mouseleave', start);

    let touchX = 0;
    track.addEventListener('touchstart', e => { touchX = e.touches[0].clientX; }, { passive: true });
    track.addEventListener('touchend',   e => {
        const diff = touchX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) { diff > 0 ? nxt() : prv(); reset(); }
    }, { passive: true });

    start();
})();
</script>
</body>
</html>