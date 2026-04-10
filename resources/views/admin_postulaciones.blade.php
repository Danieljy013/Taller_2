@extends('layouts.app')

@section('title', 'Postulaciones')

@section('content')

<style>
.hero {
    padding: 6rem 4rem 2rem;
    text-align: center;
}

.hero h2 {
    font-size: 2.5rem;
    font-weight: 800;
}

/* CONTENEDOR */
.container {
    padding: 2rem 4rem 5rem;
    display: grid;
    gap: 20px;
}

/* CARD */
.card {
    background: #12121a;
    padding: 25px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.05);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

/* HEADER */
.card h3 {
    color: #c9a96e;
    margin-bottom: 10px;
}

/* GRID INFO */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 10px;
    margin-top: 15px;
}

/* TEXTOS */
p {
    font-size: 0.9rem;
    color: #ccc;
}

strong {
    color: #888;
}

/* BLOQUES LARGOS */
.block {
    margin-top: 15px;
    padding: 10px;
    background: #0a0a0f;
    border-radius: 8px;
}

/* VACÍO */
.empty {
    text-align: center;
    color: #666;
    margin-top: 30px;
}
</style>

<section class="hero">
    <h2>Postulaciones recibidas</h2>
</section>

<section class="container">

@if($postulaciones->isEmpty())
    <div class="empty">No hay postulaciones aún</div>
@else

@foreach($postulaciones as $p)
    <div class="card">
        
        <h3>{{ $p->nombre }} {{ $p->apellidos }}</h3>

        <div class="grid">
            <p><strong>Email:</strong> {{ $p->email }}</p>
            <p><strong>Edad:</strong> {{ $p->edad }}</p>
            <p><strong>Sexo:</strong> {{ $p->sexo }}</p>
            <p><strong>Teléfono:</strong> {{ $p->telefono }}</p>
            <p><strong>Departamento:</strong> {{ $p->departamento }}</p>
            <p><strong>Ciudad:</strong> {{ $p->ciudad }}</p>
            <p><strong>Cargo:</strong> {{ $p->cargo }}</p>
            <p><strong>Empresa:</strong> {{ $p->empresa }}</p>
            <p><strong>Ciudad empresa:</strong> {{ $p->ciudad_empresa }}</p>
            <p><strong>Experiencia:</strong> {{ $p->experiencia }}</p>
            <p><strong>Idiomas:</strong> {{ $p->idiomas }}</p>
        </div>

        <div class="block">
            <strong>Logros:</strong><br>
            {{ $p->logros }}
        </div>

        <div class="block">
            <strong>Motivación:</strong><br>
            {{ $p->motivacion }}
        </div>

    </div>
@endforeach

@endif

</section>

@endsection