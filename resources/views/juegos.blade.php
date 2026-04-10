@extends('layouts.app')

@section('title', 'Juegos')

@section('content')

<style>
  :root { --accent: #c9a96e; --dark: #0a0a0f; --dark2: #12121a; --dark3: #1a1a26; }

  /* ── HERO ── */
  .cat-hero {
    padding: 6rem 4rem 3rem;
    position: relative;
    overflow: hidden;
  }
  .cat-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 50% 0%, rgba(201,169,110,0.06) 0%, transparent 70%);
    pointer-events: none;
  }
  .cat-hero-inner { position: relative; z-index: 1; }
  .cat-label {
    font-size: 0.7rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--accent);
    margin-bottom: 0.8rem;
  }
  .cat-title {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 800;
    letter-spacing: -1.5px;
    margin-bottom: 0.6rem;
    color: #e8e8f0;
  }
  .cat-sub { color: #555; font-size: 0.9rem; }
  .cat-divider { width: 40px; height: 2px; background: var(--accent); margin: 1.5rem 0; }

  /* ── FILTROS ── */
  .filters {
    display: flex;
    gap: 8px;
    padding: 0 4rem 2.5rem;
    flex-wrap: wrap;
  }
  .filter-btn {
    padding: 7px 18px;
    border: 1px solid rgba(255,255,255,0.07);
    background: transparent;
    color: #666;
    font-size: 0.72rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    cursor: pointer;
    transition: 0.25s;
    font-family: inherit;
  }
  .filter-btn:hover, .filter-btn.active {
    border-color: rgba(201,169,110,0.4);
    color: var(--accent);
    background: rgba(201,169,110,0.05);
  }

  /* ── GRID ── */
  .games {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1px;
    background: rgba(255,255,255,0.04);
    padding: 0 4rem 5rem;
  }

  /* ── CARD ── */
  .card {
    background: #0a0a0f;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    transition: background 0.3s;
    display: flex;
    flex-direction: column;
  }
  .card:hover { background: #12121a; }
  .card:hover .card-img img { transform: scale(1.06); }
  .card:hover .card-overlay { opacity: 1; }
  .card:hover .card-arrow { transform: translate(3px, -3px); }

  .card-img {
    position: relative;
    height: 210px;
    overflow: hidden;
  }
  .card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
  }
  .card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10,10,15,0.9) 0%, rgba(10,10,15,0.2) 60%, transparent 100%);
    opacity: 0.7;
    transition: opacity 0.3s;
  }

  /* Badge encima de la imagen */
  .card-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    padding: 4px 10px;
    background: rgba(10,10,15,0.85);
    border: 1px solid rgba(201,169,110,0.25);
    font-size: 0.62rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--accent);
    z-index: 2;
  }
  .card-badge.oferta {
    background: rgba(201,169,110,0.15);
    border-color: rgba(201,169,110,0.5);
  }

  .card-content {
    padding: 1.2rem 1.4rem 1.4rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
  }
  .card-genre {
    font-size: 0.62rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--accent);
  }
  .card-title {
    font-size: 1rem;
    font-weight: 700;
    color: #e8e8f0;
    line-height: 1.3;
  }
  .card-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
    padding-top: 0.8rem;
  }
  .card-price {
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--accent);
  }
  .card-price-free { color: #4caf88; }
  .card-old {
    font-size: 0.78rem;
    color: #444;
    text-decoration: line-through;
    margin-left: 6px;
  }
  .card-arrow {
    font-size: 0.7rem;
    color: #555;
    letter-spacing: 1px;
    transition: transform 0.25s;
  }
  .card-link {
    position: absolute;
    inset: 0;
    z-index: 3;
  }

  /* ── CONTADOR ── */
  .count-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 4rem 1rem;
  }
  .count-text { font-size: 0.75rem; color: #555; letter-spacing: 1px; }
  .count-num { color: var(--accent); font-weight: 700; }
</style>

{{-- HERO --}}
<section class="cat-hero">
  <div class="cat-hero-inner">
    <div class="cat-label">NexusPlay</div>
    <h2 class="cat-title">Catálogo de juegos</h2>
    <p class="cat-sub">Explora todos nuestros videojuegos disponibles</p>
    <div class="cat-divider"></div>
  </div>
</section>

{{-- FILTROS --}}
<div class="filters">
  <button class="filter-btn active">Todos</button>
  <button class="filter-btn">Acción</button>
  <button class="filter-btn">RPG</button>
  <button class="filter-btn">Shooter</button>
  <button class="filter-btn">Terror</button>
  <button class="filter-btn">Estrategia</button>
  <button class="filter-btn">Sandbox</button>
</div>

{{-- CONTADOR --}}
<div class="count-bar">
  <span class="count-text"><span class="count-num">9</span> juegos disponibles</span>
</div>

{{-- GRID DE JUEGOS --}}
<section class="games">

  {{-- 1 · FIFA 24 --}}
  <div class="card">
    <div class="card-img">
      {{-- ✏️ IMAGEN: cambia este src por la URL que quieras para FIFA 24 --}}
      <img src="https://image.api.playstation.com/vulcan/ap/rnd/202307/0710/02c58aabf3579a5b5d9ff4ae72775e46c5d0e23d2bb1c020.png" alt="FIFA 24">
      <div class="card-overlay"></div>
      <span class="card-badge">Deportes</span>
    </div>
    <div class="card-content">
      <div class="card-genre">Deportes / Fútbol</div>
      <div class="card-title">EA Sports FC 24</div>
      <div class="card-bottom">
        <div><span class="card-price">$70 USD</span></div>
        <span class="card-arrow">Ver →</span>
      </div>
    </div>
    <a href="{{ route('juego.show', 1) }}" class="card-link"></a>
  </div>

  {{-- 2 · Call of Duty --}}
  <div class="card">
    <div class="card-img">
      {{-- ✏️ IMAGEN: cambia este src por la URL que quieras para Red Dead Redemption 2 --}}
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlF9Ommq_PosOaqohBygu0knTJRwCa3EfCJA&s" alt="Red Dead Redemption 2">
      <div class="card-overlay"></div>
      <span class="card-badge">Shooter</span>
    </div>
    <div class="card-content">
      <div class="card-genre">RPG / Online</div>
      <div class="card-title">Red Dead Redemption 2</div>
      <div class="card-bottom">
        <div><span class="card-price">$200 USD</span></div>
        <span class="card-arrow">Ver →</span>
      </div>
    </div>
    <a href="{{ route('juego.show', 2) }}" class="card-link"></a>
  </div>

  {{-- 3 · God of War --}}
  <div class="card">
    <div class="card-img">
      {{-- ✏️ IMAGEN: cambia este src por la URL que quieras para God of War --}}
      <img src="https://image.api.playstation.com/vulcan/ap/rnd/202207/1210/4xJ8XB3bi888QTLZYdl7Oi0s.png" alt="God of War Ragnarök">
      <div class="card-overlay"></div>
      <span class="card-badge oferta">Oferta</span>
    </div>
    <div class="card-content">
      <div class="card-genre">Acción / Aventura</div>
      <div class="card-title">God of War Ragnarök</div>
      <div class="card-bottom">
        <div><span class="card-price">$60 USD</span><span class="card-old">$79 USD</span></div>
        <span class="card-arrow">Ver →</span>
      </div>
    </div>
    <a href="{{ route('juego.show', 3) }}" class="card-link"></a>
  </div>

  {{-- 4 · Dark Souls Remastered --}}
  <div class="card">
    <div class="card-img">
      {{-- ✏️ IMAGEN: cambia este src por la URL que quieras para Dark Souls Remastered --}}
      <img src="https://i.blogs.es/591b5a/280518-darksouls-review/1366_2000.jpg" alt="Dark Souls Remastered">
      <div class="card-overlay"></div>
      <span class="card-badge">RPG</span>
    </div>
    <div class="card-content">
      <div class="card-genre">RPG / Souls-like</div>
      <div class="card-title">Dark Souls Remastered</div>
      <div class="card-bottom">
        <div><span class="card-price">$55 USD</span></div>
        <span class="card-arrow">Ver →</span>
      </div>
    </div>
    <a href="{{ route('juego.show', 4) }}" class="card-link"></a>
  </div>

  {{-- 5 · Dark Souls II --}}
  <div class="card">
    <div class="card-img">
      {{-- ✏️ IMAGEN: cambia este src por la URL que quieras para Dark Souls II --}}
      <img src="https://xombitgames.com/files/2015/04/Dark-Souls-2-Scholar-of-the-first-sin.jpg" alt="Dark Souls II">
      <div class="card-overlay"></div>
      <span class="card-badge oferta">Gratis</span>
    </div>
    <div class="card-content">
      <div class="card-genre">RPG / Souls-like</div>
      <div class="card-title">Dark Souls II: Scholar of the First Sin</div>
      <div class="card-bottom">
        <div><span class="card-price card-price-free">Gratis</span></div>
        <span class="card-arrow">Ver →</span>
      </div>
    </div>
    <a href="{{ route('juego.show', 5) }}" class="card-link"></a>
  </div>

  {{-- 6 · Dark Souls III --}}
  <div class="card">
    <div class="card-img">
      {{-- ✏️ IMAGEN: cambia este src por la URL que quieras para Dark Souls III --}}
      <img src="https://www.desconsolados.com/wp-content/uploads/2016/04/dark_souls_3_logo.jpg" alt="Dark Souls III">
      <div class="card-overlay"></div>
      <span class="card-badge">RPG</span>
    </div>
    <div class="card-content">
      <div class="card-genre">RPG / Souls-like</div>
      <div class="card-title">Dark Souls III</div>
      <div class="card-bottom">
        <div><span class="card-price">$50 USD</span></div>
        <span class="card-arrow">Ver →</span>
      </div>
    </div>
    <a href="{{ route('juego.show', 6) }}" class="card-link"></a>
  </div>

  {{-- 7 · Minecraft --}}
  <div class="card">
    <div class="card-img">
      {{-- ✏️ IMAGEN: cambia este src por la URL que quieras para Minecraft --}}
      <img src="https://preview.redd.it/minecraft-cover-art-seed-v0-2zs6alhs84y71.png?width=767&format=png&auto=webp&s=f9347a773026654dd349ee4c4c72f96167a2f93f" alt="Minecraft">
      <div class="card-overlay"></div>
      <span class="card-badge">Sandbox</span>
    </div>
    <div class="card-content">
      <div class="card-genre">Sandbox / Supervivencia</div>
      <div class="card-title">Minecraft</div>
      <div class="card-bottom">
        <div><span class="card-price">$30 USD</span></div>
        <span class="card-arrow">Ver →</span>
      </div>
    </div>
    <a href="{{ route('juego.show', 7) }}" class="card-link"></a>
  </div>

  {{-- 8 · Cyberpunk 2077 --}}
  <div class="card">
    <div class="card-img">
      {{-- ✏️ IMAGEN: cambia este src por la URL que quieras para Cyberpunk --}}
      <img src="https://upload.wikimedia.org/wikipedia/en/9/9f/Cyberpunk_2077_box_art.jpg" alt="Cyberpunk 2077">
      <div class="card-overlay"></div>
      <span class="card-badge oferta">Oferta</span>
    </div>
    <div class="card-content">
      <div class="card-genre">RPG / Acción</div>
      <div class="card-title">Cyberpunk 2077</div>
      <div class="card-bottom">
        <div><span class="card-price">$45 USD</span><span class="card-old">$60 USD</span></div>
        <span class="card-arrow">Ver →</span>
      </div>
    </div>
    <a href="{{ route('juego.show', 8) }}" class="card-link"></a>
  </div>

  {{-- 9 · Silent Hill 2 Remake --}}
  <div class="card">
    <div class="card-img">
      {{-- ✏️ IMAGEN: cambia este src por la URL que quieras para Silent Hill 2 --}}
      <img src="https://static.wikia.nocookie.net/silenthill/images/4/48/SH2R.jpg/revision/latest?cb=20221029143023&path-prefix=es" alt="Silent Hill 2 Remake">
      <div class="card-overlay"></div>
      <span class="card-badge">Terror</span>
    </div>
    <div class="card-content">
      <div class="card-genre">Terror / Survival Horror</div>
      <div class="card-title">Silent Hill 2 Remake</div>
      <div class="card-bottom">
        <div><span class="card-price">$40 USD</span></div>
        <span class="card-arrow">Ver →</span>
      </div>
    </div>
    <a href="{{ route('juego.show', 9) }}" class="card-link"></a>
  </div>

</section>

<script>
  // Filtros (visual por ahora, puedes conectarlos a lógica real después)
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    });
  });
</script>

@endsection