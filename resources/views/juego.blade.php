  @extends('layouts.app')

  @section('title', $juego['nombre'])

  @section('content')

  <style>
    :root { --accent: #c9a96e; --dark: #0a0a0f; --dark2: #12121a; --dark3: #1a1a26; }

    /* ───── HERO ───── */
    .hero-det {
      position: relative;
      height: 65vh;
      min-height: 420px;
      background: url('{{ $juego['img'] }}') center/cover no-repeat;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 0 4rem 3rem;
      overflow: hidden;
    }
    .hero-det::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, #0a0a0f 0%, rgba(10,10,15,0.65) 45%, rgba(10,10,15,0.2) 100%);
    }
    .hero-det::after {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(ellipse at 80% 40%, rgba(201,169,110,0.08) 0%, transparent 60%);
    }
    .hero-content { position: relative; z-index: 2; }
    .hero-breadcrumb {
      font-size: 0.7rem;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 1rem;
      opacity: 0.8;
    }
    .hero-breadcrumb a { color: inherit; opacity: 0.6; transition: opacity 0.2s; }
    .hero-breadcrumb a:hover { opacity: 1; }
    .hero-title {
      font-size: clamp(2.5rem, 6vw, 5rem);
      font-weight: 800;
      line-height: 1.05;
      letter-spacing: -2px;
      margin-bottom: 1.2rem;
      color: #e8e8f0;
    }
    .hero-meta { display: flex; gap: 1rem; align-items: center; flex-wrap: wrap; }
    .hero-badge {
      padding: 5px 14px;
      background: rgba(201,169,110,0.12);
      border: 1px solid rgba(201,169,110,0.3);
      font-size: 0.7rem;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--accent);
    }
    .hero-stars { color: var(--accent); letter-spacing: 2px; font-size: 0.85rem; }
    .hero-rating { font-size: 0.75rem; color: #666; }

    /* ───── LAYOUT ───── */
    .det-layout {
      display: grid;
      grid-template-columns: 1fr 340px;
      gap: 2.5rem;
      padding: 3rem 4rem;
      align-items: start;
    }

    /* ───── SECCIÓN LABELS ───── */
    .nx-label { font-size: 0.7rem; letter-spacing: 4px; text-transform: uppercase; color: var(--accent); margin-bottom: 0.6rem; }
    .nx-divider { width: 30px; height: 1px; background: var(--accent); margin-bottom: 1.5rem; opacity: 0.6; }

    /* ───── GALERÍA ───── */
    .screenshots {
      display: grid;
      grid-template-columns: 1.7fr 1fr 1fr;
      gap: 8px;
      margin-bottom: 3rem;
    }
    .screenshot {
      background: linear-gradient(135deg, #1a1a2e, #16213e);
      border-radius: 4px;
      overflow: hidden;
      position: relative;
      border: 1px solid rgba(255,255,255,0.05);
      cursor: pointer;
      transition: border-color 0.3s;
    }
    .screenshot:hover { border-color: rgba(201,169,110,0.3); }
    .screenshot.main { height: 220px; }
    .screenshot.thumb { height: 106px; }
    .screenshot img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .screenshot-overlay {
      position: absolute;
      inset: 0;
      background: rgba(201,169,110,0);
      transition: 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .screenshot:hover .screenshot-overlay { background: rgba(201,169,110,0.08); }
    .screenshot-label {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 6px 10px;
      background: linear-gradient(to top, rgba(10,10,15,0.85), transparent);
      font-size: 0.65rem;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: #aaa;
    }

    /* ───── DESCRIPCIÓN ───── */
    .desc-text {
      color: #888;
      font-size: 0.9rem;
      line-height: 1.85;
      margin-bottom: 2.5rem;
    }

    /* ───── INFO GRID ───── */
    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1px;
      background: rgba(255,255,255,0.05);
      margin-bottom: 2.5rem;
    }
    .info-cell { background: #0a0a0f; padding: 1rem 1.2rem; }
    .info-key {
      font-size: 0.65rem;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #555;
      margin-bottom: 0.4rem;
    }
    .info-val { font-size: 0.9rem; color: #ccc; font-weight: 500; }

    /* ───── TAGS ───── */
    .tags-row { display: flex; gap: 8px; flex-wrap: wrap; }
    .tag {
      padding: 6px 16px;
      border: 1px solid rgba(201,169,110,0.15);
      font-size: 0.7rem;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #777;
      cursor: pointer;
      transition: 0.25s;
    }
    .tag:hover { border-color: rgba(201,169,110,0.5); color: var(--accent); }

    /* ───── JUEGOS SIMILARES ───── */
    .similar { margin-top: 3rem; }
    .sim-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1px;
      background: rgba(255,255,255,0.05);
      margin-top: 1.2rem;
    }
    .sim-card { background: #0a0a0f; padding: 1.2rem; cursor: pointer; transition: background 0.2s; text-decoration: none; display: block; }
    .sim-card:hover { background: #12121a; }
    .sim-img { width: 100%; height: 80px; background: linear-gradient(135deg, #1a1a2e, #16213e); display: flex; align-items: center; justify-content: center; font-size: 2rem; margin-bottom: 0.8rem; }
    .sim-genre { font-size: 0.6rem; letter-spacing: 2px; text-transform: uppercase; color: var(--accent); margin-bottom: 0.3rem; }
    .sim-name { font-size: 0.85rem; color: #ccc; font-weight: 600; margin-bottom: 0.4rem; }
    .sim-price { font-size: 0.9rem; color: var(--accent); font-weight: 700; }

    /* ───── BUY BOX ───── */
    .buy-box {
      background: #12121a;
      border: 1px solid rgba(201,169,110,0.12);
      padding: 2rem;
      position: sticky;
      top: 90px;
    }

    .price-row { margin-bottom: 1.5rem; }
    .price-old { font-size: 0.85rem; color: #555; text-decoration: line-through; margin-bottom: 0.3rem; }
    .price-main { font-size: 2.4rem; font-weight: 800; color: var(--accent); line-height: 1; }
    .price-save {
      display: inline-block;
      margin-top: 0.6rem;
      padding: 4px 12px;
      background: rgba(201,169,110,0.1);
      font-size: 0.65rem;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--accent);
    }

    .btn-buy {
      width: 100%;
      padding: 1rem;
      background: var(--accent);
      color: #0a0a0f;
      font-weight: 800;
      font-size: 0.75rem;
      letter-spacing: 3px;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      transition: all 0.3s;
      margin-bottom: 0.8rem;
    }
    .btn-buy:hover { background: #dbb97e; transform: translateY(-2px); }

    .btn-wish {
      width: 100%;
      padding: 1rem;
      background: transparent;
      color: var(--accent);
      font-weight: 700;
      font-size: 0.75rem;
      letter-spacing: 3px;
      text-transform: uppercase;
      border: 1px solid rgba(201,169,110,0.3);
      cursor: pointer;
      transition: all 0.3s;
    }
    .btn-wish:hover { background: rgba(201,169,110,0.06); border-color: var(--accent); }

    .perks {
      margin-top: 1.5rem;
      border-top: 1px solid rgba(255,255,255,0.05);
      padding-top: 1.2rem;
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }
    .perk { display: flex; gap: 12px; align-items: flex-start; }
    .perk-icon { color: var(--accent); font-size: 0.65rem; margin-top: 3px; flex-shrink: 0; }
    .perk-text { font-size: 0.8rem; color: #666; line-height: 1.4; }
    .perk-text strong { color: #999; font-weight: 600; }

    .buy-meta {
      margin-top: 1.5rem;
      border-top: 1px solid rgba(255,255,255,0.05);
      padding-top: 1.2rem;
    }
    .meta-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.4rem 0;
      border-bottom: 1px solid rgba(255,255,255,0.03);
    }
    .meta-row:last-child { border-bottom: none; }
    .meta-key { font-size: 0.68rem; color: #555; letter-spacing: 1px; text-transform: uppercase; }
    .meta-val { font-size: 0.8rem; color: #888; }

    /* ───── REVEAL ───── */
    .reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.7s ease, transform 0.7s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }
  </style>

  {{-- HERO --}}
  <section class="hero-det">
    <div class="hero-content">
      <div class="hero-breadcrumb">
        <a href="{{ route('inicio') }}">Inicio</a>
        &nbsp;/&nbsp;
        <a href="{{ route('juegos') }}">Juegos</a>
        &nbsp;/&nbsp; {{ $juego['nombre'] }}
      </div>
      <h1 class="hero-title">{{ $juego['nombre'] }}</h1>
      <div class="hero-meta">
        <span class="hero-badge">{{ $juego['categoria'] }}</span>
        <span class="hero-badge">{{ $juego['plataforma'] }}</span>
        <span class="hero-stars">★★★★★</span>
        <span class="hero-rating">4.8 (2.3k reseñas)</span>
      </div>
    </div>
  </section>

  {{-- LAYOUT PRINCIPAL --}}
  <section class="det-layout">

    {{-- COLUMNA IZQUIERDA --}}
    <div>

  {{-- ══ GALERÍA — reemplaza tu bloque .screenshots ══ --}}
  <div class="screenshots reveal">

    <div class="screenshot main">
      {{-- Portada / imagen principal del juego --}}
      <img src="{{ $juego['img'] }}" alt="{{ $juego['nombre'] }}">
      <div class="screenshot-overlay"></div>
      <div class="screenshot-label">Portada</div>
    </div>

    <div class="screenshot thumb">
      {{-- img_2 si existe, si no usa img como fallback --}}
      <img src="{{ $juego['img_2'] ?? $juego['img'] }}" alt="Gameplay">
      <div class="screenshot-overlay"></div>
      <div class="screenshot-label">Gameplay</div>
    </div>

    <div class="screenshot thumb">
      {{-- img_3 si existe, si no usa img como fallback --}}
      <img src="{{ $juego['img_3'] ?? $juego['img'] }}" alt="Mundo">
      <div class="screenshot-overlay"></div>
      <div class="screenshot-label">Mundo</div>
    </div>

  </div>

      {{-- Descripción --}}
      <div class="nx-label reveal">Sobre el juego</div>
      <div class="nx-divider"></div>
      <p class="desc-text reveal">{{ $juego['descripcion'] }}</p>

      {{-- Info grid --}}
      <div class="info-grid reveal">
        <div class="info-cell">
          <div class="info-key">Plataforma</div>
          <div class="info-val">{{ $juego['plataforma'] }}</div>
        </div>
        <div class="info-cell">
          <div class="info-key">Categoría</div>
          <div class="info-val">{{ $juego['categoria'] }}</div>
        </div>
        <div class="info-cell">
          <div class="info-key">Formato</div>
          <div class="info-val">Digital</div>
        </div>
        <div class="info-cell">
          <div class="info-key">Idioma</div>
          <div class="info-val">Español / Inglés</div>
        </div>
      </div>

      {{-- ══ TAGS dinámicos — reemplaza tu bloque .tags-row ══ --}}
      <div class="tags-row reveal">
      @foreach($juego['tags'] as $tag)
          <span class="tag">{{ $tag }}</span>
      @endforeach
      </div>


  {{-- ══ SIMILARES dinámicos — reemplaza tu bloque .sim-grid ══ --}}
  <div class="sim-grid">
    @foreach($similares as $sim)
      <a href="{{ route('juego.show', $sim['id']) }}" class="sim-card">
        <div class="sim-img">
          <img src="{{ $sim['img'] }}"
              alt="{{ $sim['nombre'] }}"
              style="width:100%;height:100%;object-fit:cover;display:block">
        </div>
        <div class="sim-genre">{{ $sim['categoria'] }}</div>
        <div class="sim-name">{{ $sim['nombre'] }}</div>
        <div class="sim-price">${{ $sim['precio'] }} USD</div>
      </a>
    @endforeach
  </div>

    </div>

    {{-- COLUMNA DERECHA - Buy Box --}}
    <div class="buy-box reveal">

      <div class="price-row">
        {{-- Mostrar precio tachado si hay descuento --}}
        {{-- <div class="price-old">${{ $juego['precio_original'] }}</div> --}}
        <div class="price-main">${{ $juego['precio'] }}</div>
        {{-- <span class="price-save">Ahorras $X</span> --}}
      </div>

      <button class="btn-buy">Comprar ahora</button>
      <button class="btn-wish">♡ &nbsp; Agregar a wishlist</button>

      <div class="perks">
        <div class="perk">
          <span class="perk-icon">✦</span>
          <div class="perk-text"><strong>Entrega digital inmediata</strong> — Código en tu correo al instante</div>
        </div>
        <div class="perk">
          <span class="perk-icon">✦</span>
          <div class="perk-text"><strong>Código original garantizado</strong> — 100% oficial y verificado</div>
        </div>
        <div class="perk">
          <span class="perk-icon">✦</span>
          <div class="perk-text"><strong>Soporte 24/7</strong> — Estamos para ayudarte siempre</div>
        </div>
      </div>

      <div class="buy-meta">
        <div class="meta-row">
          <span class="meta-key">Formato</span>
          <span class="meta-val">Digital</span>
        </div>
        <div class="meta-row">
          <span class="meta-key">Región</span>
          <span class="meta-val">América Latina</span>
        </div>
        <div class="meta-row">
          <span class="meta-key">Activación</span>
          <span class="meta-val">{{ $juego['plataforma'] }}</span>
        </div>
        <div class="meta-row">
          <span class="meta-key">Categoría</span>
          <span class="meta-val">{{ $juego['categoria'] }}</span>
        </div>
      </div>

    </div>

  </section>

  <script>
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) e.target.classList.add('visible');
        else e.target.classList.remove('visible');
      });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
  </script>

  @endsection