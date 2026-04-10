@extends('layouts.app')

@section('title', 'Trabaja con Nosotros')

@section('content')

<style>
.hero {
    padding: 6rem 4rem 3rem;
    text-align: center;
}

.hero h2 {
    font-size: 2.5rem;
    font-weight: 800;
}

.hero p {
    color: #888;
}

/* CONTENEDOR */
.form-container {
    padding: 2rem 4rem 5rem;
    max-width: 1100px;
    margin: auto;
}

/* TARJETAS */
.section {
    background: #12121a;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 35px;
    border: 1px solid rgba(255,255,255,0.05);
}

/* TÍTULOS */
h3 {
    margin-bottom: 25px;
    color: #c9a96e;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    padding-bottom: 8px;
}

/* GRID */
.grid-2, .grid-3 {
    display: grid;
    gap: 20px;
    margin-bottom: 10px;
}

.grid-2 { grid-template-columns: 1fr 1fr; }
.grid-3 { grid-template-columns: 1fr 1fr 1fr; }

/* INPUTS */
.input {
    width: 100%;
    padding: 12px 14px;
    border-radius: 8px;
    border: 1px solid #2a2a35;
    background: #0a0a0f;
    color: white;
    font-size: 14px;
    transition: 0.3s;
}

.input.small {
    padding: 10px;
    font-size: 13px;
}

.input:focus {
    outline: none;
    border-color: #c9a96e;
    box-shadow: 0 0 6px rgba(201,169,110,0.5);
}

/* TEXTAREA */
textarea.input {
    min-height: 100px;
    resize: vertical;
}

/* MENSAJE */
.success {
    background: #16a34a;
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 8px;
}

/* BOTÓN */
.btn {
    margin-top: 20px;
    padding: 14px 25px;
    background: #c9a96e;
    color: #0a0a0f;
    font-weight: 700;
    border: none;
    cursor: pointer;
    transition: 0.3s;
}

.btn:hover {
    background: #dbb97e;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .grid-2, .grid-3 {
        grid-template-columns: 1fr;
    }
}
</style>

<section class="hero">
    <h2>Únete a NexusPlay</h2>
    <p>Buscamos talento apasionado por los videojuegos 🎮</p>
</section>

<section class="form-container">

@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('ofertas.store') }}" method="POST">
@csrf

<!-- DATOS PERSONALES -->
<div class="section">
    <h3>Datos Personales</h3>

    <div class="grid-3">
        <input type="text" name="nombre" placeholder="Nombre" class="input" required>
        <input type="text" name="apellidos" placeholder="Apellidos" class="input" required>
        <input type="number" name="edad" placeholder="Edad" class="input small">
    </div>

    <div class="grid-3">
        <select name="sexo" class="input small">
            <option value="">Sexo</option>
            <option>Masculino</option>
            <option>Femenino</option>
            <option>Otro</option>
        </select>

        <input type="email" name="email" placeholder="Correo electrónico" class="input">
        <input type="text" name="telefono" placeholder="Teléfono" class="input">
    </div>

    <div class="grid-2">
        <input type="text" name="departamento" placeholder="Departamento" class="input">
        <input type="text" name="ciudad" placeholder="Ciudad" class="input">
    </div>
</div>

<!-- PERFIL -->
<div class="section">
    <h3>Perfil Profesional</h3>

    <div class="grid-2">
        <input type="text" name="cargo" placeholder="Cargo anterior" class="input">
        <input type="text" name="empresa" placeholder="Empresa donde trabajaba" class="input">
    </div>

    <div class="grid-2">
        <input type="text" name="ciudad_empresa" placeholder="Ciudad de la empresa" class="input">
        <select name="experiencia" class="input small">
            <option value="">Años de experiencia</option>
            <option>Sin experiencia</option>
            <option>1-2 años</option>
            <option>3-5 años</option>
            <option>Más de 5 años</option>
        </select>
    </div>

    <textarea name="logros" placeholder="Describe tus logros laborales..." class="input"></textarea>
</div>

<!-- IDIOMAS -->
<div class="section">
    <h3>Idiomas</h3>

    <select name="idiomas" class="input small">
        <option value="">Selecciona un idioma principal</option>
        <option>Español</option>
        <option>Inglés</option>
        <option>Francés</option>
        <option>Japonés</option>
        <option>Portugués</option>
        <option>Otros</option>
    </select>
</div>

<!-- MOTIVACIÓN -->
<div class="section">
    <h3>Motivación</h3>

    <textarea name="motivacion" placeholder="¿Por qué quieres trabajar en NexusPlay?" class="input"></textarea>
</div>

<!-- CV -->
<div class="section">
    <h3>Adjuntar CV (opcional)</h3>

    <input type="file" class="input small">

    <small style="color: #666;">
        * Este campo es solo ilustrativo (no se guardará).
    </small>
</div>

<button type="submit" class="btn">Enviar solicitud</button>

</form>

</section>

@endsection