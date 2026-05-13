@extends('layouts.app')

@section('title', 'Postulaciones - NexusPlay Admin')

@section('content')
<style>
/* ── HERO ── */
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

/* ── CONTENEDOR ── */
.postulaciones-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 4rem 5rem;
}

/* ── OVERRIDE DATATABLES ── */

/* Wrapper general */
.dt-container {
    background: transparent !important;
    border: none !important;
    padding: 0 !important;
    color: var(--text-secondary) !important;
}

/* Barra superior: search */
.dt-layout-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.2rem !important;
    flex-wrap: wrap;
    gap: 0.75rem;
}

/* Input de búsqueda */
.dt-search {
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
.dt-search label {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--text-muted);
}
.dt-search input {
    background: #151520 !important;
    border: 1px solid rgba(201,169,110,0.3) !important;
    color: #e8e8f0 !important;
    padding: 8px 14px !important;
    font-family: 'Rajdhani', sans-serif !important;
    font-size: 0.9rem !important;
    outline: none !important;
    transition: border-color 0.25s !important;
    border-radius: 0 !important;
    width: 260px !important;
}
.dt-search input:focus {
    border-color: var(--accent) !important;
}
.dt-search input::placeholder {
    color: var(--text-muted) !important;
}

/* Info (mostrando X de Y) */
.dt-info {
    font-family: 'Rajdhani', sans-serif !important;
    font-size: 0.82rem !important;
    color: var(--text-muted) !important;
    letter-spacing: 0.3px !important;
}

/* Paginación */
.dt-paging {
    display: flex;
    gap: 4px;
}
.dt-paging .dt-paging-button {
    background: rgb(255, 255, 255) !important;
    border: 1px solid rgb(255, 255, 255) !important;
    color: rgb(0,0,0) !important;
    font-family: 'Rajdhani', sans-serif !important;
    font-size: 0.82rem !important;
    font-weight: 600 !important;
    padding: 6px 14px !important;
    cursor: pointer !important;
    transition: all 0.2s !important;
    border-radius: 0 !important;
}
.dt-paging .dt-paging-button:hover:not(.disabled) {
    background: rgba(201,169,110,0.1) !important;
    border-color: rgba(201,169,110,0.3) !important;
    color: var(--accent) !important;
}
.dt-paging .dt-paging-button.current {
    background: var(--accent) !important;
    border-color: var(--accent) !important;
    color: #0a0a0f !important;
}
.dt-paging .dt-paging-button.disabled {
    opacity: 0.3 !important;
    cursor: default !important;
}

/* Tabla base: oculta, solo DataTables la usa para indexar */
#postulaciones-table {
    width: 100% !important;
}
#postulaciones-table thead,
#postulaciones-table tbody tr td {
    /* La columna visible (index 0) la manejamos con cards */
}

/* ── CARDS ── */
.postulacion-card {
    background: var(--dark-card, #0f0f18);
    border: 1px solid rgba(255,255,255,0.05);
    margin-bottom: 1.2rem;
    transition: transform 0.3s ease, border-color 0.3s ease;
}
.postulacion-card:hover {
    border-color: rgba(201,169,110,0.3);
    transform: translateY(-3px);
}
.card-top {
    padding: 1.2rem 1.5rem;
    border-bottom: 1px solid rgba(255,255,255,0.04);
    background: rgba(201,169,110,0.025);
}
.card-top h3 {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.7rem;
    color: var(--accent);
    letter-spacing: 2px;
    margin: 0;
}
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
    padding: 1.2rem 1.5rem;
}
.info-item { display: flex; flex-direction: column; gap: 2px; }
.info-label {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #e8e8f0;
}
.info-value {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.98rem;
    font-weight: 600;
    color: var(--accent);
}
.text-blocks { padding: 0 1.5rem 1.5rem; }
.block-item {
    background: rgba(0,0,0,0.3);
    border: 1px solid rgba(255,255,255,0.04);
    padding: 1rem;
}
.block-title {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.72rem;
    color: var(--accent);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
}
.block-content {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.95rem;
    color: var(--text-secondary);
    line-height: 1.55;
}

