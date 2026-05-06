@extends('layouts.app')

@section('title', 'NexusPlay - Tu tienda de videojuegos')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;500;600;700&display=swap');

/* ══════════════ SISTEMA DE DISEÑO ══════════════
   Tipografía:
     Display  → Bebas Neue (hero titles, stat numbers)
     UI       → Rajdhani 700 (headings de sección, card names)
     Body     → Rajdhani 500 (descripciones, labels)
     Caption  → Rajdhani 500 (eyebrows, badges, nav)

   Colores de texto (sobre fondo #0a0a0f):
     Primario   → #e8e8f0   (títulos, card names)
     Secundario → #a8a8b8   (descripciones, body)  ← FIX: antes #666
     Muted      → #6b6b80   (labels pequeños)      ← FIX: antes #444/#555
     Accent     → #c9a96e
══════════════════════════════════════════════════ */

:root {
    --accent:      #c9a96e;
    --accent-dim:  rgba(201,169,110,0.12);
    --accent-line: rgba(201,169,110,0.2);
    --dark:        #0a0a0f;
    --dark2:       #0f0f18;
    --dark3:       #16161f;
    --dark4:       #1c1c28;

    /* Textos accesibles */
    --text-primary:   #e8e8f0;
    --text-secondary: #a8a8b8;   /* antes #666 — ahora legible */
    --text-muted:     #6b6b80;   /* antes #444 — ahora legible */
}

/* ══════════════ HERO ══════════════ */
.hero {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: flex-start;
    padding: 0 5rem 7rem;
    position: relative;
    overflow: hidden;
    background: var(--dark);
}

/* ── Hero background: gradiente cinético, sin GIF ──
   Usamos gradientes en capas + pseudo-elementos para
   un fondo visual sin depender de recursos externos. */
.hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 80% 60% at 70% 40%, rgba(201,169,110,0.07) 0%, transparent 60%),
        radial-gradient(ellipse 50% 80% at 20% 80%, rgba(80,60,180,0.06) 0%, transparent 50%),
        radial-gradient(ellipse 60% 40% at 50% 10%, rgba(30,20,80,0.5) 0%, transparent 70%);
    z-index: 0;
}

/* Grid decorativo de fondo */
.hero-grid {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(201,169,110,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(201,169,110,0.04) 1px, transparent 1px);
    background-size: 60px 60px;
    z-index: 1;
    mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
}

/* Vignette lateral */
.hero-overlay {
    position: absolute;
    inset: 0;
    background:
        linear-gradient(to right, rgba(10,10,15,0.98) 0%, rgba(10,10,15,0.6) 45%, rgba(10,10,15,0.15) 100%),
        linear-gradient(to top, rgba(10,10,15,1) 0%, transparent 45%);
    z-index: 2;
}

/* Línea radar */
.hero-radar {
    position: absolute;
    top: 0; left: 0;
    width: 2px; height: 100%;
    background: linear-gradient(to bottom, transparent, rgba(201,169,110,0.5) 50%, transparent);
    z-index: 3;
    animation: radar 8s ease-in-out infinite;
    pointer-events: none;
}

@keyframes radar {
    0%   { left: 0;    opacity: 0; }
    5%   { opacity: 1; }
    95%  { opacity: 1; }
    100% { left: 100%; opacity: 0; }
}

/* Orbe de luz derecha */
.hero-orb {
    position: absolute;
    right: 10%;
    top: 20%;
    width: 400px;
    height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(201,169,110,0.08) 0%, transparent 70%);
    z-index: 2;
    animation: orbPulse 6s ease-in-out infinite;
}

@keyframes orbPulse {
    0%, 100% { transform: scale(1);    opacity: 0.8; }
    50%       { transform: scale(1.15); opacity: 1; }
}

/* ── Contenido Hero ── */
.hero-content { position: relative; z-index: 5; }

.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 0.7rem;
    background: var(--accent-dim);
    border: 1px solid var(--accent-line);
    padding: 0.45rem 1.2rem;
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.72rem;      /* FIX: antes 0.68 — ahora ≥11px */
    font-weight: 500;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--accent);
    margin-bottom: 1.8rem;
    opacity: 0;
    animation: fadeUp 0.8s ease 0.2s forwards;
}

