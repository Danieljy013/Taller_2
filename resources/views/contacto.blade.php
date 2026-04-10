@extends('layouts.app')

@section('title', 'Contacto')

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
.contact-container {
    padding: 2rem 4rem 5rem;
    display: flex;
    justify-content: center;
}

/* FORMULARIO */
.form-box {
    background: #12121a;
    padding: 30px;
    border-radius: 12px;
    width: 100%;
    max-width: 500px;
    border: 1px solid rgba(255,255,255,0.05);
}

/* CAMPOS */
.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-size: 0.9rem;
    color: #aaa;
}

.input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #2a2a35;
    background: #0a0a0f;
    color: white;
    transition: 0.3s;
}

.input:focus {
    outline: none;
    border-color: #c9a96e;
    box-shadow: 0 0 6px rgba(201,169,110,0.5);
}

/* MENSAJES */
.success {
    background: #16a34a;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
}

.errors {
    background: #7f1d1d;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
}

/* BOTÓN */
.btn {
    width: 100%;
    padding: 12px;
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
</style>

<section class="hero">
    <h2>Contáctanos</h2>
    <p>¿Tienes dudas? Escríbenos y te responderemos pronto</p>
</section>

<section class="contact-container">
    
    <form method="POST" action="{{ route('contacto.store') }}" class="form-box">
        
        @csrf

        {{-- Éxito --}}
        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Errores --}}
        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="input" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="input" required>
        </div>

        <div class="form-group">
            <label>Mensaje</label>
            <textarea name="mensaje" rows="4" class="input" required></textarea>
        </div>

        <button type="submit" class="btn">Enviar mensaje</button>

    </form>

</section>

@endsection