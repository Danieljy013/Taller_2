@extends('layouts.app')

@section('title', 'Contacto - NexusPlay')

@section('content')

<style>
/* ── VARIABLES ── */
:root {
    --accent: #c9a96e;
    --dark-card: #0f0f18;
    --text-white: #f4f4f4; /* El blanco que pediste */
    --text-dim: #a8a8b8;
}

/* ── HERO ── */
.contact-hero {
    padding: 8rem 1.5rem 3rem;
    text-align: center;
    background: radial-gradient(circle at 50% 0%, rgba(201,169,110,0.08) 0%, transparent 70%);
}

.contact-hero h2 {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 4.5rem; /* Letra grande e imponente */
    letter-spacing: 5px;
    color: var(--text-white);
    margin-bottom: 1rem;
    line-height: 1;
}

.contact-hero p {
    font-family: 'Rajdhani', sans-serif;
    font-size: 1.2rem;
    color: var(--accent);
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: 600;
}

/* ── CONTENEDOR CENTRAL ── */
.contact-container {
    padding: 0 1.5rem 6rem;
    display: flex;
    justify-content: center;
}

/* ── CAJA DE FORMULARIO ── */
.form-box {
    background: var(--dark-card);
    padding: 40px;
    width: 100%;
    max-width: 550px;
    border: 1px solid rgba(201,169,110,0.15);
    border-top: 3px solid var(--accent);
    box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    animation: fadeUp 0.8s ease forwards;
}

/* ── ETIQUETAS Y GRUPOS ── */
.form-group {
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    font-family: 'Rajdhani', sans-serif;
    font-size: 1rem; /* Letra más grande */
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: var(--accent);
    margin-bottom: 8px;
}

/* ── INPUTS (Letras Blancas f4f4f4) ── */
.input {
    width: 100%;
    padding: 14px 18px;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.1);
    color: var(--text-white); /* Letra blanca f4f4f4 */
    font-family: 'Rajdhani', sans-serif;
    font-size: 1.1rem; /* Más legible */
    transition: all 0.3s ease;
}

.input:focus {
    outline: none;
    background: rgba(201,169,110,0.05);
    border-color: var(--accent);
    box-shadow: 0 0 15px rgba(201,169,110,0.1);
}

textarea.input {
    resize: none;
}

/* ── MENSAJES DE ESTADO ── */
.success {
    background: rgba(22, 163, 74, 0.1);
    border: 1px solid #16a34a;
    color: #4ade80;
    padding: 15px;
    font-family: 'Rajdhani', sans-serif;
    margin-bottom: 20px;
    font-weight: 600;
}

.errors {
    background: rgba(127, 29, 29, 0.1);
    border: 1px solid #ef4444;
    color: #f87171;
    padding: 15px;
    font-family: 'Rajdhani', sans-serif;
    margin-bottom: 20px;
}

.errors ul { list-style: none; }

/* ── BOTÓN PREMIUM ── */
.btn {
    width: 100%;
    padding: 16px;
    background: var(--accent);
    color: #0a0a0f;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.4rem;
    letter-spacing: 3px;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    text-transform: uppercase;
}

.btn:hover {
    background: #dbb97e;
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(201,169,110,0.3);
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
    .contact-hero h2 { font-size: 3rem; }
    .form-box { padding: 25px; }
}
</style>

<section class="contact-hero">
    <h2>Canal de Contacto</h2>
    <p>Soporte Técnico y Consultas Comerciales</p>
</section>

<section class="contact-container">
    
    <form method="POST" action="{{ route('contacto.store') }}" class="form-box">
        @csrf

        {{-- Éxito --}}
        @if(session('success'))
            <div class="success">
                ✓ {{ session('success') }}
            </div>
        @endif

        {{-- Errores --}}
        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>⚠ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label>Nombre de Usuario / Cliente</label>
            <input type="text" name="nombre" class="input" placeholder="Escribe tu nombre..." required>
        </div>

        <div class="form-group">
            <label>Dirección de Correo</label>
            <input type="email" name="email" class="input" placeholder="ejemplo@nexusplay.com" required>
        </div>

        <div class="form-group">
            <label>Mensaje / Detalles de la Consulta</label>
            <textarea name="mensaje" rows="5" class="input" placeholder="¿En qué podemos ayudarte?" required></textarea>
        </div>

        <button type="submit" class="btn">Transmitir Mensaje</button>

    </form>

</section>

@endsection