.hero-eyebrow::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--accent);
    animation: blink 1.8s infinite;
}

/* Título hero — 3 líneas, jerarquía clara */
.hero-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: clamp(4.5rem, 11vw, 10rem);
    line-height: 0.9;
    letter-spacing: 2px;
    color: var(--text-primary);
    margin-bottom: 2rem;
    opacity: 0;
    animation: fadeUp 0.8s ease 0.4s forwards;
}

.hero-title .accent  { color: var(--accent); }
.hero-title .outline {
    -webkit-text-stroke: 1.5px rgba(232,232,240,0.25);
    color: transparent;
}

/* Descripción — FIX: color de #666 a #a8a8b8 */
.hero-desc {
    font-family: 'Rajdhani', sans-serif;
    font-size: 1.05rem;
    font-weight: 500;
    color: var(--text-secondary);   /* antes #666 */
    max-width: 460px;
    line-height: 1.85;
    margin-bottom: 2.8rem;
    letter-spacing: 0.4px;
    opacity: 0;
    animation: fadeUp 0.8s ease 0.6s forwards;
}

.hero-btns {
    display: flex;
    gap: 1rem;
    opacity: 0;
    animation: fadeUp 0.8s ease 0.8s forwards;
}

/* ── Stats flotantes ── */
.hero-stats {
    position: absolute;
    right: 5rem;
    bottom: 7rem;
    display: flex;
    flex-direction: column;
    gap: 2px;
    z-index: 5;
    opacity: 0;
    animation: fadeUp 0.8s ease 1s forwards;
}

.hero-stat {
    padding: 1.2rem 2rem;
    background: rgba(10,10,15,0.75);
    border: 1px solid var(--accent-line);
    border-left: 2px solid var(--accent);
    backdrop-filter: blur(12px);
    text-align: right;
    transition: background 0.3s;
}

.hero-stat:hover { background: var(--accent-dim); }

.hero-stat-num {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2.2rem;
    color: var(--accent);
    letter-spacing: 2px;
    line-height: 1;
}

/* FIX: label de stat — de #555 a var(--text-muted) */
.hero-stat-label {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--text-muted);   /* antes #555 */
    margin-top: 2px;
}

/* Scroll indicator */
.hero-scroll {
    position: absolute;
    bottom: 2.5rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    z-index: 5;
    opacity: 0;
    animation: fadeUp 0.8s ease 1.2s forwards;
}

.scroll-mouse {
    width: 22px; height: 34px;
    border: 1px solid var(--accent-line);
    border-radius: 11px;
    display: flex;
    justify-content: center;
    padding-top: 6px;
}

.scroll-wheel {
    width: 2px; height: 6px;
    background: var(--accent);
    border-radius: 1px;
    animation: scrollWheel 2s ease-in-out infinite;
}

@keyframes scrollWheel {
    0%  { transform: translateY(0);  opacity: 1; }
    100%{ transform: translateY(8px);opacity: 0; }
}

/* FIX: scroll text — de #444 a var(--text-muted) */
.scroll-text {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--text-muted);
}

/* ══════════════ TICKER ══════════════ */
.ticker {
    background: var(--accent);
    overflow: hidden;
    white-space: nowrap;
    padding: 0.65rem 0;
}

.ticker-inner {
    display: inline-flex;
    animation: ticker 22s linear infinite;
}

.ticker-item {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    padding: 0 2.5rem;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 0.88rem;
    letter-spacing: 3px;
    color: #0a0a0f;
}

.ticker-sep { opacity: 0.35; }

@keyframes ticker { from { transform: translateX(0); } to { transform: translateX(-50%); } }

/* ══════════════ SECCIONES ══════════════ */
.nx-section { padding: 7rem 5rem; }

/* Label de sección — FIX: tamaño y weight mejorados */
.nx-label {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.75rem;      /* antes 0.68 */
    font-weight: 500;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--accent);
    margin-bottom: 0.6rem;
}

