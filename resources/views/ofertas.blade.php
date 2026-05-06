@extends('layouts.app')

@section('title', 'Trabaja con Nosotros - NexusPlay')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;500;600;700&display=swap');

:root {
    --accent:      #c9a96e;
    --accent-dim:  rgba(201,169,110,0.1);
    --accent-line: rgba(201,169,110,0.2);
    --dark:        #0a0a0f;
    --dark2:       #0d0d15;
    --dark3:       #13131e;

    /* Textos accesibles */
    --text-primary:   #e8e8f0;
    --text-secondary: #a8a8b8;   /* antes #555 */
    --text-muted:     #f4f4f4;   /* antes #444 */
}

/* ── HERO ── */
.jobs-hero {
    position: relative;
    padding: 9rem 4rem 5rem;
    text-align: center;
    background: var(--dark);
    overflow: hidden;
}

.jobs-hero-bg {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse at 50% 0%, rgba(201,169,110,0.1) 0%, transparent 60%),
        radial-gradient(ellipse at 20% 80%, rgba(80,40,200,0.05) 0%, transparent 50%);
    pointer-events: none;
}

.jobs-hero::after {
    content: '';
    position: absolute; inset: 0;
    background: repeating-linear-gradient(
        0deg, transparent, transparent 3px,
        rgba(0,0,0,0.07) 3px, rgba(0,0,0,0.07) 6px
    );
    pointer-events: none;
}

.hero-tag {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    background: var(--accent-dim);
    border: 1px solid var(--accent-line);
    padding: 0.45rem 1.2rem;
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--accent);
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 1;
    animation: fadeUp 0.7s ease both;
}

.hero-tag::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--accent);
    animation: blink 1.8s infinite;
}

.hero-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: clamp(3rem, 8vw, 6rem);
    line-height: 0.95;
    letter-spacing: 3px;
    color: var(--text-primary);
    position: relative;
    z-index: 1;
    animation: fadeUp 0.7s ease 0.15s both;
}

.hero-title span { color: var(--accent); }

/* FIX: hero-sub — de #555 a --text-secondary */
.hero-sub {
    font-family: 'Rajdhani', sans-serif;
    font-size: 1.05rem;
    font-weight: 500;
    color: var(--text-secondary);
    margin-top: 1rem;
    letter-spacing: 0.5px;
    position: relative;
    z-index: 1;
    animation: fadeUp 0.7s ease 0.3s both;
}

/* ── STEPPER ── */
.stepper-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2.5rem 4rem;
    background: var(--dark2);
    border-top: 1px solid rgba(255,255,255,0.04);
    border-bottom: 1px solid rgba(255,255,255,0.04);
}

.step {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    cursor: pointer;
    opacity: 0.4;
    transition: opacity 0.2s;
}

.step.active { opacity: 1; }
.step.done   { opacity: 0.65; }

.step-num {
    width: 32px; height: 32px;
    border: 1px solid var(--accent-line);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1rem;
    letter-spacing: 1px;
    color: var(--accent);
    flex-shrink: 0;
    transition: all 0.3s;
}

.step.active .step-num {
    background: var(--accent);
    color: #0a0a0f;
    border-color: var(--accent);
}

.step.done .step-num {
    background: var(--accent-dim);
    border-color: rgba(201,169,110,0.4);
}

/* FIX: step-label — de #555 a --text-muted */
.step-label {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.1rem;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--text-muted);
    display: block;
}

.step.active .step-label { color: var(--accent); }

/* FIX: step-name — de #888 a --text-secondary */
.step-name {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--text-secondary);
}

.step.active .step-name { color: var(--text-primary); }

.step-connector {
    flex: 1;
    max-width: 60px;
    height: 1px;
    background: rgba(255,255,255,0.07);
    margin: 0 1rem;
}

/* ── CONTENEDOR ── */
.form-wrap {
    max-width: 900px;
    margin: 0 auto;
    padding: 3rem 4rem 6rem;
}

