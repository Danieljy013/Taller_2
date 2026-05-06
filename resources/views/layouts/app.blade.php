    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'NexusPlay')</title>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;500;600;700&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
            body { background: #0a0a0f; color: #e8e8f0; }
            a { text-decoration: none; color: inherit; }

            :root {
                --accent:      #c9a96e;
                --accent-dim:  rgba(201,169,110,0.1);
                --accent-line: rgba(201,169,110,0.2);
                --text-primary:   #e8e8f0;
                --text-secondary: #a8a8b8;
                --text-muted:     #6b6b80;
            }

            /* ───── NAVBAR ───── */
            .navbar {
                width: 100%;
                padding: 0 4rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                height: 70px;
                background: rgba(10,10,15,0.85);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                position: fixed;
                top: 0;
                z-index: 1000;
                border-bottom: 1px solid rgba(255,255,255,0.04);
                transition: background 0.3s, border-color 0.3s;
            }

            .navbar.scrolled {
                background: rgba(10,10,15,0.97);
                border-bottom-color: rgba(201,169,110,0.08);
            }

            .logo {
                font-size: 1.2rem;
                font-weight: 800;
                letter-spacing: 3px;
                text-transform: uppercase;
                transition: opacity 0.2s;
            }
            .logo span { color: var(--accent); }
            .logo:hover { opacity: 0.82; }

            .nav-links {
                display: flex;
                gap: 2.5rem;
                align-items: center;
            }

            .nav-links a {
                font-size: 0.78rem;
                letter-spacing: 1.5px;
                text-transform: uppercase;
                color: var(--text-secondary);
                transition: color 0.25s;
                position: relative;
            }

            .nav-links a::after {
                content: '';
                position: absolute;
                bottom: -4px; left: 0;
                width: 0; height: 1px;
                background: var(--accent);
                transition: width 0.3s;
            }

            .nav-links a:hover           { color: var(--text-primary); }
            .nav-links a:hover::after    { width: 100%; }
            .nav-links a.active          { color: var(--accent); }
            .nav-links a.active::after   { width: 100%; }

            .nav-cta {
                padding: 0.55rem 1.4rem;
                background: var(--accent);
                color: #0a0a0f !important;
                font-weight: 700;
                font-size: 0.72rem !important;
                letter-spacing: 2px;
                text-transform: uppercase;
                transition: background 0.25s, transform 0.2s !important;
            }
            .nav-cta::after  { display: none !important; }
            .nav-cta:hover   { background: #dbb97e !important; color: #0a0a0f !important; transform: translateY(-1px) !important; }

            /* ───── USER MENU ───── */
            .user-menu-wrap {
                position: relative;
            }

            /* Botón disparador */
            .user-trigger {
                display: flex;
                align-items: center;
                gap: 0.6rem;
                cursor: pointer;
                padding: 0.35rem 0.7rem 0.35rem 0.35rem;
                border: 1px solid rgba(201,169,110,0.15);
                background: rgba(201,169,110,0.04);
                transition: border-color 0.25s, background 0.25s;
                user-select: none;
            }

            .user-trigger:hover,
            .user-trigger.open {
                border-color: rgba(201,169,110,0.35);
                background: rgba(201,169,110,0.08);
            }

            /* Avatar con iniciales */
            .user-avatar {
                width: 30px; height: 30px;
                background: var(--accent);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Bebas Neue', sans-serif;
                font-size: 0.85rem;
                letter-spacing: 1px;
                color: #0a0a0f;
                flex-shrink: 0;
            }

            .user-name {
                font-size: 0.75rem;
                font-weight: 600;
                letter-spacing: 0.5px;
                color: var(--text-primary);
                max-width: 120px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            /* Chevron animado */
            .user-chevron {
                width: 14px; height: 14px;
                color: var(--text-muted);
                transition: transform 0.25s, color 0.25s;
                flex-shrink: 0;
            }

            .user-trigger.open .user-chevron {
                transform: rotate(180deg);
                color: var(--accent);
            }

            /* ── Dropdown ── */
            .user-dropdown {
                position: absolute;
                top: calc(100% + 10px);
                right: 0;
                width: 220px;
                background: #0f0f18;
                border: 1px solid rgba(201,169,110,0.15);
                border-top: 2px solid var(--accent);
                padding: 0.5rem 0;
                opacity: 0;
                visibility: hidden;
                transform: translateY(-8px);
                transition: opacity 0.22s ease, transform 0.22s ease, visibility 0.22s;
                z-index: 999;
            }

            .user-dropdown.open {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            /* Cabecera del dropdown */
            .dd-header {
                padding: 0.9rem 1.2rem 0.75rem;
                border-bottom: 1px solid rgba(255,255,255,0.05);
                margin-bottom: 0.4rem;
            }

            .dd-header-name {
                font-size: 0.88rem;
                font-weight: 700;
                color: var(--text-primary);
                letter-spacing: 0.3px;
            }

            .dd-header-email {
                font-size: 0.72rem;
                color: var(--text-muted);
                letter-spacing: 0.3px;
                margin-top: 2px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            /* Items del dropdown */
            .dd-item {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.65rem 1.2rem;
                font-size: 0.8rem;
                font-weight: 500;
                color: var(--text-secondary);
                letter-spacing: 0.3px;
                transition: background 0.18s, color 0.18s;
                cursor: pointer;
            }

            .dd-item:hover {
                background: rgba(201,169,110,0.06);
                color: var(--text-primary);
            }

            .dd-item svg {
                width: 14px; height: 14px;
                opacity: 0.6;
                flex-shrink: 0;
                transition: opacity 0.18s;
            }

            .dd-item:hover svg { opacity: 1; }

            /* Separador */
            .dd-sep {
                height: 1px;
                background: rgba(255,255,255,0.05);
                margin: 0.4rem 0;
            }

            /* Item de salir (rojo) */
            .dd-item.danger       { color: #e87070; }
            .dd-item.danger:hover { background: rgba(232,112,112,0.07); color: #f08080; }
            .dd-item.danger svg   { opacity: 0.7; }

            /* Botón logout invisible dentro del item */
            .dd-logout-form {
                width: 100%;
                margin: 0; padding: 0;
            }

            .dd-logout-btn {
                width: 100%;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.65rem 1.2rem;
                background: none;
                border: none;
                font-family: inherit;
                font-size: 0.8rem;
                font-weight: 500;
                color: #e87070;
                letter-spacing: 0.3px;
                cursor: pointer;
                transition: background 0.18s, color 0.18s;
                text-align: left;
            }

            .dd-logout-btn svg {
                width: 14px; height: 14px;
                opacity: 0.7;
                flex-shrink: 0;
            }

            .dd-logout-btn:hover {
                background: rgba(232,112,112,0.07);
                color: #f08080;
            }

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

            .footer-logo {
                font-size: 1.1rem;
                font-weight: 800;
                letter-spacing: 3px;
                text-transform: uppercase;
                margin-bottom: 1rem;
            }
            .footer-logo span { color: var(--accent); }

            .footer-tagline {
                font-size: 0.82rem;
                color: var(--text-secondary);
                line-height: 1.75;
                max-width: 220px;
            }

            .footer-socials {
                display: flex;
                gap: 0.75rem;
                margin-top: 1.5rem;
            }

            .social-btn {
                width: 34px; height: 34px;
                border: 1px solid rgba(255,255,255,0.08);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.75rem;
                color: var(--text-muted);
                transition: border-color 0.25s, color 0.25s;
            }

            .social-btn:hover {
                border-color: rgba(201,169,110,0.4);
                color: var(--accent);
            }

            .footer-col h4 {
                font-size: 0.7rem;
                letter-spacing: 3px;
                text-transform: uppercase;
                color: var(--accent);
                margin-bottom: 1.2rem;
            }

            .footer-col ul {
                list-style: none;
                display: flex;
                flex-direction: column;
                gap: 0.65rem;
            }

            .footer-col ul li a {
                font-size: 0.83rem;
                color: var(--text-secondary);
                transition: color 0.2s;
            }

            .footer-col ul li a:hover { color: var(--text-primary); }

            .footer-bottom {
                border-top: 1px solid rgba(255,255,255,0.04);
                padding: 1.5rem 4rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .footer-bottom p {
                font-size: 0.75rem;
                color: var(--text-muted);
            }

            .footer-bottom-links {
                display: flex;
                gap: 2rem;
            }

            .footer-bottom-links a {
                font-size: 0.72rem;
                color: var(--text-muted);
                letter-spacing: 1px;
                transition: color 0.2s;
            }

            .footer-bottom-links a:hover { color: var(--text-secondary); }

            /* ───── RESPONSIVE ───── */
            @media (max-width: 768px) {
                .navbar { padding: 0 1.5rem; }
                .nav-links { gap: 1.2rem; }
                .user-name { display: none; }
                .footer-top { grid-template-columns: 1fr 1fr; padding: 2.5rem 2rem; }
                .footer-bottom { padding: 1.2rem 2rem; flex-direction: column; gap: 0.8rem; text-align: center; }
            }
        </style>
    </head>
    <body>

        {{-- ══ NAVBAR ══ --}}
        <header class="navbar" id="navbar">
            <a href="{{ route('inicio') }}" class="logo">Nexus<span>Play</span></a>

            <nav class="nav-links">
                <a href="{{ route('inicio') }}"   class="{{ request()->routeIs('inicio')    ? 'active' : '' }}">Inicio</a>
                <a href="{{ route('juegos') }}"   class="{{ request()->routeIs('juegos*')   ? 'active' : '' }}">Catálogo</a>
                <a href="{{ route('ofertas') }}"  class="{{ request()->routeIs('ofertas')   ? 'active' : '' }}">Ofertas</a>
                <a href="{{ route('contacto') }}" class="{{ request()->routeIs('contacto')  ? 'active' : '' }}">Contacto</a>
                <a href="{{ route('admin.postulaciones') }}" class="nav-cta {{ request()->routeIs('admin.postulaciones') ? 'active' : '' }}">Ver ofertas</a>

                {{-- Solo si NO está logueado --}}
                @guest
                    <a href="{{ route('login') }}" class="nav-cta">Login</a>
                @endguest

                {{-- Solo si ESTÁ logueado --}}
                @auth
                    {{--
                        Capitalización de nombre:
                        Si el campo 'name' tiene un solo nombre → "juan" → "Juan"
                        Si tiene nombre y apellido → "juan perez" → "Juan Perez"
                        ucwords() pone en mayúscula la primera letra de cada palabra
                        y strtolower() asegura que el resto esté en minúsculas.
                    --}}
                    @php
                        $fullName   = ucwords(strtolower(Auth::user()->name));
                        $nameParts  = explode(' ', $fullName);
                        $initials   = collect($nameParts)
                                        ->take(2)
                                        ->map(fn($p) => strtoupper(substr($p, 0, 1)))
                                        ->implode('');
                        $email      = Auth::user()->email;
                    @endphp

                    <div class="user-menu-wrap" id="userMenuWrap">
                        {{-- Botón disparador --}}
                        <div class="user-trigger" id="userTrigger" role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="user-avatar" title="{{ $fullName }}">{{ $initials }}</div>
                            <span class="user-name">{{ $fullName }}</span>
                            {{-- Chevron SVG --}}
                            <svg class="user-chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="4 6 8 10 12 6"/>
                            </svg>
                        </div>

                        {{-- Dropdown --}}
                        <div class="user-dropdown" id="userDropdown" role="menu">

                            {{-- Cabecera con nombre completo y email --}}
                            <div class="dd-header">
                                <div class="dd-header-name">{{ $fullName }}</div>
                                <div class="dd-header-email">{{ $email }}</div>
                            </div>

                            {{-- Cuenta --}}
                            <a href="#" class="dd-item" role="menuitem">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="8" cy="5" r="3"/><path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/>
                                </svg>
                                Mi cuenta
                            </a>

                            {{-- Preferencias --}}
                            <a href="#" class="dd-item" role="menuitem">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M8 2a1 1 0 0 1 1 1v.5a4.5 4.5 0 0 1 1.7.7l.35-.35a1 1 0 1 1 1.42 1.42l-.36.35A4.5 4.5 0 0 1 12.5 7H13a1 1 0 0 1 0 2h-.5a4.5 4.5 0 0 1-.7 1.7l.35.35a1 1 0 1 1-1.42 1.42l-.35-.36A4.5 4.5 0 0 1 8.5 12.5V13a1 1 0 0 1-2 0v-.5a4.5 4.5 0 0 1-1.7-.7l-.35.35a1 1 0 1 1-1.42-1.42l.36-.35A4.5 4.5 0 0 1 3.5 9H3a1 1 0 0 1 0-2h.5a4.5 4.5 0 0 1 .7-1.7l-.35-.35a1 1 0 1 1 1.42-1.42l.35.36A4.5 4.5 0 0 1 7.5 3.5V3a1 1 0 0 1 1-1z"/><circle cx="8" cy="8" r="1.5"/>
                                </svg>
                                Preferencias
                            </a>

                            {{-- Configuración --}}
                            <a href="#" class="dd-item" role="menuitem">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="2" y="2" width="5" height="5" rx="1"/><rect x="9" y="2" width="5" height="5" rx="1"/>
                                    <rect x="2" y="9" width="5" height="5" rx="1"/><rect x="9" y="9" width="5" height="5" rx="1"/>
                                </svg>
                                Configuración
                            </a>

                            {{-- Mis pedidos --}}
                            <a href="#" class="dd-item" role="menuitem">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M2 2h2l2 8h7l1-5H5"/><circle cx="7" cy="13" r="1"/><circle cx="12" cy="13" r="1"/>
                                </svg>
                                Mis pedidos
                            </a>

                            <div class="dd-sep"></div>

                            {{-- Salir --}}
                            <form method="POST" action="{{ route('logout') }}" class="dd-logout-form">
                                @csrf
                                <button type="submit" class="dd-logout-btn" role="menuitem">
                                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M6 2H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3"/><polyline points="11 11 14 8 11 5"/><line x1="14" y1="8" x2="6" y2="8"/>
                                    </svg>
                                    Cerrar sesión
                                </button>
                            </form>

                        </div>
                    </div>
                @endauth
            </nav>
        </header>

        {{-- CONTENIDO DINÁMICO --}}
        <main>
            @yield('content')
        </main>

        {{-- ══ FOOTER ══ --}}
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
            // ── Navbar scroll ──
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                navbar.classList.toggle('scrolled', window.scrollY > 50);
            });

            // ── User dropdown ──
            const trigger    = document.getElementById('userTrigger');
            const dropdown   = document.getElementById('userDropdown');
            const menuWrap   = document.getElementById('userMenuWrap');

            if (trigger && dropdown) {
                // Abrir / cerrar al hacer clic en el trigger
                trigger.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isOpen = dropdown.classList.contains('open');
                    closeDropdown();
                    if (!isOpen) openDropdown();
                });

                // Cerrar al hacer clic fuera
                document.addEventListener('click', (e) => {
                    if (!menuWrap.contains(e.target)) closeDropdown();
                });

                // Cerrar con Escape
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') closeDropdown();
                });

                function openDropdown() {
                    dropdown.classList.add('open');
                    trigger.classList.add('open');
                    trigger.setAttribute('aria-expanded', 'true');
                }

                function closeDropdown() {
                    dropdown.classList.remove('open');
                    trigger.classList.remove('open');
                    trigger.setAttribute('aria-expanded', 'false');
                }
            }
        </script>
    </body>
    </html>