/* Título de sección */
.nx-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: clamp(2.8rem, 6vw, 5rem);
    letter-spacing: 2px;
    color: var(--text-primary);
    line-height: 1;
    margin-bottom: 0.4rem;
}

.nx-divider {
    width: 40px; height: 2px;
    background: var(--accent);
    margin-bottom: 3.5rem;
    margin-top: 0.8rem;
}

/* ══════════════ JUEGOS GRID ══════════════ */
.featured { background: var(--dark2); }

.games-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1px;
    background: rgba(201,169,110,0.08);
}

.game-card {
    background: var(--dark3);
    overflow: hidden;
    position: relative;
    cursor: pointer;
    transition: background 0.35s;
}

.game-card:hover { background: var(--dark4); }
.game-card:hover .card-overlay { opacity: 1; }
.game-card:hover .card-img-emoji { transform: scale(1.12) translateY(-4px); }

.card-img {
    width: 100%; height: 240px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.card-img-bg {
    position: absolute; inset: 0;
    background: linear-gradient(145deg, #13131f 0%, #1e1830 100%);
}
.card-img-bg.b2 { background: linear-gradient(145deg, #0e1525 0%, #1a2040 100%); }
.card-img-bg.b3 { background: linear-gradient(145deg, #131820 0%, #1a2830 100%); }

/* Ruido de textura sutil */
.card-img::after {
    content: '';
    position: absolute; inset: 0;
    background: repeating-linear-gradient(
        45deg, transparent, transparent 24px,
        rgba(201,169,110,0.015) 24px, rgba(201,169,110,0.015) 25px
    );
    z-index: 1;
}

.card-img-emoji {
    font-size: 5rem;
    position: relative;
    z-index: 2;
    transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1);
    filter: drop-shadow(0 0 24px rgba(201,169,110,0.25));
}

.card-overlay {
    position: absolute; inset: 0;
    background: rgba(201,169,110,0.07);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
    z-index: 3;
}

.card-overlay span {
    background: var(--accent);
    color: #0a0a0f;
    padding: 0.65rem 1.8rem;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1rem;
    letter-spacing: 3px;
}

.card-body { padding: 1.6rem 1.5rem; }

/* FIX: genre label — color accesible */
.card-genre {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.72rem;
    font-weight: 500;
    color: var(--accent);
    letter-spacing: 3px;
    text-transform: uppercase;
    margin-bottom: 0.45rem;
}

.card-name {
    font-family: 'Rajdhani', sans-serif;
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.8rem;
    letter-spacing: 0.3px;
}

.card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.card-price {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.5rem;
    color: var(--accent);
    letter-spacing: 1px;
}

/* FIX: precio tachado — de #444 a var(--text-muted) */
.card-old {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.85rem;
    font-weight: 500;
    color: var(--text-muted);   /* antes #444 */
    text-decoration: line-through;
    margin-left: 0.3rem;
}

.card-badge {
    background: var(--accent-dim);
    border: 1px solid var(--accent-line);
    padding: 0.25rem 0.7rem;
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 2px;
    color: var(--accent);
}

/* ══════════════ STATS BAND ══════════════ */
.stats-band {
    background: #08080e;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    border-top: 1px solid rgba(201,169,110,0.07);
    border-bottom: 1px solid rgba(201,169,110,0.07);
}

.stat-item {
    padding: 4.5rem 2rem;
    text-align: center;
    border-right: 1px solid rgba(201,169,110,0.07);
    position: relative;
    overflow: hidden;
    transition: background 0.3s;
}

.stat-item::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(to right, transparent, var(--accent), transparent);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.stat-item:hover::after  { transform: scaleX(1); }
.stat-item:hover         { background: var(--accent-dim); }
.stat-item:last-child    { border-right: none; }

.stat-num {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 3.8rem;
    color: var(--accent);
    line-height: 1;
    margin-bottom: 0.5rem;
    letter-spacing: 2px;
}

/* FIX: stat label — de #444 a var(--text-muted) */
.stat-label {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--text-muted);   /* antes #444 */
}

/* ══════════════ CATEGORÍAS ══════════════ */
.cat-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1px;
    background: rgba(201,169,110,0.08);
}

.cat-item {
    background: var(--dark2);
    padding: 3rem;
    display: flex;
    align-items: center;
    gap: 2rem;
    cursor: pointer;
    transition: background 0.3s;
    position: relative;
    overflow: hidden;
}

.cat-item::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 2px;
    background: var(--accent);
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform 0.35s ease;
}

.cat-item:hover               { background: var(--dark3); }
.cat-item:hover::before       { transform: scaleY(1); }
.cat-item:hover .cat-icon     { border-color: var(--accent-line); background: var(--accent-dim); }

.cat-icon {
    font-size: 2rem;
    width: 68px; height: 68px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(201,169,110,0.12);
    flex-shrink: 0;
    transition: border-color 0.3s, background 0.3s;
    background: rgba(201,169,110,0.02);
}

.cat-info h3 {
    font-family: 'Rajdhani', sans-serif;
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.35rem;
    letter-spacing: 0.3px;
}

/* FIX: cat description — de #555 a var(--text-secondary) */
.cat-info p {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text-secondary);   /* antes #555 */
    letter-spacing: 0.3px;
}

/* ══════════════ CTA FINAL ══════════════ */
.cta-section {
    background: #08080e;
    text-align: center;
    padding: 9rem 5rem;
    position: relative;
    overflow: hidden;
}

.cta-bg {
    position: absolute; inset: 0;
    background:
        radial-gradient(ellipse 70% 60% at 50% 50%, rgba(201,169,110,0.06) 0%, transparent 65%),
        radial-gradient(ellipse 40% 40% at 20% 80%, rgba(80,60,180,0.04) 0%, transparent 60%);
}

.cta-corner {
    position: absolute;
    width: 55px; height: 55px;
    border-color: var(--accent-line);
    border-style: solid;
}
.cta-corner.tl { top: 2rem; left: 2rem;  border-width: 2px 0 0 2px; }
.cta-corner.tr { top: 2rem; right: 2rem; border-width: 2px 2px 0 0; }
.cta-corner.bl { bottom: 2rem; left: 2rem;  border-width: 0 0 2px 2px; }
.cta-corner.br { bottom: 2rem; right: 2rem; border-width: 0 2px 2px 0; }

.cta-section h2 {
    font-family: 'Bebas Neue', sans-serif;
    font-size: clamp(3.5rem, 9vw, 8rem);
    letter-spacing: 3px;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    position: relative;
    line-height: 0.92;
}

.cta-section h2 span { color: var(--accent); }

/* FIX: CTA description — de #555 a var(--text-secondary) */
.cta-section p {
    font-family: 'Rajdhani', sans-serif;
    font-size: 1.05rem;
    font-weight: 500;
    color: var(--text-secondary);   /* antes #555 */
    margin-bottom: 3rem;
    position: relative;
    letter-spacing: 0.5px;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.8;
}

/* ══════════════ BOTONES ══════════════ */
.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.8rem;
    padding: 1rem 2.8rem;
    background: var(--accent);
    color: #0a0a0f;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.1rem;
    letter-spacing: 4px;
    border: none;
    cursor: pointer;
    transition: background 0.25s, transform 0.25s, box-shadow 0.25s;
    position: relative;
    overflow: hidden;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0; left: -100%;
    width: 100%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
    transition: left 0.5s;
}