/* ── SECCIÓN CARD ── */
.form-section {
    background: var(--dark3);
    border: 1px solid rgba(255,255,255,0.05);
    border-top: 2px solid transparent;
    padding: 2rem 2rem 1.5rem;
    margin-bottom: 1.5rem;
    transition: border-top-color 0.3s;
}

.form-section:hover { border-top-color: var(--accent-line); }

.section-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.8rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

.section-num {
    width: 36px; height: 36px;
    background: var(--accent-dim);
    border: 1px solid var(--accent-line);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.1rem;
    color: var(--accent);
    flex-shrink: 0;
}

.section-title {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--accent);
}

/* ── GRID ── */
.fg-2, .fg-3 { display: grid; gap: 1rem; margin-bottom: 1rem; }
.fg-2 { grid-template-columns: 1fr 1fr; }
.fg-3 { grid-template-columns: 1fr 1fr 1fr; }

/* ── FIELDS ── */
.field-wrap {
    display: flex;
    flex-direction: column;
    gap: 0.45rem;
}

/* FIX: field-label — de #444 a --text-muted */
.field-label {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--text-muted);
}

.fi {
    width: 100%;
    padding: 0.85rem 1rem;
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.07);
    border-bottom: 2px solid rgba(255,255,255,0.07);
    color: var(--text-primary);
    font-size: 0.9rem;
    font-family: 'Rajdhani', sans-serif;
    font-weight: 500;
    letter-spacing: 0.4px;
    transition: all 0.25s;
    -webkit-appearance: none;
}

/* FIX: placeholder — de #333 a --text-muted */
.fi::placeholder { color: var(--text-muted); }

.fi:focus {
    outline: none;
    border-color: var(--accent-line);
    border-bottom-color: var(--accent);
    background: rgba(201,169,110,0.03);
}

/* FIX: select vacío — de #777 a --text-secondary */
select.fi         { cursor: pointer; color: var(--text-secondary); }
select.fi:focus   { color: var(--text-primary); }
textarea.fi       { min-height: 110px; resize: vertical; }

/* ── RADIO ── */
.radio-group {
    display: flex;
    gap: 0.8rem;
    flex-wrap: wrap;
}

.radio-opt { flex: 1; min-width: 80px; }
.radio-opt input[type="radio"] { display: none; }

.radio-opt label {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.65rem;
    border: 1px solid rgba(255,255,255,0.07);
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.85rem;
    font-weight: 500;
    color: var(--text-secondary);   /* antes #555 */
    cursor: pointer;
    transition: all 0.2s;
    text-align: center;
}

.radio-opt input:checked + label {
    border-color: var(--accent);
    background: var(--accent-dim);
    color: var(--accent);
}

.radio-opt label:hover {
    border-color: var(--accent-line);
    color: var(--text-primary);
}

/* ── IDIOMAS ── */
.lang-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.lang-pill {
    padding: 0.45rem 1rem;
    border: 1px solid rgba(255,255,255,0.07);
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.82rem;
    font-weight: 500;
    color: var(--text-secondary);   /* antes #555 */
    cursor: pointer;
    transition: all 0.2s;
    user-select: none;
}

.lang-pill:hover {
    border-color: var(--accent-line);
    color: var(--text-primary);
}

.lang-pill.selected {
    border-color: var(--accent);
    background: var(--accent-dim);
    color: var(--accent);
}

/* ── FILE UPLOAD ── */
.file-drop {
    border: 1px dashed var(--accent-line);
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    position: relative;
}

.file-drop:hover {
    border-color: rgba(201,169,110,0.45);
    background: rgba(201,169,110,0.03);
}

.file-drop input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
}

.file-drop-icon { font-size: 2rem; margin-bottom: 0.5rem; }

/* FIX: textos del file drop — de #555/#333 a accesibles */
.file-drop-text {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.88rem;
    font-weight: 500;
    color: var(--text-secondary);
    letter-spacing: 0.4px;
}

