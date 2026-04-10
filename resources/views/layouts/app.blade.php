<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NexusPlay')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: #0a0a0f; color: #e8e8f0; }
        a { text-decoration: none; color: inherit; }

        /* ───── NAVBAR ───── */
        .navbar {
            width: 100%;
            padding: 0 4rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
            background: rgba(10, 10, 15, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            position: fixed;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            transition: background 0.3s;
        }
        .navbar.scrolled {
            background: rgba(10, 10, 15, 0.97);
            border-bottom-color: rgba(201,169,110,0.08);
        }

        .logo {
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        .logo span { color: #c9a96e; }
        .logo:hover { opacity: 0.85; }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            align-items: center;
        }
        .nav-links a {
            font-size: 0.78rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #666;
            transition: color 0.25s;
            position: relative;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 1px;
            background: #c9a96e;
            transition: width 0.3s;
        }
        .nav-links a:hover { color: #e8e8f0; }
        .nav-links a:hover::after { width: 100%; }
        .nav-links a.active { color: #c9a96e; }
        .nav-links a.active::after { width: 100%; }

        .nav-cta {
            padding: 0.55rem 1.4rem;
            background: #c9a96e;
            color: #0a0a0f !important;
            font-weight: 700;
            font-size: 0.72rem !important;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: background 0.25s, transform 0.2s !important;
        }
        .nav-cta::after { display: none !important; }
        .nav-cta:hover { background: #dbb97e !important; color: #0a0a0f !important; transform: translateY(-1px) !important; }

        /* ───── MAIN ───── */
        main { margin-top: 70px; }

        /* ───── FOOTER ───── */
        .footer {
            background: #0d0d15;
            border-top: 1px solid rgba(255,255,255,0.04);
        }
        .footer-top {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 3rem;
            padding: 4rem 4rem 3rem;
        }
        .footer-brand {}
        .footer-logo {
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }
        .footer-logo span { color: #c9a96e; }
        .footer-tagline {
            font-size: 0.82rem;
            color: #555;
            line-height: 1.7;
            max-width: 220px;
        }
        .footer-socials {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }
        .social-btn {
            width: 34px;
            height: 34px;
            border: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            color: #555;
            transition: 0.25s;
        }
        .social-btn:hover {
            border-color: rgba(201,169,110,0.4);
            color: #c9a96e;
        }

        .footer-col h4 {
            font-size: 0.68rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #c9a96e;
            margin-bottom: 1.2rem;
        }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 0.6rem; }
        .footer-col ul li a {
            font-size: 0.82rem;
            color: #555;
            transition: color 0.2s;
        }
        .footer-col ul li a:hover { color: #ccc; }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.04);
            padding: 1.5rem 4rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-bottom p {
            font-size: 0.75rem;
            color: #444;
        }
        .footer-bottom-links {
            display: flex;
            gap: 2rem;
        }
        .footer-bottom-links a {
            font-size: 0.72rem;
            color: #444;
            letter-spacing: 1px;
            transition: color 0.2s;
        }
        .footer-bottom-links a:hover { color: #888; }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <header class="navbar" id="navbar">
        <a href="{{ route('inicio') }}" class="logo">Nexus<span>Play</span></a>

        <nav class="nav-links">
            <a href="{{ route('inicio') }}" class="{{ request()->routeIs('inicio') ? 'active' : '' }}">Inicio</a>
            <a href="{{ route('juegos') }}" class="{{ request()->routeIs('juegos*') ? 'active' : '' }}">Catálogo</a>
            <a href="{{ route('ofertas') }}" class="{{ request()->routeIs('ofertas') ? 'active' : '' }}">Ofertas</a>
            <a href="{{ route('contacto') }}" class="{{ request()->routeIs('contacto') ? 'active' : '' }}">Contacto</a>
            <a href="{{ route('ofertas') }}" class="nav-cta">Ver ofertas</a>
        </nav>
    </header>

    {{-- CONTENIDO DINÁMICO --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="footer-top">
            <div class="footer-brand">
                <div class="footer-logo">Nexus<span>Play</span></div>
                <p class="footer-tagline">Tu tienda de videojuegos de confianza. Los mejores títulos al mejor precio.</p>
                <div class="footer-socials">
                    <a href="#" class="social-btn">𝕏</a>
                    <a href="#" class="social-btn">in</a>
                    <a href="#" class="social-btn">ig</a>
                    <a href="#" class="social-btn">yt</a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Catálogo</h4>
                <ul>
                    <li><a href="{{ route('juegos') }}">Todos los juegos</a></li>
                    <li><a href="{{ route('ofertas') }}">Ofertas</a></li>
                    <li><a href="#">Novedades</a></li>
                    <li><a href="#">Más vendidos</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Categorías</h4>
                <ul>
                    <li><a href="#">Acción / RPG</a></li>
                    <li><a href="#">Shooter</a></li>
                    <li><a href="#">Estrategia</a></li>
                    <li><a href="#">Aventura</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Soporte</h4>
                <ul>
                    <li><a href="{{ route('contacto') }}">Contacto</a></li>
                    <li><a href="#">Preguntas frecuentes</a></li>
                    <li><a href="#">Política de devoluciones</a></li>
                    <li><a href="#">Términos y condiciones</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© {{ date('Y') }} NexusPlay — Todos los derechos reservados</p>
            <div class="footer-bottom-links">
                <a href="#">Privacidad</a>
                <a href="#">Términos</a>
                <a href="{{ route('admin.postulaciones') }}">Admin</a>
            </div>
        </div>
    </footer>

    <script>
        // Navbar se oscurece al hacer scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
</body>
</html>