.btn-primary:hover::before { left: 100%; }
.btn-primary:hover {
    background: #dbb97e;
    color: #0a0a0f;
    transform: translateY(-2px);
    box-shadow: 0 10px 35px rgba(201,169,110,0.28);
}

.btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 0.8rem;
    padding: 1rem 2.8rem;
    background: transparent;
    color: var(--accent);
    border: 1px solid var(--accent-line);
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.1rem;
    letter-spacing: 4px;
    cursor: pointer;
    transition: background 0.25s, border-color 0.25s, transform 0.25s;
}

.btn-outline:hover {
    background: var(--accent-dim);
    border-color: rgba(201,169,110,0.4);
    transform: translateY(-2px);
}

/* ══════════════ REVEAL ON SCROLL ══════════════ */
.reveal { opacity: 0; transform: translateY(36px); transition: opacity 0.8s ease, transform 0.8s ease; }
.reveal.visible { opacity: 1; transform: translateY(0); }

/* ══════════════ ANIMACIONES ══════════════ */
@keyframes blink  { 0%,100%{opacity:1} 50%{opacity:0.15} }
@keyframes fadeUp { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }

/* ══════════════ RESPONSIVE ══════════════ */
@media (max-width: 900px) {
    .hero, .nx-section, .cta-section { padding-left: 2rem; padding-right: 2rem; }
    .hero { padding-bottom: 5rem; }
    .hero-stats { display: none; }
    .games-grid { grid-template-columns: 1fr; }
    .cat-grid   { grid-template-columns: 1fr; }
    .stats-band { grid-template-columns: repeat(2, 1fr); }
}
</style>

