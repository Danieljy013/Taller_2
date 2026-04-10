@extends('layouts.app')

@section('title', 'NexusPlay - Tu tienda de videojuegos')

@section('content')

<style>
  :root { --accent: #c9a96e; --dark: #0a0a0f; --dark2: #12121a; --dark3: #1a1a26; }

  .hero {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    padding: 0 4rem;
    position: relative;
    overflow: hidden;
    background: #0a0a0f;
  }
  .hero-bg {
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at 70% 50%, rgba(201,169,110,0.07) 0%, transparent 60%),
                radial-gradient(ellipse at 20% 80%, rgba(100,60,200,0.05) 0%, transparent 50%);
  }
  .hero-line { width: 0; height: 2px; background: var(--accent); margin-bottom: 2rem; animation: expandLine 1s ease 0.2s forwards; }
  @keyframes expandLine { to { width: 60px; } }
  .hero-sub { font-size: 0.8rem; letter-spacing: 4px; text-transform: uppercase; color: var(--accent); margin-bottom: 1.5rem; opacity: 0; animation: fadeUp 0.8s ease 0.3s forwards; }
  .hero-title { font-size: clamp(3rem, 8vw, 7rem); font-weight: 800; line-height: 1.0; letter-spacing: -2px; margin-bottom: 2rem; color: #e8e8f0; opacity: 0; animation: fadeUp 0.8s ease 0.5s forwards; }
  .hero-title span { color: var(--accent); }
  .hero-desc { font-size: 1.1rem; color: #888; max-width: 500px; line-height: 1.8; margin-bottom: 3rem; opacity: 0; animation: fadeUp 0.8s ease 0.7s forwards; }
  .hero-btns { display: flex; gap: 1.5rem; opacity: 0; animation: fadeUp 0.8s ease 0.9s forwards; }
  .hero-scroll { position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%); display: flex; flex-direction: column; align-items: center; gap: 0.5rem; color: #555; font-size: 0.7rem; letter-spacing: 3px; text-transform: uppercase; animation: pulse 2s ease infinite; }
  .scroll-bar { width: 1px; height: 50px; background: linear-gradient(to bottom, var(--accent), transparent); }
  @keyframes pulse { 0%,100% { opacity: 0.4; } 50% { opacity: 1; } }
  @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }

  .nx-section { padding: 7rem 4rem; }
  .nx-label { font-size: 0.75rem; letter-spacing: 4px; text-transform: uppercase; color: var(--accent); margin-bottom: 1rem; }
  .nx-title { font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; margin-bottom: 1rem; line-height: 1.1; color: #e8e8f0; }
  .nx-divider { width: 40px; height: 2px; background: var(--accent); margin-bottom: 3rem; }

  .featured { background: #12121a; }
  .games-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
  .game-card { background: #1a1a26; overflow: hidden; position: relative; cursor: pointer; transition: transform 0.4s; }
  .game-card:hover { transform: translateY(-8px); }
  .game-card:hover .card-overlay { opacity: 1; }
  .card-img { width: 100%; height: 220px; display: flex; align-items: center; justify-content: center; font-size: 5rem; background: linear-gradient(135deg, #1a1a2e, #16213e); }
  .card-overlay { position: absolute; inset: 0; background: rgba(201,169,110,0.12); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s; }
  .card-overlay span { background: var(--accent); color: #0a0a0f; padding: 0.7rem 1.8rem; font-weight: 700; font-size: 0.8rem; letter-spacing: 2px; text-transform: uppercase; }
  .card-body { padding: 1.5rem; }
  .card-genre { font-size: 0.7rem; color: var(--accent); letter-spacing: 3px; text-transform: uppercase; margin-bottom: 0.5rem; }
  .card-name { font-size: 1.1rem; font-weight: 700; margin-bottom: 0.5rem; color: #e8e8f0; }
  .card-price { font-size: 1.3rem; font-weight: 800; color: var(--accent); }
  .card-old { font-size: 0.85rem; color: #555; text-decoration: line-through; margin-left: 0.5rem; }

  .stats-band { background: #0d0d15; display: grid; grid-template-columns: repeat(4, 1fr); }
  .stat-item { padding: 4rem 2rem; text-align: center; border-right: 1px solid rgba(201,169,110,0.1); }
  .stat-item:last-child { border-right: none; }
  .stat-num { font-size: 3rem; font-weight: 800; color: var(--accent); line-height: 1; margin-bottom: 0.5rem; }
  .stat-label { font-size: 0.75rem; letter-spacing: 3px; text-transform: uppercase; color: #666; }

  .cat-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1px; background: rgba(201,169,110,0.1); }
  .cat-item { background: #12121a; padding: 3rem; display: flex; align-items: center; gap: 2rem; cursor: pointer; transition: background 0.3s; }
  .cat-item:hover { background: #1a1a26; }
  .cat-icon { font-size: 2.5rem; width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(201,169,110,0.2); flex-shrink: 0; }
  .cat-info h3 { font-size: 1.2rem; font-weight: 700; margin-bottom: 0.3rem; color: #e8e8f0; }
  .cat-info p { color: #666; font-size: 0.85rem; }

  .cta-section { background: #12121a; text-align: center; padding: 8rem 4rem; position: relative; overflow: hidden; }
  .cta-bg { position: absolute; inset: 0; background: radial-gradient(ellipse at center, rgba(201,169,110,0.06) 0%, transparent 70%); }
  .cta-section h2 { font-size: clamp(2.5rem, 6vw, 5rem); font-weight: 800; margin-bottom: 1.5rem; position: relative; color: #e8e8f0; }
  .cta-section p { color: #777; font-size: 1.1rem; margin-bottom: 3rem; position: relative; }

  .btn-primary { padding: 1rem 2.5rem; background: var(--accent); color: #0a0a0f; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 0.8rem; border: none; cursor: pointer; transition: all 0.3s; text-decoration: none; display: inline-block; }
  .btn-primary:hover { background: #dbb97e; transform: translateY(-2px); color: #0a0a0f; }
  .btn-outline { padding: 1rem 2.5rem; background: transparent; color: var(--accent); border: 1px solid var(--accent); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 0.8rem; cursor: pointer; transition: all 0.3s; text-decoration: none; display: inline-block; }
  .btn-outline:hover { background: rgba(201,169,110,0.1); transform: translateY(-2px); }

  .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.8s ease, transform 0.8s ease; }
  .reveal.visible { opacity: 1; transform: translateY(0); }
</style>

{{-- HERO --}}
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-line"></div>
  <p class="hero-sub">Bienvenido a NexusPlay</p>
  <h1 class="hero-title">El mundo<br>del gaming<br><span>te espera.</span></h1>
  <p class="hero-desc">Videojuegos, consolas y accesorios al mejor precio. Tu próxima aventura comienza aquí.</p>
  <div class="hero-btns">
    <a href="{{ route('juegos') }}" class="btn-primary">Ver catálogo</a>
    <a href="{{ route('ofertas') }}" class="btn-outline">Ofertas activas</a>
  </div>
  <div class="hero-scroll">
    <div class="scroll-bar"></div>
    Scroll
  </div>
</section>

{{-- JUEGOS DESTACADOS --}}
<section class="featured nx-section">
  <div class="nx-label">Destacados</div>
  <div class="nx-title reveal">Más vendidos</div>
  <div class="nx-divider"></div>
  <div class="games-grid reveal">
    <div class="game-card">
      <div class="card-img">🎮</div>
      <div class="card-overlay"><span>Ver más</span></div>
      <div class="card-body">
        <div class="card-genre">Acción / RPG</div>
        <div class="card-name">Shadow Realm Chronicles</div>
        <div><span class="card-price">$149.900</span><span class="card-old">$199.900</span></div>
      </div>
    </div>
    <div class="game-card">
      <div class="card-img">🕹️</div>
      <div class="card-overlay"><span>Ver más</span></div>
      <div class="card-body">
        <div class="card-genre">Shooter / Online</div>
        <div class="card-name">Vortex Strike Force</div>
        <div><span class="card-price">$89.900</span></div>
      </div>
    </div>
    <div class="game-card">
      <div class="card-img">👾</div>
      <div class="card-overlay"><span>Ver más</span></div>
      <div class="card-body">
        <div class="card-genre">Estrategia</div>
        <div class="card-name">Empire of Stars</div>
        <div><span class="card-price">$119.900</span><span class="card-old">$159.900</span></div>
      </div>
    </div>
  </div>
</section>

{{-- ESTADÍSTICAS --}}
<div class="stats-band">
  <div class="stat-item reveal"><div class="stat-num">500+</div><div class="stat-label">Títulos disponibles</div></div>
  <div class="stat-item reveal"><div class="stat-num">12K+</div><div class="stat-label">Clientes satisfechos</div></div>
  <div class="stat-item reveal"><div class="stat-num">98%</div><div class="stat-label">Entregas a tiempo</div></div>
  <div class="stat-item reveal"><div class="stat-num">24/7</div><div class="stat-label">Soporte activo</div></div>
</div>

{{-- CATEGORÍAS --}}
<section class="nx-section" style="background:#0a0a0f;">
  <div class="nx-label">Explorar</div>
  <div class="nx-title reveal">Categorías</div>
  <div class="nx-divider"></div>
  <div class="cat-grid reveal">
    <div class="cat-item"><div class="cat-icon">🎮</div><div class="cat-info"><h3>Consolas</h3><p>PlayStation, Xbox, Nintendo y más</p></div></div>
    <div class="cat-item"><div class="cat-icon">💿</div><div class="cat-info"><h3>Juegos físicos</h3><p>Todas las plataformas</p></div></div>
    <div class="cat-item"><div class="cat-icon">🖥️</div><div class="cat-info"><h3>PC Gaming</h3><p>Hardware y periféricos</p></div></div>
    <div class="cat-item"><div class="cat-icon">🎧</div><div class="cat-info"><h3>Accesorios</h3><p>Headsets, mandos, sillas y más</p></div></div>
  </div>
</section>

{{-- CTA FINAL --}}
<section class="cta-section">
  <div class="cta-bg"></div>
  <h2 class="reveal">¿Listo para<br><span style="color:var(--accent)">jugar?</span></h2>
  <p class="reveal">Explora nuestro catálogo completo y encuentra tu próximo juego favorito.</p>
  <a href="{{ route('juegos') }}" class="btn-primary reveal">Ver todos los juegos</a>
</section>

<script>
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if(e.isIntersecting) {
        e.target.classList.add('visible');
      } else {
        e.target.classList.remove('visible');
      }
    });
  }, { threshold: 0.15 });
  document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
@endsection