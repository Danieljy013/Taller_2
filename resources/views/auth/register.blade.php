@extends('layouts.app')

@section('title', 'Registro - NexusPlay')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;600;700&display=swap');

:root { --accent: #c9a96e; --accent2: #e8c87a; --dark: #0a0a0f; }

.register-hero {
    margin-top: -70px;
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    background: var(--dark);
    overflow: hidden;
}

/* ── PANEL IZQUIERDO ── */
.register-left {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    padding: 5rem;
    overflow: hidden;
    background: #08080e;
}

.register-left::before {
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

.reg-left-bg {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse at 40% 40%, rgba(201,169,110,0.1) 0%, transparent 55%),
        radial-gradient(ellipse at 80% 80%, rgba(80,40,200,0.06) 0%, transparent 45%);
}

.reg-left-content {
    position: relative;
    z-index: 2;
}

.reg-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    background: rgba(201,169,110,0.08);
    border: 1px solid rgba(201,169,110,0.2);
    padding: 0.4rem 1rem;
    font-size: 0.65rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--accent);
    margin-bottom: 2.5rem;
    animation: fadeUp 0.7s ease 0.1s both;
}

.reg-badge::before {
    content: '⬡';
    font-size: 0.8rem;
    animation: spin 4s linear infinite;
}

.reg-brand {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 5rem;
    line-height: 0.9;
    letter-spacing: 4px;
    color: #e8e8f0;
    margin-bottom: 1.5rem;
    animation: fadeUp 0.7s ease 0.25s both;
}

.reg-brand em {
    font-style: normal;
    color: var(--accent);
    -webkit-text-stroke: 1px var(--accent);
    color: transparent;
    font-size: 5.5rem;
    display: block;
}

.reg-features {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    animation: fadeUp 0.7s ease 0.4s both;
}

.reg-feature {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-family: 'Rajdhani', sans-serif;
    font-size: rem;
    color: #f4f4f4;
    transition: color 0.2s;
}

.reg-feature:hover { color: #999; }

.feature-dot {
    width: 28px;
    height: 28px;
    border: 1px solid rgba(201,169,110,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    flex-shrink: 0;
    color: var(--accent);
}

/* ── PANEL DERECHO ── */
.register-right {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 4rem 3rem;
    position: relative;
    background: var(--dark);
}

.register-right::before {
    content: '';
    position: absolute;
    left: 0;
    top: 10%;
    bottom: 10%;
    width: 1px;
    background: linear-gradient(to bottom, transparent, rgba(201,169,110,0.25), transparent);
}

/* ── CARD ── */
.register-card {
    width: 100%;
    max-width: 480px;
    animation: fadeUp 0.9s ease 0.2s both;
}

.card-header {
    margin-bottom: 2rem;
}

.card-label {
    font-size: 0.68rem;
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
    flex: 1;
    height: 1px;
    background: rgba(201,169,110,0.15);
}

.card-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2.8rem;
    letter-spacing: 3px;
    color: #e8e8f0;
    line-height: 1;
}

.card-sub {
    font-size: 0.8rem;
    color: #444;
    margin-top: 0.4rem;
    font-family: 'Rajdhani', sans-serif;
    letter-spacing: 0.5px;
}

/* ── GRID INPUTS ── */
.fields-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.8rem;
    margin-bottom: 0;
}

.field-full { grid-column: 1 / -1; }

/* ── INPUT GROUPS ── */
.input-group {
    position: relative;
    margin-bottom: 0.8rem;
}

.input-icon {
    position: absolute;
    left: 0.9rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.8rem;
    color: #f4f4f4;
    transition: color 0.2s;
    pointer-events: none;
}

.register-input {
    width: 100%;
    padding: 0.85rem 0.9rem 0.85rem 2.6rem;
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.06);
    border-bottom: 2px solid rgba(255,255,255,0.06);
    color: #f4f4f4;
    font-size: 0.83rem;
    font-family: 'Rajdhani', sans-serif;
    letter-spacing: 0.5px;
    transition: all 0.25s;
}

.register-input:focus {
    outline: none;
    border-color: rgba(201,169,110,0.25);
    border-bottom-color: var(--accent);
    background: rgba(201,169,110,0.03);
}