.file-drop-sub {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--text-muted);
    margin-top: 0.3rem;
}

/* ── ÉXITO ── */
.success-alert {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    background: rgba(74,222,128,0.06);
    border: 1px solid rgba(74,222,128,0.2);
    border-left: 3px solid #4ade80;
    margin-bottom: 2rem;
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.9rem;
    font-weight: 500;
    color: #4ade80;
}

/* ── SUBMIT ── */
.submit-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255,255,255,0.05);
}

/* FIX: texto submit-info — de #444/#666 a accesibles */
.submit-info {
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.85rem;
    font-weight: 500;
    color: var(--text-secondary);
    line-height: 1.6;
}

.submit-info strong {
    color: var(--text-primary);
    font-weight: 700;
}

.jobs-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.8rem;
    padding: 1rem 2.5rem;
    background: var(--accent);
    border: none;
    color: #0a0a0f;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.1rem;
    letter-spacing: 4px;
    cursor: pointer;
    transition: background 0.25s, transform 0.25s, box-shadow 0.25s;
    position: relative;
    overflow: hidden;
    flex-shrink: 0;
}

.jobs-btn::before {
    content: '';
    position: absolute;
    top: 0; left: -100%;
    width: 100%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
    transition: left 0.5s;
}

.jobs-btn:hover::before { left: 100%; }
.jobs-btn:hover {
    background: #dbb97e;
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(201,169,110,0.25);
}

@keyframes blink   { 0%,100%{opacity:1} 50%{opacity:0.15} }
@keyframes fadeUp  { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }

@media (max-width: 768px) {
    .jobs-hero    { padding: 7rem 2rem 3rem; }
    .form-wrap    { padding: 2rem 1.5rem 4rem; }
    .fg-2, .fg-3  { grid-template-columns: 1fr; }
    .stepper-wrap { padding: 1.5rem 1rem; }
    .step-info    { display: none; }
    .submit-wrap  { flex-direction: column; align-items: flex-start; }
}
</style>

{{-- HERO --}}
<section class="jobs-hero">
    <div class="jobs-hero-bg"></div>
    <div class="hero-tag">Estamos contratando</div>
    <h1 class="hero-title">Únete al<br><span>equipo</span></h1>
    <p class="hero-sub">Buscamos talento apasionado por los videojuegos 🎮</p>
</section>

{{-- STEPPER --}}
<div class="stepper-wrap">
    <div class="step active" data-step="1">
        <div class="step-num">1</div>
        <div class="step-info">
            <span class="step-label">Paso 01</span>
            <div class="step-name">Datos personales</div>
        </div>
    </div>
    <div class="step-connector"></div>
    <div class="step" data-step="2">
        <div class="step-num">2</div>
        <div class="step-info">
            <span class="step-label">Paso 02</span>
            <div class="step-name">Perfil profesional</div>
        </div>
    </div>
    <div class="step-connector"></div>
    <div class="step" data-step="3">
        <div class="step-num">3</div>
        <div class="step-info">
            <span class="step-label">Paso 03</span>
            <div class="step-name">Idiomas & CV</div>
        </div>
    </div>
    <div class="step-connector"></div>
    <div class="step" data-step="4">
        <div class="step-num">4</div>
        <div class="step-info">
            <span class="step-label">Paso 04</span>
            <div class="step-name">Motivación</div>
        </div>
    </div>
</div>

