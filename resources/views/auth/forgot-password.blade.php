@extends('layouts.app')

@section('title', 'Recuperar Contraseña - NexusPlay')

@section('content')

<style>
/* Reutilizamos las variables del sistema */
:root {
    --accent:      #c9a96e;
    --accent-dim:  rgba(201,169,110,0.1);
    --accent-line: rgba(201,169,110,0.22);
    --dark:        #0a0a0f;
    --text-primary:   #e8e8f0;
    --text-secondary: #a8a8b8;
    --text-muted:     #6b6b80;
}

.auth-hero { 
    margin-top: -70px; 
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
    background: var(--dark);
    overflow: hidden;
}

/* ── PANEL IZQUIERDO ── */
.auth-left {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    padding: 5rem;
    background: #08080e;
}

.auth-left-bg {
    position: absolute;
    inset: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(201,169,110,0.1) 0%, transparent 50%);
}

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
    margin-bottom: 2rem;
    position: relative;
}

.auth-brand {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 4.5rem;
    line-height: 0.9;
    letter-spacing: 4px;
    color: var(--text-primary);
    position: relative;
}

.auth-brand span {
    display: block;
    -webkit-text-stroke: 1px var(--accent);
    color: transparent;
}

/* ── PANEL DERECHO ── */
.auth-right {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3rem;
    position: relative;
    background: var(--dark);
}

.auth-right::before {
    content: '';
    position: absolute;
    left: 0; top: 15%; bottom: 15%;
    width: 1px;
    background: linear-gradient(to bottom, transparent, rgba(201,169,110,0.2), transparent);
}

.auth-card {
    width: 100%;
    max-width: 400px;
    animation: fadeUp 0.8s ease forwards;
}

.card-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 3rem;
    letter-spacing: 2px;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.card-desc {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.95rem;
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 2rem;
}

/* ── INPUTS ── */
.input-group { margin-bottom: 1.5rem; }

.input-label {
    display: block;
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--accent);
    margin-bottom: 0.5rem;
}

.login-input {
    width: 100%;
    padding: 0.95rem 1rem;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.07);
    border-bottom: 2px solid rgba(255,255,255,0.07);
    color: var(--text-primary);
    font-family: 'Rajdhani', sans-serif;
    font-size: 1rem;
    transition: all 0.3s;
}

.login-input:focus {
    outline: none;
    border-bottom-color: var(--accent);
    background: rgba(201,169,110,0.05);
}

/* ── BOTÓN ── */
.auth-btn {
    width: 100%;
    padding: 1rem;
    background: var(--accent);
    border: none;
    color: #0a0a0f;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.1rem;
    letter-spacing: 3px;
    cursor: pointer;
    transition: 0.3s;
    margin-bottom: 1.5rem;
}

.auth-btn:hover {
    background: #dbb97e;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(201,169,110,0.25);
}

/* ── STATUS & ERRORS ── */
.status-msg {
    padding: 1rem;
    background: rgba(201,169,110,0.1);
    border: 1px solid var(--accent);
    color: var(--accent);
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.85rem;
    margin-bottom: 1.5rem;
}

.error-msg {
    color: #ff6b6b;
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.8rem;
    margin-top: 0.5rem;
    display: block;
}

.back-link {
    display: block;
    text-align: center;
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.85rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: color 0.2s;
}

.back-link:hover { color: var(--accent); }

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
    .auth-left { display: none; }
    .auth-hero { grid-template-columns: 1fr; }
}
</style>

<section class="auth-hero">
    
    {{-- PANEL IZQUIERDO --}}
    <div class="auth-left">
        <div class="auth-left-bg"></div>
        <div class="left-badge">Security Protocol</div>
        <div class="auth-brand">
            RECUPERAR<span>ACCESO</span>
        </div>
    </div>

    {{-- PANEL DERECHO --}}
    <div class="auth-right">
        <div class="auth-card">
            <h1 class="card-title">¿Olvidaste tu clave?</h1>
            <p class="card-desc">
                No hay problema. Introduce tu correo electrónico y te enviaremos un enlace para restablecerla y elegir una nueva.
            </p>

            <!-- Estado de la sesión (Éxito) -->
            @if (session('status'))
                <div class="status-msg">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="input-group">
                    <label for="email" class="input-label">Correo Electrónico</label>
                    <input id="email" class="login-input" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="tu@email.com" />
                    
                    @if ($errors->has('email'))
                        <span class="error-msg">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <button type="submit" class="auth-btn">
                    ENVIAR ENLACE DE RESTABLECIMIENTO
                </button>

                <a href="{{ route('login') }}" class="back-link">
                    Volver al inicio de sesión
                </a>
            </form>
        </div>
    </div>
</section>

@endsection