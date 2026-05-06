@extends('layouts.app')

@section('title', 'Postulaciones - NexusPlay Admin')

@section('content')

<style>
/* ── VARIABLES & RESET ── */
:root {
    --accent: #c9a96e;
    --accent-dim: rgba(201,169,110,0.1);
    --dark-card: #0f0f18;
    --text-primary: #ffffff;
    --text-secondary: #a8a8b8;
    --text-muted: #6b6b80;
}

/* ── HERO SECCIÓN ── */
.admin-hero {
    padding: 6rem 4rem 2rem;
    background: radial-gradient(circle at 50% 0%, rgba(201,169,110,0.05) 0%, transparent 70%);
}

.admin-header {
    max-width: 1200px;
    margin: 0 auto;
    border-left: 4px solid var(--accent);
    padding-left: 1.5rem;
}

.admin-header h2 {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 3.5rem;
    letter-spacing: 4px;
    color: var(--text-primary);
    line-height: 1;
}

.admin-header p {
    font-family: 'Rajdhani', sans-serif;
    color: var(--accent);
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: 600;
}

/* ── CONTENEDOR DE POSTULACIONES ── */
.postulaciones-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 4rem 5rem;
    display: grid;
    gap: 2rem;
}

/* ── CARD ESTILO NEXUS ── */
.postulacion-card {
    background: var(--dark-card);
    border: 1px solid rgba(255,255,255,0.05);
    position: relative;
    overflow: hidden;
    transition: transform 0.3s, border-color 0.3s;
}

.postulacion-card:hover {
    border-color: rgba(201,169,110,0.3);
    transform: translateY(-5px);
}

/* Indicador de ID lateral */
.postulacion-card::after {
    content: 'DATA_FILE';
    position: absolute;
    top: 10px;
    right: 10px;
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.6rem;
    color: var(--text-muted);
    letter-spacing: 2px;
}

.card-top {
    padding: 1.5rem;
    border-bottom: 1px solid rgba(255,255,255,0.03);
    background: rgba(201,169,110,0.02);
}

.card-top h3 {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.8rem;
    color: var(--accent);
    letter-spacing: 2px;
}

/* ── GRID DE INFORMACIÓN ── */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    padding: 1.5rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.2rem;
}

.info-label {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.90m;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #f4f4f4;
}

.info-value {
    font-family: 'Rajdhani', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    color: #c9a96e;
}

/* ── BLOQUES DE TEXTO LARGO ── */
.text-blocks {
    padding: 0 1.5rem 1.5rem;
    display: grid;
    gap: 1rem;
}

.block-item {
    background: rgba(0,0,0,0.3);
    border: 1px solid rgba(255,255,255,0.03);
    padding: 1rem;
}

.block-title {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.75rem;
    color: var(--accent);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.block-title::before {
    content: '>>';
    font-size: 0.6rem;
}

.block-content {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.95rem;
    color: var(--text-secondary);
    line-height: 1.5;
}

/* ── EMPTY STATE ── */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 5rem;
    border: 2px dashed rgba(201,169,110,0.1);
}

.empty-state p {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2rem;
    color: var(--text-muted);
    letter-spacing: 2px;
}

@media (max-width: 768px) {
    .admin-hero { padding: 5rem 1.5rem 1rem; }
    .postulaciones-container { padding: 1rem 1.5rem 5rem; }
}
</style>

<section class="admin-hero">
    <div class="admin-header">
        <p>Panel de Administración</p>
        <h2>Postulaciones Recibidas</h2>
    </div>
</section>

<section class="postulaciones-container">

    @forelse($postulaciones as $p)
        <div class="postulacion-card">
            <div class="card-top">
                <h3>{{ $p->nombre }} {{ $p->apellidos }}</h3>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Correo Electrónico</span>
                    <span class="info-value">{{ $p->email }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Teléfono</span>
                    <span class="info-value">{{ $p->telefono }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Ubicación</span>
                    <span class="info-value">{{ $p->ciudad }}, {{ $p->departamento }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Cargo Postulado</span>
                    <span class="info-value" style="color: var(--accent);">{{ $p->cargo }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Experiencia</span>
                    <span class="info-value">{{ $p->experiencia }} años</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Edad / Sexo</span>
                    <span class="info-value">{{ $p->edad }} años / {{ $p->sexo }}</span>
                </div>
            </div>

            <div class="text-blocks">
                <div class="block-item">
                    <div class="block-title">Logros Profesionales</div>
                    <div class="block-content">{{ $p->logros }}</div>
                </div>

                <div class="block-item">
                    <div class="block-title">Motivación y Objetivos</div>
                    <div class="block-content">{{ $p->motivacion }}</div>
                </div>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <p>No se han detectado nuevas postulaciones en la base de datos</p>
        </div>
    @endforelse

</section>

@endsection