{{-- FORMULARIO --}}
<div class="form-wrap">

    @if(session('success'))
        <div class="success-alert">
            <span>✓</span> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('ofertas.store') }}" method="POST" enctype="multipart/form-data" id="jobs-form">
        @csrf

        {{-- 1. DATOS PERSONALES --}}
        <div class="form-section" id="sec-1">
            <div class="section-header">
                <div class="section-num">1</div>
                <div class="section-title">Datos Personales</div>
            </div>

            <div class="fg-3">
                <div class="field-wrap">
                    <label class="field-label">Nombre *</label>
                    <input type="text" name="nombre" class="fi" placeholder="Tu nombre" required>
                </div>
                <div class="field-wrap">
                    <label class="field-label">Apellidos *</label>
                    <input type="text" name="apellidos" class="fi" placeholder="Tus apellidos" required>
                </div>
                <div class="field-wrap">
                    <label class="field-label">Edad</label>
                    <input type="number" name="edad" class="fi" placeholder="Ej: 25" min="16" max="70">
                </div>
            </div>

            <div class="fg-2">
                <div class="field-wrap">
                    <label class="field-label">Correo electrónico *</label>
                    <input type="email" name="email" class="fi" placeholder="tu@email.com">
                </div>
                <div class="field-wrap">
                    <label class="field-label">Teléfono</label>
                    <input type="text" name="telefono" class="fi" placeholder="+57 300 000 0000">
                </div>
            </div>

            <div class="field-wrap" style="margin-bottom:1rem;">
                <label class="field-label">Sexo</label>
                <div class="radio-group">
                    <div class="radio-opt">
                        <input type="radio" name="sexo" id="m" value="Masculino">
                        <label for="m">Masculino</label>
                    </div>
                    <div class="radio-opt">
                        <input type="radio" name="sexo" id="f" value="Femenino">
                        <label for="f">Femenino</label>
                    </div>
                    <div class="radio-opt">
                        <input type="radio" name="sexo" id="o" value="Otro">
                        <label for="o">Otro</label>
                    </div>
                    <div class="radio-opt">
                        <input type="radio" name="sexo" id="nr" value="No especificar">
                        <label for="nr">Prefiero no decir</label>
                    </div>
                </div>
            </div>

            <div class="fg-2">
                <div class="field-wrap">
                    <label class="field-label">Departamento</label>
                    <input type="text" name="departamento" class="fi" placeholder="Ej: Cundinamarca">
                </div>
                <div class="field-wrap">
                    <label class="field-label">Ciudad</label>
                    <input type="text" name="ciudad" class="fi" placeholder="Ej: Bogotá">
                </div>
            </div>
        </div>

        {{-- 2. PERFIL PROFESIONAL --}}
        <div class="form-section" id="sec-2">
            <div class="section-header">
                <div class="section-num">2</div>
                <div class="section-title">Perfil Profesional</div>
            </div>

            <div class="fg-2">
                <div class="field-wrap">
                    <label class="field-label">Cargo anterior</label>
                    <input type="text" name="cargo" class="fi" placeholder="Ej: Community Manager">
                </div>
                <div class="field-wrap">
                    <label class="field-label">Empresa donde trabajaba</label>
                    <input type="text" name="empresa" class="fi" placeholder="Nombre de la empresa">
                </div>
            </div>

            <div class="fg-2">
                <div class="field-wrap">
                    <label class="field-label">Ciudad de la empresa</label>
                    <input type="text" name="ciudad_empresa" class="fi" placeholder="Ej: Medellín">
                </div>
                <div class="field-wrap">
                    <label class="field-label">Años de experiencia</label>
                    <select name="experiencia" class="fi">
                        <option value="">Selecciona...</option>
                        <option>Sin experiencia</option>
                        <option>1-2 años</option>
                        <option>3-5 años</option>
                        <option>Más de 5 años</option>
                    </select>
                </div>
            </div>

            <div class="field-wrap">
                <label class="field-label">Logros laborales</label>
                <textarea name="logros" class="fi" placeholder="Cuéntanos tus principales logros en experiencias previas..."></textarea>
            </div>
        </div>

        {{-- 3. IDIOMAS Y CV --}}
        <div class="form-section" id="sec-3">
            <div class="section-header">
                <div class="section-num">3</div>
                <div class="section-title">Idiomas & Curriculum</div>
            </div>

            <div class="field-wrap" style="margin-bottom:1.5rem;">
                <label class="field-label">Idiomas que dominas</label>
                <div class="lang-pills">
                    <div class="lang-pill" data-lang="Español">🇪🇸 Español</div>
                    <div class="lang-pill" data-lang="Inglés">🇺🇸 Inglés</div>
                    <div class="lang-pill" data-lang="Francés">🇫🇷 Francés</div>
                    <div class="lang-pill" data-lang="Japonés">🇯🇵 Japonés</div>
                    <div class="lang-pill" data-lang="Portugués">🇧🇷 Portugués</div>
                    <div class="lang-pill" data-lang="Alemán">🇩🇪 Alemán</div>
                    <div class="lang-pill" data-lang="Otros">+ Otros</div>
                </div>
                <input type="hidden" name="idiomas" id="idiomas-hidden">
            </div>

            <div class="field-wrap">
                <label class="field-label">Adjuntar CV (opcional)</label>
                <div class="file-drop" id="file-drop">
                    <input type="file" name="cv" accept=".pdf,.doc,.docx" id="cv-input">
                    <div class="file-drop-icon">📄</div>
                    <div class="file-drop-text" id="file-label">Arrastra tu CV aquí o haz clic para seleccionar</div>
                    <div class="file-drop-sub">PDF, DOC o DOCX — máx. 5MB</div>
                </div>
            </div>
        </div>

        {{-- 4. MOTIVACIÓN --}}
        <div class="form-section" id="sec-4">
            <div class="section-header">
                <div class="section-num">4</div>
                <div class="section-title">Motivación</div>
            </div>

            <div class="field-wrap">
                <label class="field-label">¿Por qué quieres trabajar en NexusPlay? *</label>
                <textarea name="motivacion" class="fi" style="min-height:140px;"
                    placeholder="Cuéntanos qué te apasiona del gaming y por qué serías un gran fit para nuestro equipo..." required></textarea>
            </div>
        </div>

        {{-- SUBMIT --}}
        <div class="submit-wrap">
            <div class="submit-info">
                <strong>¿Todo listo?</strong><br>
                Revisaremos tu solicitud y te contactaremos en los próximos días.
            </div>
            <button type="submit" class="jobs-btn">
                Enviar solicitud ➜
            </button>
        </div>

    </form>