.register-input:focus ~ .input-icon { color: var(--accent); }

/* ── INDICADOR FORTALEZA CONTRASEÑA ── */
.strength-bar {
    display: flex;
    gap: 4px;
    margin-top: -0.4rem;
    margin-bottom: 0.8rem;
}

.strength-seg {
    flex: 1;
    height: 2px;
    background: rgba(255,255,255,0.06);
    transition: background 0.3s;
}

.strength-seg.active-weak  { background: #ff6b6b; }
.strength-seg.active-mid   { background: var(--accent); }
.strength-seg.active-strong{ background: #4ade80; }

/* ── BOTÓN ── */
.register-btn {
    width: 100%;
    padding: 1rem;
    background: var(--accent);
    border: none;
    color: #0a0a0f;
    font-weight: 700;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.15rem;
    letter-spacing: 4px;
    position: relative;
    overflow: hidden;
    margin-top: 1rem;
}

.register-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
    transition: left 0.5s;
}

.register-btn:hover::before { left: 100%; }
.register-btn:hover { background: #dbb97e; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(201,169,110,0.25); }

/* ── ERROR ── */
.register-error {
    margin-top: 0.8rem;
    padding: 0.8rem 1rem;
    background: rgba(255,107,107,0.06);
    border: 1px solid rgba(255,107,107,0.18);
    border-left: 3px solid #ff6b6b;
    color: #ff6b6b;
    font-size: 0.78rem;
    font-family: 'Rajdhani', sans-serif;
}

/* ── TÉRMINOS ── */
.terms-check {
    display: flex;
    align-items: flex-start;
    gap: 0.7rem;
    margin-top: 0.8rem;
    margin-bottom: 0.2rem;
}

.terms-check input[type="checkbox"] {
    appearance: none;
    width: 14px;
    height: 14px;
    border: 1px solid rgba(201,169,110,0.3);
    background: transparent;
    cursor: pointer;
    flex-shrink: 0;
    margin-top: 2px;
    position: relative;
}

.terms-check input:checked { background: var(--accent); }
.terms-check input:checked::after {
    content: '✓';
    position: absolute;
    top: -2px;
    left: 1px;
    font-size: 11px;
    color: #0a0a0f;
}

.terms-text {
    font-size: 0.72rem;
    color: #444;
    font-family: 'Rajdhani', sans-serif;
    line-height: 1.5;
}

.terms-text a { color: var(--accent); }

/* ── EXTRA ── */
.register-extra {
    margin-top: 1.5rem;
    text-align: center;
    font-size: 0.78rem;
    color: #444;
    font-family: 'Rajdhani', sans-serif;
}

.register-extra a {
    color: var(--accent);
    font-weight: 600;
}

/* ── LOADER ── */
.spinner {
    width: 40px;
    height: 40px;
    border: 2px solid rgba(201,169,110,0.15);
    border-top: 2px solid var(--accent);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin  { to { transform: rotate(360deg); } }
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(25px); }
    to   { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
    .register-hero  { grid-template-columns: 1fr; }
    .register-left  { display: none; }
    .register-right { padding: 2rem 1.5rem; }
    .fields-grid    { grid-template-columns: 1fr; }
}
</style>

<section class="register-hero">

    {{-- IZQUIERDO --}}
    <div class="register-left">
        <div class="reg-left-bg"></div>
        <canvas id="reg-particles" style="position:absolute;inset:0;pointer-events:none;z-index:0;"></canvas>

        <div class="reg-left-content">
            <div class="reg-badge">Nueva cuenta</div>

            <div class="reg-brand">
                ÚNETE<em>PLAY</em>
            </div>

            <div class="reg-features">
                <div class="reg-feature">
                    <div class="feature-dot">🎮</div>
                    Acceso a +500 títulos exclusivos
                </div>
                <div class="reg-feature">
                    <div class="feature-dot">⚡</div>
                    Ofertas anticipadas para miembros
                </div>
                <div class="reg-feature">
                    <div class="feature-dot">🔔</div>
                    Alertas de precio en tus juegos
                </div>
                <div class="reg-feature">
                    <div class="feature-dot">🏆</div>
                    Sistema de recompensas NexusPass
                </div>
            </div>
        </div>
    </div>

    {{-- DERECHO --}}
    <div class="register-right">
        <div class="register-card">
            <div class="card-header">
                <div class="card-label">Registro gratuito</div>
                <div class="card-title">Crear<br>Cuenta</div>
                <p class="card-sub">Completa los datos para unirte a NexusPlay</p>
            </div>

            <form method="POST" action="{{ route('register') }}" id="register-form">
                @csrf

                <div class="fields-grid">
                    <div class="input-group">
                        <span class="input-icon">👤</span>
                        <input class="register-input" type="text" name="name"
                            placeholder="Nombre completo"
                            value="{{ old('name') }}" required>
                    </div>

                    <div class="input-group">
                        <span class="input-icon">✉</span>
                        <input class="register-input" type="email" name="email"
                            placeholder="Correo electrónico"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="input-group field-full">
                        <span class="input-icon">🔒</span>
                        <input class="register-input" type="password" name="password"
                            placeholder="Contraseña" id="password-field" required>
                    </div>

                    {{-- BARRA FORTALEZA --}}
                    <div class="strength-bar field-full">
                        <div class="strength-seg" id="seg1"></div>
                        <div class="strength-seg" id="seg2"></div>
                        <div class="strength-seg" id="seg3"></div>
                        <div class="strength-seg" id="seg4"></div>
                    </div>

                    <div class="input-group field-full">
                        <span class="input-icon">🔒</span>
                        <input class="register-input" type="password" name="password_confirmation"
                            placeholder="Confirmar contraseña" required>
                    </div>
                </div>

                <div class="terms-check">
                    <input type="checkbox" id="terms" required>
                    <label for="terms" class="terms-text">
                        Acepto los <a href="#">Términos de servicio</a> y la
                        <a href="#">Política de privacidad</a> de NexusPlay.
                    </label>
                </div>

                <button type="submit" class="register-btn">Crear mi cuenta</button>

                @if ($errors->any())
                    <div class="register-error">⚠ {{ $errors->first() }}</div>
                @endif
            </form>

            <div class="register-extra">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
            </div>
        </div>
    </div>
</section>

{{-- LOADER --}}
<div id="register-loading" style="
    position:fixed; inset:0;
    background:rgba(10,10,15,0.92);
    display:none; align-items:center;
    justify-content:center; z-index:9999;">
    <div style="text-align:center;">
        <div class="spinner"></div>
        <p style="margin-top:1rem; color:#666; font-size:0.72rem; letter-spacing:3px; text-transform:uppercase; font-family:'Rajdhani',sans-serif;">
            Creando tu cuenta...
        </p>
    </div>
</div>

<script>
// Loader
document.getElementById('register-form').addEventListener('submit', () => {
    document.getElementById('register-loading').style.display = 'flex';
});

// Barra de fortaleza contraseña
const pwField = document.getElementById('password-field');
const segs = [document.getElementById('seg1'), document.getElementById('seg2'),
              document.getElementById('seg3'), document.getElementById('seg4')];

pwField.addEventListener('input', () => {
    const val = pwField.value;
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    segs.forEach((s, i) => {
        s.className = 'strength-seg';
        if (i < score) {
            if (score <= 1)      s.classList.add('active-weak');
            else if (score <= 3) s.classList.add('active-mid');
            else                 s.classList.add('active-strong');
        }
    });
});

// Partículas
const canvas = document.getElementById('reg-particles');
const ctx = canvas.getContext('2d');
function resize() { canvas.width = canvas.offsetWidth; canvas.height = canvas.offsetHeight; }
resize();
window.addEventListener('resize', resize);

const particles = Array.from({ length: 35 }, () => ({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height,
    r: Math.random() * 1.2 + 0.3,
    dx: (Math.random() - 0.5) * 0.35,
    dy: -Math.random() * 0.4 - 0.15,
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
        if (p.y < 0) p.y = canvas.height;
        if (p.x < 0) p.x = canvas.width;
        if (p.x > canvas.width) p.x = 0;
    });
    requestAnimationFrame(draw);
}
draw();
</script>

@endsection