{{-- ══ HERO ══ --}}
<section class="hero">

    <div class="hero-grid"></div>
    <div class="hero-overlay"></div>
    <div class="hero-orb"></div>
    <div class="hero-radar"></div>

    <div class="hero-content">
        <div class="hero-eyebrow">Bienvenido a NexusPlay</div>

        <h1 class="hero-title">
            El mundo del <br>
            <span class="accent">GAMING</span><br>
            <span class="hero-title">te espera.</span>
        </h1>

        <p class="hero-desc">
            Videojuegos, consolas y accesorios al mejor precio.<br>
            Tu próxima aventura comienza aquí.
        </p>

        <div class="hero-btns">
            <a href="{{ route('juegos') }}" class="btn-primary">Ver catálogo ➜</a>
            <a href="{{ route('ofertas') }}" class="btn-outline">Ofertas activas</a>
        </div>
    </div>

    <div class="hero-stats">
        <div class="hero-stat">
            <div class="hero-stat-num">500+</div>
            <div class="hero-stat-label">Títulos</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-num">12K+</div>
            <div class="hero-stat-label">Jugadores</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-num">98%</div>
            <div class="hero-stat-label">Satisfacción</div>
        </div>
    </div>

    <div class="hero-scroll">
        <div class="scroll-mouse">
            <div class="scroll-wheel"></div>
        </div>
        <div class="scroll-text">Scroll</div>
    </div>
</section>

{{-- ══ TICKER ══ --}}
<div class="ticker">
    <div class="ticker-inner">
        <span class="ticker-item">NexusPlay <span class="ticker-sep">◆</span></span>
        <span class="ticker-item">Nuevos títulos cada semana <span class="ticker-sep">◆</span></span>
        <span class="ticker-item">Envío express disponible <span class="ticker-sep">◆</span></span>
        <span class="ticker-item">Ofertas exclusivas para miembros <span class="ticker-sep">◆</span></span>
        <span class="ticker-item">+500 títulos disponibles <span class="ticker-sep">◆</span></span>
        <span class="ticker-item">Soporte 24/7 <span class="ticker-sep">◆</span></span>
        <span class="ticker-item">NexusPlay <span class="ticker-sep">◆</span></span>
        <span class="ticker-item">Nuevos títulos cada semana <span class="ticker-sep">◆</span></span>
        <span class="ticker-item">Envío express disponible <span class="ticker-sep">◆</span></span>
        <span class="ticker-item">Ofertas exclusivas para miembros <span class="ticker-sep">◆</span></span>
        <span class="ticker-item">+500 títulos disponibles <span class="ticker-sep">◆</span></span>
        <span class="ticker-item">Soporte 24/7 <span class="ticker-sep">◆</span></span>
    </div>
</div>