</div>

<script>
// STEPPER visual al hacer scroll
const sections = ['sec-1','sec-2','sec-3','sec-4'];
const steps = document.querySelectorAll('.step');

const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const idx = sections.indexOf(entry.target.id);
            if (idx >= 0) {
                steps.forEach((s, i) => {
                    s.classList.remove('active', 'done');
                    if (i === idx)      s.classList.add('active');
                    else if (i < idx)   s.classList.add('done');
                });
            }
        }
    });
}, { threshold: 0.4 });

sections.forEach(id => {
    const el = document.getElementById(id);
    if (el) io.observe(el);
});

// IDIOMAS PILLS
const pills = document.querySelectorAll('.lang-pill');
const hiddenInput = document.getElementById('idiomas-hidden');
let selected = [];

pills.forEach(pill => {
    pill.addEventListener('click', () => {
        const lang = pill.dataset.lang;
        if (pill.classList.contains('selected')) {
            pill.classList.remove('selected');
            selected = selected.filter(l => l !== lang);
        } else {
            pill.classList.add('selected');
            selected.push(lang);
        }
        hiddenInput.value = selected.join(', ');
    });
});

// FILE DROP LABEL
document.getElementById('cv-input').addEventListener('change', function() {
    const label = document.getElementById('file-label');
    label.textContent = this.files[0]
        ? this.files[0].name
        : 'Arrastra tu CV aquí o haz clic para seleccionar';
    if (this.files[0])
        document.getElementById('file-drop').style.borderColor = 'rgba(201,169,110,0.5)';
});
</script>

@endsection