@extends('layouts.app')

@section('title', 'Login - NexusPlay')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;500;600;700&display=swap');

:root {
    --accent:      #c9a96e;
    --accent2:     #e8c87a;
    --accent-dim:  rgba(201,169,110,0.1);
    --accent-line: rgba(201,169,110,0.22);
    --dark:        #0a0a0f;

    /* Textos accesibles — mismo sistema que index */
    --text-primary:   #e8e8f0;
    --text-secondary: #a8a8b8;   /* antes #555/#666 */
    --text-muted:     #6b6b80;   /* antes #444 */
}

.login-hero { margin-top: -70px; }

.login-hero {
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
    background: var(--dark);
    overflow: hidden;
}

/* ── PANEL IZQUIERDO ── */
.login-left {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    padding: 5rem;
    overflow: hidden;
    background: #08080e;
}

.login-left-bg {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse at 30% 60%, rgba(201,169,110,0.12) 0%, transparent 55%),
        radial-gradient(ellipse at 80% 20%, rgba(120,80,220,0.07) 0%, transparent 45%);
}

.login-left::before {
    content: '';
    position: absolute;
    inset: 0;
    background: repeating-linear-gradient(
        0deg, transparent, transparent 2px,
        rgba(0,0,0,0.12) 2px, rgba(0,0,0,0.12) 4px
    );
    pointer-events: none;
    z-index: 1;
}

.login-left-content { position: relative; z-index: 2; }

.left-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--accent-dim);
    border: 1px solid var(--accent-line);
    padding: 0.45rem 1rem;
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--accent);
    margin-bottom: 2.5rem;
    animation: fadeUp 0.8s ease 0.1s both;
}

.left-badge::before {
    content: '';
    width: 6px; height: 6px;
    background: var(--accent);
    border-radius: 50%;
    animation: blink 1.8s ease infinite;
}

.login-brand {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 5.5rem;
    line-height: 0.9;
    letter-spacing: 4px;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    animation: fadeUp 0.8s ease 0.25s both;
}

.login-brand span {
    display: block;
    -webkit-text-stroke: 1.5px var(--accent);
    color: transparent;
    font-size: 6rem;
}

/* FIX: descripción izquierda — de #555 a --text-secondary */
.left-desc {
    font-family: 'Rajdhani', sans-serif;
    font-size: 1rem;
    font-weight: 500;
    color: var(--text-secondary);
    line-height: 1.85;
    max-width: 320px;
    margin-bottom: 3rem;
    animation: fadeUp 0.8s ease 0.4s both;
}

.left-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1px;
    width: 200px;
    animation: fadeUp 0.8s ease 0.55s both;
}

.grid-cell {
    height: 60px;
    background: rgba(201,169,110,0.03);
    border: 1px solid rgba(201,169,110,0.08);
    animation: cellPulse var(--d, 3s) ease var(--del, 0s) infinite;
}

@keyframes cellPulse {
    0%,100% { background: rgba(201,169,110,0.02); }
    50%      { background: rgba(201,169,110,0.1); }
}

/* ── PANEL DERECHO ── */
.login-right {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3rem;
    position: relative;
    background: var(--dark);
}

.login-right::before {
    content: '';
    position: absolute;
    left: 0; top: 15%; bottom: 15%;
    width: 1px;
    background: linear-gradient(to bottom, transparent, rgba(201,169,110,0.28), transparent);
}

/* ── CARD ── */
.login-card {
    width: 100%;
    max-width: 400px;
    animation: fadeUp 0.9s ease 0.3s both;
}

.card-header { margin-bottom: 2.5rem; }

.card-label {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--accent);
    display: flex;
    align-items: center;
    gap: 0.8rem;
    margin-bottom: 0.8rem;
}

.card-label::after {
    content: '';
    flex: 1; height: 1px;
    background: var(--accent-line);
}

.card-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 3.2rem;
    letter-spacing: 3px;
    color: var(--text-primary);
    line-height: 1;
}

/* FIX: subtítulo card — de #444 a --text-secondary */
.card-sub {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.88rem;
    font-weight: 500;
    color: var(--text-secondary);
    margin-top: 0.5rem;
    letter-spacing: 0.5px;
}