/* La celda que DataTables genera debe ser invisible de estructura */
#postulaciones-table td {
    padding: 0 !important;
    border: none !important;
    background: transparent !important;
    vertical-align: top;
}
/* Ocultar columnas auxiliares de búsqueda */
#postulaciones-table td:not(:first-child),
#postulaciones-table th:not(:first-child) {
    display: none;
}

/* Empty state */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    font-family: 'Rajdhani', sans-serif;
    color: var(--text-muted);
    font-size: 1rem;
    letter-spacing: 1px;
    text-transform: uppercase;
}

@media (max-width: 768px) {
    .admin-hero { padding: 5rem 1.5rem 1rem; }
    .postulaciones-container { padding: 1rem 1.5rem 4rem; }
    .dt-search input { width: 100% !important; }
}
</style>

<section class="admin-hero">
    <div class="admin-header">
        <p>Panel de Administración</p>
        <h2>Postulaciones Recibidas</h2>
    </div>
</section>

<section class="postulaciones-container">

    @if($postulaciones->isEmpty())
        <div class="empty-state">
            <p>No se han detectado nuevas postulaciones en la base de datos</p>
        </div>
    @else
        {{--
            ESTRUCTURA DE LA TABLA:
            - Columna 0 (visible): renderiza el HTML de la card completa
            - Columnas 1..N (ocultas): texto plano que DataTables usa para búsqueda y orden
            Esto permite buscar por nombre, email, cargo, etc. sin romper el diseño visual.
        --}}
        <table id="postulaciones-table">
            <thead>
                <tr>
                    <th>Card</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Cargo</th>
                    <th>Ciudad</th>
                    <th>Experiencia</th>
                    <th>Motivacion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($postulaciones as $p)
                <tr>
                    {{-- Columna 0: card visual completa --}}
                    <td>
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
                                    <span class="info-value">{{ $p->cargo }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Experiencia</span>
                                    <span class="info-value">{{ $p->experiencia }} años</span>
                                </div>
                            </div>
                            <div class="text-blocks">
                                <div class="block-item">
                                    <div class="block-title">Motivación y Objetivos</div>
                                    <div class="block-content">{{ $p->motivacion }}</div>
                                </div>
                            </div>
                        </div>
                    </td>
                    {{-- Columnas ocultas: texto plano para que DataTables pueda buscar --}}
                    <td>{{ $p->nombre }} {{ $p->apellidos }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->cargo }}</td>
                    <td>{{ $p->ciudad }} {{ $p->departamento }}</td>
                    <td>{{ $p->experiencia }}</td>
                    <td>{{ $p->motivacion }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</section>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    var table = new DataTable('#postulaciones-table', {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json'
        },
        pageLength: 5,
        autoWidth: false,

        // Columnas: la 0 es visible y NO ordenable (es HTML); el resto son ocultas pero buscables
        columnDefs: [
            {
                targets: 0,
                orderable: false,
                searchable: false   // La búsqueda usa las columnas de texto plano (1-6)
            },
            {
                targets: [1, 2, 3, 4, 5, 6],
                visible: false,     // Ocultas visualmente
                searchable: true    // Pero buscables por DataTables
            }
        ],

        // Layout personalizado
        layout: {
            topStart: 'search',
            topEnd: null,
            bottomStart: 'info',
            bottomEnd: 'paging'
        },

        // Eliminar clases de DataTables que rompen el estilo de cards
        drawCallback: function () {
            // Quitar estilos de striping y hover nativos de DataTables
            $('#postulaciones-table tbody tr').css({
                'background': 'transparent',
                'border': 'none'
            });
        }
    });
});
</script>
@endsection