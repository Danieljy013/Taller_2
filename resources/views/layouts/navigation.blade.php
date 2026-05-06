<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

        <div class="flex gap-6">
            <a href="{{ route('inicio') }}">Inicio</a>
            <a href="{{ route('juegos') }}">Juegos</a>
            <a href="{{ route('contacto') }}">Contacto</a>
            <a href="{{ route('ofertas') }}">Ofertas</a>
        </div>

        <div class="flex gap-4 items-center">
            @auth
                <span>{{ auth()->user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Cerrar sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}">Iniciar sesión</a>
                <a href="{{ route('register') }}">Registrarse</a>
            @endauth
        </div>
    </div>
</nav>