/* ── INPUTS ── */
.input-group {
    position: relative;
    margin-bottom: 1.2rem;
}

.input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.85rem;
    color: var(--text-muted);   /* antes #444 */
    transition: color 0.2s;
    pointer-events: none;
}

.login-input {
    width: 100%;
    padding: 0.95rem 1rem 0.95rem 2.8rem;
    background: rgba(255,255,255,0.025);
    border: 1px solid rgba(255,255,255,0.07);
    border-bottom: 2px solid rgba(255,255,255,0.07);
    color: var(--text-primary);
    font-size: 0.9rem;
    font-family: 'Rajdhani', sans-serif;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.25s;
}

.login-input::placeholder { color: var(--text-muted); }

.login-input:focus {
    outline: none;
    border-color: rgba(201,169,110,0.25);
    border-bottom-color: var(--accent);
    background: rgba(201,169,110,0.04);
}

.login-input:focus ~ .input-icon { color: var(--accent); }

/* ── OPCIONES ── */
.login-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.8rem;
}

/* FIX: "Recordarme" — de #555 a --text-secondary */
.remember-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.82rem;
    font-weight: 500;
    color: var(--text-secondary);
    cursor: pointer;
    letter-spacing: 0.5px;
}

.remember-label input[type="checkbox"] {
    appearance: none;
    width: 14px; height: 14px;
    border: 1px solid var(--accent-line);
    background: transparent;
    cursor: pointer;
    position: relative;
    flex-shrink: 0;
}

.remember-label input[type="checkbox"]:checked {
    background: var(--accent);
    border-color: var(--accent);
}

.remember-label input[type="checkbox"]:checked::after {
    content: '✓';
    position: absolute;
    top: -2px; left: 1px;
    font-size: 11px;
    color: #0a0a0f;
}

.forgot-link {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--accent);
    letter-spacing: 0.5px;
    opacity: 0.75;
    transition: opacity 0.2s;
}

.forgot-link:hover { opacity: 1; }

/* ── BOTÓN ── */
.login-btn {
    width: 100%;
    padding: 1rem;
    background: var(--accent);
    border: none;
    color: #0a0a0f;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.1rem;
    letter-spacing: 4px;
    cursor: pointer;
    transition: background 0.25s, transform 0.25s, box-shadow 0.25s;
    position: relative;
    overflow: hidden;
}

.login-btn::before {
    content: '';
    position: absolute;
    top: 0; left: -100%;
    width: 100%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
    transition: left 0.5s;
}

.login-btn:hover::before { left: 100%; }
.login-btn:hover {
    background: #dbb97e;
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(201,169,110,0.28);
}
.login-btn:active { transform: translateY(0); }

/* ── DIVISOR ── */
.divider {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin: 1.5rem 0;
}

.divider::before, .divider::after {
    content: '';
    flex: 1; height: 1px;
    background: rgba(255,255,255,0.06);
}

/* FIX: "o" del divisor — de #444 a --text-muted */
.divider span {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.72rem;
    font-weight: 500;
    color: var(--text-muted);
    letter-spacing: 2px;
    text-transform: uppercase;
}

/* ── ERROR ── */
.login-error {
    margin-top: 1rem;
    padding: 0.85rem 1rem;
    background: rgba(255,107,107,0.07);
    border: 1px solid rgba(255,107,107,0.2);
    border-left: 3px solid #ff6b6b;
    color: #ff8080;
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.85rem;
    font-weight: 500;
    letter-spacing: 0.5px;
}

/* FIX: "¿No tienes cuenta?" — de #444 a --text-secondary */
.login-extra {
    margin-top: 1.8rem;
    text-align: center;
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.85rem;
    font-weight: 500;
    color: var(--text-secondary);
    letter-spacing: 0.5px;
}

.login-extra a {
    color: var(--accent);
    font-weight: 700;
    transition: color 0.2s;
}

.login-extra a:hover { color: var(--accent2); }

/* ── PARTICLES ── */
#login-particles {
    position: absolute;
    inset: 0;
    pointer-events: none;
    z-index: 0;
}