{{-- ══ JUEGOS DESTACADOS ══ --}}
<section class="featured nx-section">
    <div class="nx-label">Destacados</div>
    <div class="nx-title reveal">Más vendidos</div>
    <div class="nx-divider"></div>

    <div class="games-grid reveal">

        <div class="game-card">
            <div class="card-img">
                <div class="card-img-bg"></div>
                <div class="card-img-emoji">🎮</div>
                <div class="card-overlay"><span>Ver más</span></div>
            </div>
            <div class="card-body">
                <div class="card-genre">Acción / RPG</div>
                <div class="card-name">Shadow Realm Chronicles</div>
                <div class="card-footer">
                    <div>
                        <span class="card-price">$149.900</span>
                        <span class="card-old">$199.900</span>
                    </div>
                    <div class="card-badge">−25%</div>
                </div>
            </div>
        </div>

        <div class="game-card">
            <div class="card-img">
                <div class="card-img-bg b2"></div>
                <div class="card-img-emoji">🕹️</div>
                <div class="card-overlay"><span>Ver más</span></div>
            </div>
            <div class="card-body">
                <div class="card-genre">Shooter / Online</div>
                <div class="card-name">Vortex Strike Force</div>
                <div class="card-footer">
                    <span class="card-price">$89.900</span>
                    <div class="card-badge">Nuevo</div>
                </div>
            </div>
        </div>

        <div class="game-card">
            <div class="card-img">
                <div class="card-img-bg b3"></div>
                <div class="card-img-emoji">👾</div>
                <div class="card-overlay"><span>Ver más</span></div>
            </div>
            <div class="card-body">
                <div class="card-genre">Estrategia</div>
                <div class="card-name">Empire of Stars</div>
                <div class="card-footer">
                    <div>
                        <span class="card-price">$119.900</span>
                        <span class="card-old">$159.900</span>
                    </div>
                    <div class="card-badge">−25%</div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ══ STATS BAND ══ --}}
<div class="stats-band">
    <div class="stat-item reveal">
        <div class="stat-num">500+</div>
        <div class="stat-label">Títulos disponibles</div>
    </div>
    <div class="stat-item reveal">
        <div class="stat-num">12K+</div>
        <div class="stat-label">Clientes satisfechos</div>
    </div>
    <div class="stat-item reveal">
        <div class="stat-num">98%</div>
        <div class="stat-label">Entregas a tiempo</div>
    </div>
    <div class="stat-item reveal">
        <div class="stat-num">24/7</div>
        <div class="stat-label">Soporte activo</div>
    </div>
</div>

{{-- ══ CATEGORÍAS ══ --}}
<section class="nx-section" style="background: var(--dark);">
    <div class="nx-label">Explorar</div>
    <div class="nx-title reveal">Categorías</div>
    <div class="nx-divider"></div>

    <div class="cat-grid reveal">
        <div class="cat-item">
            <div class="cat-icon">🎮</div>
            <div class="cat-info">
                <h3>Consolas</h3>
                <p>PlayStation, Xbox, Nintendo y más</p>
            </div>
        </div>
        <div class="cat-item">
            <div class="cat-icon">💿</div>
            <div class="cat-info">
                <h3>Juegos físicos</h3>
                <p>Todas las plataformas</p>
            </div>
        </div>
        <div class="cat-item">
            <div class="cat-icon">🖥️</div>
            <div class="cat-info">
                <h3>PC Gaming</h3>
                <p>Hardware y periféricos</p>
            </div>
        </div>
        <div class="cat-item">
            <div class="cat-icon">🎧</div>
            <div class="cat-info">
                <h3>Accesorios</h3>
                <p>Headsets, mandos, sillas y más</p>
            </div>
        </div>
    </div>
</section>

{{-- ══ CTA FINAL ══ --}}
<section class="cta-section">
    <div class="cta-bg"></div>
    <div class="cta-corner tl"></div>
    <div class="cta-corner tr"></div>
    <div class="cta-corner bl"></div>
    <div class="cta-corner br"></div>

    <h2 class="reveal">¿Listo para<br><span>jugar?</span></h2>
    <p class="reveal">Explora nuestro catálogo completo y encuentra tu próximo juego favorito.</p>

    <div class="hero-btns reveal" style="justify-content:center;">
        <a href="{{ route('juegos') }}" class="btn-primary">Ver todos los juegos ➜</a>
        <a href="{{ route('ofertas') }}" class="btn-outline">Trabaja con nosotros</a>
    </div>
</section>

<script>
const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) e.target.classList.add('visible');
        else e.target.classList.remove('visible');
    });
}, { threshold: 0.12 });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

@endsection