/* ── LOADER ── */
.spinner {
    width: 40px; height: 40px;
    border: 2px solid rgba(201,169,110,0.15);
    border-top: 2px solid var(--accent);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

/* FIX: texto loader — de #666 a --text-secondary */
.loader-text {
    margin-top: 1rem;
    color: var(--text-secondary);
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 3px;
    text-transform: uppercase;
}

@keyframes spin    { to { transform: rotate(360deg); } }
@keyframes blink   { 0%,100%{opacity:1} 50%{opacity:0.15} }
@keyframes fadeUp  { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }

@media (max-width: 768px) {
    .login-hero  { grid-template-columns: 1fr; }
    .login-left  { display: none; }
    .login-right { padding: 2rem 1.5rem; }
}
</style>

<section class="login-hero">

    {{-- PANEL IZQUIERDO --}}
    <div class="login-left">
        <div class="login-left-bg"></div>
        <canvas id="login-particles"></canvas>

        <div class="login-left-content">
            <div class="left-badge">Plataforma activa</div>

            <div class="login-brand">
                NEXUS<span>PLAY</span>
            </div>

            <p class="left-desc">
                El universo del gaming en un solo lugar.<br>
                Más de 500 títulos, ofertas exclusivas<br>
                y soporte 24/7 para gamers reales.
            </p>

            <div class="left-grid">
                @for($i = 0; $i < 9; $i++)
                <div class="grid-cell" style="--d: {{ rand(2,5) }}s; --del: {{ $i * 0.15 }}s;"></div>
                @endfor
            </div>
        </div>
    </div>

    {{-- PANEL DERECHO --}}
    <div class="login-right">
        <div class="login-card">
            <div class="card-header">
                <div class="card-label">Acceso seguro</div>
                <div class="card-title">Iniciar<br>Sesión</div>
                <p class="card-sub">Ingresa tus credenciales para continuar</p>
            </div>

            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf

                <div class="input-group">
                    <span class="input-icon">✉</span>
                    <input class="login-input" type="email" name="email"
                        placeholder="Correo electrónico"
                        value="{{ old('email') }}" required>
                </div>

                <div class="input-group">
                    <span class="input-icon">🔒</span>
                    <input class="login-input" type="password" name="password"
                        placeholder="Contraseña" required>
                </div>

                <div class="login-options">
                    <label class="remember-label">
                        <input type="checkbox" name="remember">
                        Recordarme
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="login-btn">Entrar al juego</button>

                @if ($errors->any())
                    <div class="login-error">
                        ⚠ {{ $errors->first() }}
                    </div>
                @endif
            </form>

            <div class="divider"><span>o</span></div>

            <div class="login-extra">
                ¿No tienes cuenta? <a href="{{ route('register') }}">Crea una gratis</a>
            </div>
        </div>
    </div>
</section>

{{-- LOADER --}}
<div id="login-loading" style="
    position: fixed; inset: 0;
    background: rgba(10,10,15,0.92);
    display: none; align-items: center;
    justify-content: center; z-index: 9999;
">
    <div style="text-align:center;">
        <div class="spinner"></div>
        <p class="loader-text">Verificando acceso...</p>
    </div>
</div>

<script>
document.getElementById('login-form').addEventListener('submit', () => {
    document.getElementById('login-loading').style.display = 'flex';
});

const canvas = document.getElementById('login-particles');
const ctx = canvas.getContext('2d');

function resize() {
    canvas.width  = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;
}
resize();
window.addEventListener('resize', resize);

const particles = Array.from({ length: 40 }, () => ({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height,
    r: Math.random() * 1.5 + 0.3,
    dx: (Math.random() - 0.5) * 0.4,
    dy: -Math.random() * 0.5 - 0.2,
    alpha: Math.random() * 0.4 + 0.1,
}));

function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    particles.forEach(p => {
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(201,169,110,${p.alpha})`;
        ctx.fill();
        p.x += p.dx;
        p.y += p.dy;
        if (p.y < 0)            p.y = canvas.height;
        if (p.x < 0)            p.x = canvas.width;
        if (p.x > canvas.width) p.x = 0;
    });
    requestAnimationFrame(draw);
}
draw();
</script>

@endsection