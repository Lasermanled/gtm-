<?php
/**
 * Main Template - DK Laserman
 * Página Competitiva Híbrida — Optimizada para Conversión
 */
get_header();
$data = dk_get_site_data();
?>

<style>
    /* ── Expandible galerías ── */
    .service-expanded {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.6s cubic-bezier(0.16,1,0.3,1), opacity 0.4s ease;
        opacity: 0;
    }
    .service-expanded.active {
        max-height: 3000px;
        opacity: 1;
    }

    /* ── Scroll colorize ── */
    .scroll-colorize {
        filter: grayscale(1);
        transition: filter 0.8s ease;
    }
    .scroll-colorize.in-view,
    .scroll-colorize:hover { filter: grayscale(0); }

    /* ── Botones segmento — clean, sin sweep animation ── */
    .seg-btn {
        position: relative;
        border: 1px solid rgba(255,255,255,0.1);
        background: transparent;
        transition: all 0.25s ease;
    }
    .seg-btn:hover {
        border-color: rgba(0,255,29,0.6);
        background: rgba(0,255,29,0.04);
    }

    .hero-video-shell {
        position: relative;
        border: 1px solid rgba(0,255,29,0.28);
        background: linear-gradient(135deg, rgba(0,255,29,0.12), transparent 28%), rgba(0,0,0,0.78);
        box-shadow: 0 0 70px rgba(0,255,29,0.12);
    }
    .hero-video-shell::before,
    .hero-video-shell::after {
        content: '';
        position: absolute;
        width: 54px;
        height: 54px;
        pointer-events: none;
        z-index: 3;
    }
    .hero-video-shell::before {
        top: -1px;
        left: -1px;
        border-top: 2px solid #00ff1d;
        border-left: 2px solid #00ff1d;
    }
    .hero-video-shell::after {
        right: -1px;
        bottom: -1px;
        border-right: 2px solid #00ff1d;
        border-bottom: 2px solid #00ff1d;
    }
    .hero-video-frame {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%;
        overflow: hidden;
        background: #000;
    }
    .hero-video-frame iframe {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
    .hero-stat-chip {
        border: 1px solid rgba(255,255,255,0.08);
        background: rgba(255,255,255,0.03);
        backdrop-filter: blur(12px);
    }
    .quick-path {
        position: relative;
        overflow: hidden;
    }
    .quick-path::after {
        content: '';
        position: absolute;
        inset: auto 0 0 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #00ff1d, transparent);
        transform: translateX(-110%);
        transition: transform 0.45s ease;
    }
    .quick-path:hover::after { transform: translateX(110%); }

    /* ── Drop hero ── */
    @keyframes dropHeavy {
        0%   { opacity: 0; transform: translateY(-60px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .drop-heavy {
        animation: dropHeavy 0.9s cubic-bezier(0.16,1,0.3,1) forwards;
        opacity: 0;
    }

    /* ── Tag chips ── */
    .tag-chip {
        padding: 3px 10px;
        border: 1px solid rgba(255,255,255,0.07);
        font-size: 10px;
        color: #71717a;
        letter-spacing: 0.05em;
    }
    .tag-chip::before {
        content: '';
        display: inline-block;
        width: 3px; height: 3px;
        border-radius: 50%;
        background: #00ff1d;
        margin-right: 6px;
        vertical-align: middle;
    }

    .service-card {
        cursor: pointer;
        transition: border-color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
    }
    .service-card:hover {
        box-shadow: 0 22px 70px rgba(0,0,0,0.35), 0 0 32px rgba(0,255,29,0.08);
    }

    /* ── Línea divisora minimal ── */
    .neon-line {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(0,255,29,0.4), transparent);
    }

    /* ── Video Modal ── */
    .video-modal {
        position: fixed; inset: 0; z-index: 100;
        background: rgba(0,0,0,0.96);
        display: none; align-items: center; justify-content: center;
    }
    .video-modal.active { display: flex; }
    .video-modal iframe {
        width: 90vw; max-width: 900px;
        height: 50.6vw; max-height: 506px;
        border: 1px solid rgba(255,255,255,0.08);
    }
    .video-modal-close {
        position: absolute; top: 24px; right: 32px;
        color: white; font-size: 28px; cursor: pointer;
        z-index: 101; opacity: 0.4; transition: opacity 0.2s;
    }
    .video-modal-close:hover { opacity: 1; }

    /* ── Section label ── */
    .section-label {
        font-size: 10px;
        letter-spacing: 0.5em;
        text-transform: uppercase;
        color: #00ff1d;
        font-family: 'Unbounded', sans-serif;
        opacity: 0.7;
    }

    /* ── YouTube Shorts Embed 9:16 Vertical ── */
    .yt-short-card {
        position: relative;
        background: #000;
    }
    .yt-short-wrapper {
        position: relative;
        width: 100%;
        padding-bottom: 177.78%; /* 9:16 vertical */
        height: 0;
        overflow: hidden;
    }
    .yt-short-iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
    /* Mobile: limitar altura para que no sea excesivo */
    @media (max-width: 767px) {
        .yt-short-wrapper {
            padding-bottom: 150%; /* un poco más compacto en mobile */
        }
    }
</style>

<!-- ============================================ -->
<!-- 1️⃣ HERO -->
<!-- ============================================ -->
<section id="inicio"
    class="min-h-screen flex flex-col justify-center items-center text-center px-4 md:px-6 relative overflow-hidden pt-24 md:pt-0">
    <img src="<?php echo esc_url($data['hero_image']); ?>"
        class="absolute inset-0 w-full h-full object-cover opacity-35" alt="DK Laserman Hero">
    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-black/40"></div>

    <div class="relative z-10 max-w-6xl w-full">
        <div class="hero-video-shell p-2 md:p-3 mb-10 md:mb-12 max-w-4xl mx-auto fade-up" data-tilt>
            <div class="hero-video-frame">
                <iframe
                    src="https://www.youtube.com/embed/-vmRI2P1kw8?rel=0&modestbranding=1&playsinline=1"
                    title="Promo Principal Laserman"
                    loading="eager"
                    referrerpolicy="no-referrer-when-downgrade"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
            <div class="flex items-center justify-between gap-4 px-3 md:px-5 py-4 text-left">
                <div>
                    <p class="text-white font-display text-xs uppercase tracking-[0.28em]">Video principal</p>
                    <p class="text-zinc-500 text-xs mt-1">El show en acción desde el primer segundo</p>
                </div>
                <a href="#galeria" class="hidden sm:inline-flex px-5 py-3 border border-white/10 text-white/60 hover:text-neon hover:border-neon text-[9px] uppercase tracking-[0.24em] transition-all">
                    Ver más
                </a>
            </div>
        </div>
        <p class="section-label mb-10 fade-up">Tecnología Láser · Argentina</p>

        <!-- LASER / MAN — solo MAN tiene el glow real -->
        <div class="flex flex-col items-center leading-[0.85] mb-10">
            <div class="drop-heavy" style="animation-delay: 0.15s">
                <span class="text-[20vw] md:text-[13vw] font-display font-black tracking-tighter text-white">LASER</span>
            </div>
            <div class="drop-heavy" style="animation-delay: 0.4s">
                <span class="text-[20vw] md:text-[13vw] font-display font-black tracking-tighter text-neon neon-glow">MAN</span>
            </div>
        </div>

        <p class="text-zinc-400 text-sm md:text-base font-light leading-loose max-w-lg mx-auto fade-up mb-12">
            El único show de manipulación láser en vivo de Latinoamérica.<br>
            <span class="text-white">Fiestas nacionales, festivales y eventos corporativos.</span>
        </p>

        <!-- Segmentation Buttons — estilo clean -->
        <div class="flex flex-col md:flex-row gap-3 justify-center max-w-xl mx-auto fade-up">
            <a href="#contacto" data-segment="boliche"
                class="seg-btn quick-path flex-1 px-6 py-4 text-white/60 hover:text-neon text-[10px] font-display uppercase tracking-[0.3em] text-center transition-all">
                Discoteca / Boliche
            </a>
            <a href="#contacto" data-segment="cultura"
                class="seg-btn quick-path flex-1 px-6 py-4 text-white/60 hover:text-neon text-[10px] font-display uppercase tracking-[0.3em] text-center transition-all">
                Municipalidad / Cultura
            </a>
            <a href="#contacto" data-segment="productor"
                class="seg-btn quick-path flex-1 px-6 py-4 text-white/60 hover:text-neon text-[10px] font-display uppercase tracking-[0.3em] text-center transition-all">
                Productor / Empresa
            </a>
        </div>

        <!-- Scroll indicator minimal -->
        <div class="mt-16 flex flex-col items-center gap-3 opacity-25 fade-up">
            <div class="w-px h-12 bg-gradient-to-b from-neon to-transparent"></div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 2️⃣ STATS + PROPUESTA DE VALOR -->
<!-- ============================================ -->
<section class="py-24 px-4 md:px-6 bg-zinc-950 border-y border-zinc-900">
    <div class="max-w-7xl mx-auto">
        <!-- Stats con counter animation — sin glow, solo color -->
        <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-y md:divide-y-0 divide-zinc-900 mb-24">
            <?php foreach ($data['stats'] as $i => $stat):
                preg_match('/(\d+)/', $stat['number'], $m);
                $num = $m[1] ?? 0;
                $suffix = preg_replace('/\d+/', '', $stat['number']);
            ?>
                <div class="text-center py-12 px-6 stat-card group">
                    <div class="text-5xl md:text-6xl font-display font-black text-neon mb-2">
                        <span class="stat-number" data-target="<?php echo $num; ?>" data-suffix="<?php echo esc_attr($suffix); ?>">0<?php echo esc_html($suffix); ?></span>
                    </div>
                    <div class="text-[9px] text-zinc-600 uppercase tracking-[0.25em] mt-1"><?php echo esc_html($stat['label']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Interstitial Banner -->
        <div class="mb-24 w-full overflow-hidden rounded-sm border border-zinc-900 fade-up">
            <img src="https://laserman.com.ar/wp-content/uploads/2026/05/IMG-20250823-WA0025.jpg" 
                alt="Laserman Impacto Visual" 
                class="w-full h-auto object-cover">
        </div>

        <!-- Feature Cards -->
        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach ($data['features'] as $feature): ?>
                <div class="glass-card p-8 text-center hover:border-neon/30 transition-all group" data-tilt>
                    <div class="text-neon mb-4 group-hover:scale-110 transition-transform"><?php echo $feature['icon']; ?>
                    </div>
                    <h3 class="font-display font-bold text-white text-lg uppercase mb-3"><?php echo $feature['title']; ?>
                    </h3>
                    <p class="text-zinc-500 text-sm leading-relaxed"><?php echo $feature['desc']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Government Logos -->
        <div class="text-center mt-16">
            <p class="text-[10px] text-zinc-600 uppercase tracking-[0.5em] mb-8">Gobiernos que confiaron en nosotros</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-2xl mx-auto">
                <img src="<?php echo esc_url($data['logo_rionegro']); ?>" alt="Río Negro"
                    class="h-16 md:h-20 w-auto mx-auto opacity-50 hover:opacity-100 transition-opacity">
                <img src="<?php echo esc_url($data['logo_misiones']); ?>" alt="Misiones"
                    class="h-16 md:h-20 w-auto mx-auto opacity-50 hover:opacity-100 transition-opacity">
                <img src="<?php echo esc_url($data['logo_formosa']); ?>" alt="Formosa"
                    class="h-16 md:h-20 w-auto mx-auto opacity-50 hover:opacity-100 transition-opacity">
                <img src="<?php echo esc_url($data['logo_neuquen']); ?>" alt="Neuquén"
                    class="h-16 md:h-20 w-auto mx-auto opacity-50 hover:opacity-100 transition-opacity">
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 3️⃣ SERVICIOS - CATÁLOGO CON GALERÍAS -->
<!-- ============================================ -->
<section id="servicios" class="py-32 px-4 md:px-6 bg-black" data-section="servicios">
    <div class="max-w-7xl mx-auto">
        <div class="mb-20 text-center">
            <span class="section-label block mb-6">Qué Ofrecemos</span>
            <h2 class="text-4xl md:text-5xl font-display font-black uppercase leading-tight text-white">
                5 Formas de<br>
                <span class="text-neon">Transformar tu Evento</span>
            </h2>
            <div class="neon-line w-16 mx-auto mt-8"></div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-px bg-zinc-900 border border-zinc-900">

            <?php foreach ($data['services'] as $index => $service): ?>
                <div class="service-card relative bg-black <?php echo $service['featured'] ? 'lg:col-span-2' : ''; ?> flex flex-col" data-tilt
                    <?php if (!empty($service['gallery'])): ?>onclick="toggleService('<?php echo $service['id']; ?>')"<?php endif; ?>>
                    <div class="p-4 md:p-10 group hover:bg-zinc-900/30 transition-all">

                        <?php if ($service['featured']): ?>
                            <div
                                class="absolute top-6 right-6 bg-neon text-black px-4 py-1 text-[9px] font-black tracking-widest z-10">
                                MÁS PEDIDO
                            </div>
                        <?php endif; ?>

                        <!-- Image -->
                        <div class="mb-6 relative overflow-hidden">
                            <img src="<?php echo esc_url($service['image']); ?>"
                                class="w-full aspect-video object-cover group-hover:scale-105 transition-transform duration-700"
                                alt="<?php echo esc_attr($service['title']); ?>">
                            <div
                                class="absolute top-4 right-4 bg-black/50 backdrop-blur border border-white/10 px-3 py-1 rounded-full font-mono text-xs text-white">
                                0<?php echo $index + 1; ?>
                            </div>
                        </div>

                        <!-- Content -->
                        <h3
                            class="text-2xl md:text-3xl font-display font-bold uppercase mb-1 <?php echo $service['featured'] ? 'text-neon' : 'text-white'; ?>">
                            <?php echo esc_html($service['title']); ?>
                        </h3>
                        <p class="text-neon text-[10px] font-display tracking-widest uppercase mb-4">
                            <?php echo esc_html($service['subtitle']); ?></p>

                        <p class="text-sm text-zinc-300 leading-relaxed mb-4 border-l-2 border-zinc-800 pl-4">
                            <?php echo esc_html($service['description']); ?>
                        </p>

                        <!-- IdealFor Tags -->
                        <div class="mb-4">
                            <span
                                class="text-[9px] text-zinc-600 uppercase tracking-widest font-bold block mb-2">Recomendado
                                para:</span>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($service['idealFor'] as $tag): ?>
                                    <span class="tag-chip"><?php echo esc_html($tag); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-4 items-center">
                            <?php if (!empty($service['gallery'])): ?>
                                <button onclick="event.stopPropagation(); toggleService('<?php echo $service['id']; ?>')" class="px-6 py-3 bg-neon/10 border border-neon text-neon text-xs font-bold uppercase tracking-widest hover:bg-neon hover:text-black transition-all">Ver Galería ↓</button>
                            <?php endif; ?>
                            <?php if (!empty($service['videoUrl'])): ?>
                                <button onclick="event.stopPropagation(); openVideo('<?php echo esc_url(str_replace(['youtube.com/shorts/', 'youtu.be/'], 'youtube.com/embed/', $service['videoUrl'])); ?>')" class="px-6 py-3 border border-zinc-700 text-zinc-400 text-xs font-bold uppercase tracking-widest hover:border-white hover:text-white transition-all">▶ Video</button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Expandable Gallery -->
                    <?php if (!empty($service['gallery'])): ?>
                        <div id="service-<?php echo $service['id']; ?>" class="service-expanded border-t border-zinc-900">
                            <div class="p-4 md:p-10 bg-zinc-900/50">
                                <h4 class="text-xl font-display font-bold text-white mb-6">Galería
                                    <?php echo esc_html($service['title']); ?></h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <?php foreach ($service['gallery'] as $gi => $img): ?>
                                        <div class="overflow-hidden border border-zinc-800 rounded-sm group cursor-pointer">
                                            <img src="<?php echo esc_url($img); ?>"
                                                class="w-full h-56 md:h-64 object-cover group-hover:scale-110 transition-transform duration-700"
                                                alt="<?php echo esc_attr($service['title'] . ' ' . ($gi + 1)); ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <a href="#contacto" onclick="event.stopPropagation()"
                                    class="mt-6 inline-block px-8 py-3 bg-neon text-black font-bold uppercase text-sm hover:bg-white transition-all">
                                    Cotizar <?php echo esc_html($service['title']); ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        </div>

        <!-- CTA under services -->
        <div class="text-center mt-16">
            <div class="laser-line w-48 mx-auto mb-6"></div>
            <a href="<?php echo dk_whatsapp_url('Hola, vi el catálogo y necesito cotizar'); ?>" target="_blank"
                class="inline-block px-12 py-5 bg-neon text-black font-black uppercase text-xs tracking-[0.3em] hover:bg-white transition-all">
                Cotizá por WhatsApp →
            </a>
            <div class="laser-line w-48 mx-auto mt-6"></div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 4️⃣ VIDEO GRID - PROOF OF WORK -->
<!-- ============================================ -->
<section id="galeria" class="py-32 px-4 md:px-6 bg-zinc-950 border-y border-zinc-900" data-section="galeria">
    <div class="max-w-7xl mx-auto">
        <div class="mb-20 text-center">
            <span class="section-label block mb-6">Video</span>
            <h2 class="text-4xl md:text-5xl font-display font-black uppercase leading-tight text-white">
                Mirá el Show<br>
                <span class="text-neon">en Acción</span>
            </h2>
            <div class="neon-line w-16 mx-auto mt-8"></div>
        </div>

        <div class="grid md:grid-cols-3 gap-2 md:gap-4">
            <!-- Video 1 -->
            <div class="yt-short-card relative overflow-hidden border border-zinc-900 hover:border-neon transition-all group">
                <div class="yt-short-wrapper">
                    <iframe 
                        src="https://www.youtube.com/embed/-vmRI2P1kw8?rel=0&modestbranding=1&playsinline=1" 
                        class="yt-short-iframe"
                        frameborder="0" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen
                        title="Promo Principal Laserman"></iframe>
                </div>
                <div class="absolute bottom-0 left-0 right-0 z-10 pointer-events-none bg-gradient-to-t from-black/80 to-transparent px-4 py-4">
                    <p class="text-white text-xs font-display uppercase tracking-wider drop-shadow-lg">Promo Principal Laserman</p>
                </div>
            </div>
            <!-- Video 2 -->
            <div class="yt-short-card relative overflow-hidden border border-zinc-900 hover:border-neon transition-all group">
                <div class="yt-short-wrapper">
                    <iframe 
                        src="https://www.youtube.com/embed/h6-5NnUaf44?rel=0&modestbranding=1&playsinline=1" 
                        class="yt-short-iframe"
                        frameborder="0" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen
                        title="Fiesta del Chocolate"></iframe>
                </div>
                <div class="absolute bottom-0 left-0 right-0 z-10 pointer-events-none bg-gradient-to-t from-black/80 to-transparent px-4 py-4">
                    <p class="text-white text-xs font-display uppercase tracking-wider drop-shadow-lg">Fiesta del Chocolate</p>
                </div>
            </div>
            <!-- Video 3 -->
            <div class="yt-short-card relative overflow-hidden border border-zinc-900 hover:border-neon transition-all group">
                <div class="yt-short-wrapper">
                    <iframe 
                        src="https://www.youtube.com/embed/rVg2YEs9OWk?rel=0&modestbranding=1&playsinline=1" 
                        class="yt-short-iframe"
                        frameborder="0" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen
                        title="Fiesta del Pionero"></iframe>
                </div>
                <div class="absolute bottom-0 left-0 right-0 z-10 pointer-events-none bg-gradient-to-t from-black/80 to-transparent px-4 py-4">
                    <p class="text-white text-xs font-display uppercase tracking-wider drop-shadow-lg">Fiesta del Pionero</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 5️⃣ TRAYECTORIA - TIMELINE -->
<!-- ============================================ -->
<section id="clientes" class="py-32 px-4 md:px-6 bg-black" data-section="clientes">
    <div class="max-w-7xl mx-auto">
        <div class="mb-20">
            <span class="section-label block mb-6">Trayectoria</span>
            <h2 class="text-4xl md:text-5xl font-display font-black uppercase leading-none text-white">
                Legado<br><span class="text-neon">en Escena</span>
            </h2>
            <div class="neon-line w-16 mt-8"></div>
        </div>

        <div class="border-t border-zinc-900">
            <?php foreach ($data['festivals'] as $festival): ?>
                <div
                    class="py-8 flex flex-col md:flex-row md:items-center justify-between border-b border-zinc-900 group hover:bg-zinc-900/20 transition-colors px-4">
                    <div>
                        <h4
                            class="text-xl font-display font-light uppercase text-white group-hover:text-neon transition-colors">
                            <?php echo esc_html($festival['name']); ?>
                        </h4>
                        <p class="text-[10px] text-zinc-500 tracking-[0.3em] mt-2 uppercase">
                            <?php echo esc_html($festival['location']); ?></p>
                    </div>
                    <span
                        class="text-zinc-700 font-display text-sm mt-4 md:mt-0"><?php echo esc_html($festival['year']); ?></span>
                </div>
            <?php endforeach; ?>
        </div>


    </div>
</section>

<!-- ============================================ -->
<!-- 6️⃣ TESTIMONIALES - CARRUSEL -->
<!-- ============================================ -->
<section class="py-32 px-4 md:px-6 border-y border-zinc-900 bg-black overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="mb-20 text-center">
            <span class="section-label block mb-6">Testimonios</span>
            <h2 class="text-4xl md:text-5xl font-display font-black uppercase leading-none text-white">
                Lo que dicen<br><span class="text-neon">nuestros clientes</span>
            </h2>
            <div class="neon-line w-16 mx-auto mt-8"></div>
        </div>

        <!-- Carousel wrapper -->
        <div class="relative">
            <div id="testimonial-track" class="flex transition-transform duration-700 ease-in-out">
                <?php foreach ($data['testimonials'] as $i => $testimonial): ?>
                    <div class="testimonial-slide min-w-full md:min-w-[50%] lg:min-w-[33.333%] px-3">
                        <div class="p-10 border border-zinc-800 bg-zinc-950 hover:border-neon/30 transition-all h-full flex flex-col" style="border-radius: 2px;">
                            <span class="text-5xl text-neon neon-glow-sm font-display font-black leading-none mb-4">"</span>
                            <p class="text-white/70 italic mb-8 text-sm leading-loose flex-1">
                                <?php echo esc_html($testimonial['quote']); ?>
                            </p>
                            <div class="border-t border-zinc-800 pt-5">
                                <p class="font-bold text-white text-sm uppercase tracking-widest"><?php echo esc_html($testimonial['name']); ?></p>
                                <p class="text-[10px] text-neon/60 uppercase tracking-[0.3em] mt-1"><?php echo esc_html($testimonial['role']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Controls -->
            <div class="flex items-center justify-center gap-6 mt-10">
                <button id="prev-testimonial" class="w-10 h-10 border border-zinc-700 hover:border-neon hover:text-neon text-zinc-500 transition-all flex items-center justify-center text-lg">‹</button>
                <div id="testimonial-dots" class="flex gap-2">
                    <?php foreach ($data['testimonials'] as $i => $_): ?>
                        <button class="testimonial-dot w-1.5 h-1.5 rounded-full bg-zinc-700 hover:bg-neon transition-colors <?php echo $i === 0 ? 'bg-neon' : ''; ?>" data-index="<?php echo $i; ?>"></button>
                    <?php endforeach; ?>
                </div>
                <button id="next-testimonial" class="w-10 h-10 border border-zinc-700 hover:border-neon hover:text-neon text-zinc-500 transition-all flex items-center justify-center text-lg">›</button>
            </div>
        </div>

        <!-- Brand Logos -->
        <div class="mt-20 text-center">
            <p class="text-[9px] text-zinc-600 uppercase tracking-[0.8em] mb-8">Empresas & Instituciones</p>
            <div class="flex flex-wrap justify-center gap-10 text-zinc-600 text-xs font-display tracking-widest">
                <?php foreach ($data['brand_logos'] as $logo): ?>
                    <span class="opacity-30 hover:opacity-100 hover:text-neon transition-all cursor-default"><?php echo esc_html($logo); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 7️⃣ CONTACTO - CONVERSIÓN -->
<!-- ============================================ -->
<section id="contacto" class="py-32 px-4 md:px-6 bg-black relative" data-section="contacto">
    <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-24">
            <div>
                <h2 class="text-white font-display text-[7vw] lg:text-6xl font-black uppercase tracking-tighter leading-[0.85] mb-8">
                    ¿Listo para<br>
                    <span class="text-neon">el impacto?</span>
                </h2>
                <p class="text-zinc-500 text-lg font-light max-w-sm mb-12">
                    Agendá una llamada técnica o cotizá directamente por <span
                        class="text-white font-bold">WhatsApp</span>.
                </p>
                <div class="flex flex-col gap-6">
                    <a href="<?php echo dk_whatsapp_url('Hola, vi la web y necesito cotizar un evento'); ?>"
                        class="flex items-center gap-6 group" target="_blank">
                        <div
                            class="w-16 h-16 border border-white/10 flex items-center justify-center group-hover:border-neon transition-colors">
                            <svg class="w-6 h-6 text-white group-hover:text-neon transition-colors" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-[10px] text-zinc-600 uppercase tracking-widest block">Consultas
                                Directas</span>
                            <span
                                class="text-white font-display text-sm tracking-widest"><?php echo esc_html($data['whatsapp_display']); ?></span>
                        </div>
                    </a>
                    <a href="mailto:<?php echo esc_attr($data['email']); ?>" class="flex items-center gap-6 group">
                        <div
                            class="w-16 h-16 border border-white/10 flex items-center justify-center group-hover:border-neon transition-colors">
                            <svg class="w-6 h-6 text-white group-hover:text-neon transition-colors" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect width="20" height="16" x="2" y="4" rx="2" />
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-[10px] text-zinc-600 uppercase tracking-widest block">Email</span>
                            <span
                                class="text-white font-display text-sm tracking-widest"><?php echo esc_html($data['email']); ?></span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="glass-card p-12 relative overflow-hidden">
                <div class="corner-laser corner-laser-tl"></div>
                <div class="corner-laser corner-laser-br"></div>
                <form id="contact-form"
                    action="<?php echo esc_url(get_template_directory_uri() . '/procesar-formulario.php'); ?>"
                    method="POST" class="space-y-8">
                    <div class="relative group">
                        <input type="text" id="nombre" name="nombre" placeholder="TU NOMBRE" required
                            class="w-full bg-transparent border-b border-white/10 py-4 text-white font-display text-xs tracking-widest focus:outline-none focus:border-neon transition-colors placeholder:text-zinc-700">
                    </div>
                    <div class="grid md:grid-cols-2 gap-8">
                        <input type="email" id="email" name="email" placeholder="EMAIL" required
                            class="w-full bg-transparent border-b border-white/10 py-4 text-white font-display text-xs tracking-widest focus:outline-none focus:border-neon transition-colors placeholder:text-zinc-700">
                        <input type="tel" id="telefono" name="telefono" placeholder="WHATSAPP"
                            class="w-full bg-transparent border-b border-white/10 py-4 text-white font-display text-xs tracking-widest focus:outline-none focus:border-neon transition-colors placeholder:text-zinc-700">
                    </div>
                    <div class="grid md:grid-cols-2 gap-8">
                        <select id="servicio" name="servicio"
                            class="w-full bg-transparent border-b border-white/10 py-4 text-white font-display text-[10px] tracking-widest focus:outline-none focus:border-neon transition-colors appearance-none cursor-pointer">
                            <option value="" class="bg-black">TIPO DE EVENTO</option>
                            <option value="boliche" class="bg-black">BOLICHE / DISCO</option>
                            <option value="cultura" class="bg-black">MUNICIPALIDAD / CULTURA</option>
                            <option value="productor" class="bg-black">PRODUCTOR / EMPRESA</option>
                            <option value="show_laserman" class="bg-black">SOLO SHOW LASERMAN</option>
                        </select>
                        <input type="date" name="fecha_evento" placeholder="FECHA DEL EVENTO"
                            class="w-full bg-transparent border-b border-white/10 py-4 text-white font-display text-[10px] tracking-widest focus:outline-none focus:border-neon transition-colors">
                    </div>
                    <div class="relative group">
                        <input type="text" name="ciudad" placeholder="CIUDAD DEL EVENTO"
                            class="w-full bg-transparent border-b border-white/10 py-4 text-white font-display text-xs tracking-widest focus:outline-none focus:border-neon transition-colors placeholder:text-zinc-700">
                    </div>
                    <textarea name="mensaje" placeholder="DETALLES DEL EVENTO" rows="3"
                        class="w-full bg-transparent border-b border-white/10 py-4 text-white font-display text-xs tracking-widest focus:outline-none focus:border-neon transition-colors resize-none placeholder:text-zinc-700"></textarea>

                    <button type="submit"
                        class="w-full py-6 bg-neon text-black font-black uppercase text-xs tracking-[0.3em] hover:bg-white transition-all laser-btn">
                        COTIZÁ AHORA — ES GRATIS &rarr;
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- VIDEO MODAL -->
<div id="videoModal" class="video-modal" onclick="closeVideo()">
    <span class="video-modal-close" onclick="closeVideo()">&times;</span>
    <iframe id="videoFrame" src="" frameborder="0" allowfullscreen allow="autoplay"></iframe>
</div>

<!-- ============================================ -->
<!-- SCRIPTS DE PAGINA -->
<!-- ============================================ -->
<script>
    // Segment Tracking & Auto-Select in Form
    document.querySelectorAll('[data-segment]').forEach(btn => {
        btn.addEventListener('click', e => {
            const segment = btn.getAttribute('data-segment');
            if (typeof window.trackCustomEvent === 'function') {
                window.trackCustomEvent('segment_click', {
                    segment_type: segment,
                    content_category: 'segmentacion',
                    content_name: 'Boton_Segmento_' + segment
                });
            }
            const formSelect = document.querySelector('select[name="servicio"]');
            if (formSelect) {
                const map = { 'boliche': 'boliche', 'cultura': 'cultura', 'productor': 'productor' };
                if (map[segment]) formSelect.value = map[segment];
            }
        });
    });

    // Video Modal
    function openVideo(embedUrl) {
        const modal = document.getElementById('videoModal');
        const frame = document.getElementById('videoFrame');
        frame.src = embedUrl + '?autoplay=1&rel=0&modestbranding=1';
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeVideo() {
        const modal = document.getElementById('videoModal');
        const frame = document.getElementById('videoFrame');
        frame.src = '';
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeVideo(); });

    // Toggle galleries
    function toggleService(serviceId) {
        document.querySelectorAll('.service-expanded').forEach(el => {
            if (el.id !== 'service-' + serviceId) el.classList.remove('active');
        });
        const target = document.getElementById('service-' + serviceId);
        if (target) {
            target.classList.toggle('active');
            if (typeof window.trackCustomEvent === 'function') {
                window.trackCustomEvent('view_item', { item_name: serviceId, item_category: 'services' });
            }
        }
    }

    // 3D Tilt Effect
    document.querySelectorAll('[data-tilt]').forEach(el => {
        el.addEventListener('mousemove', e => {
            const rect = el.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = ((y - centerY) / centerY) * 8;
            const rotateY = ((centerX - x) / centerX) * 8;
            el.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
        });
        el.addEventListener('mouseleave', () => {
            el.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)`;
        });
    });

    // YouTube API
    var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var ytPlayers = {};
    function onYouTubeIframeAPIReady() {
        <?php foreach ($data['videos'] as $index => $video): ?>
            ytPlayers[<?php echo $index; ?>] = new YT.Player('yt-player-<?php echo $index; ?>', {
                events: {
                    'onStateChange': function (e) { handlePlayerState(e, <?php echo $index; ?>, '<?php echo $video['title']; ?>'); }
                }
            });
        <?php endforeach; ?>
    }

    function handlePlayerState(event, index, title) {
        if (event.data === YT.PlayerState.PLAYING) {
            if (typeof window.trackCustomEvent === 'function') {
                window.trackCustomEvent('video_start', { video_title: title });
            }
            startProgress(index, title);
        }
    }

    function startProgress(index, title) {
        const interval = setInterval(() => {
            const player = ytPlayers[index];
            if (!player || player.getPlayerState() !== YT.PlayerState.PLAYING) {
                clearInterval(interval);
                return;
            }
            const duration = player.getDuration();
            const current = player.getCurrentTime();
            const percent = (current / duration) * 100;
            const bar = document.getElementById('progress-' + index);
            if (bar) bar.style.width = percent + '%';

            if (percent >= 90) {
                if (typeof window.trackCustomEvent === 'function') {
                    window.trackCustomEvent('video_complete', { video_title: title });
                }
                clearInterval(interval);
            }
        }, 1000);
    }

    // Scroll Animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('visible');
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

    // Counter Animation
    function animateCounter(el) {
        const target = parseInt(el.dataset.target);
        const suffix = el.dataset.suffix || '';
        const duration = 2000;
        const step = Math.ceil(target / (duration / 16));
        let current = 0;
        const timer = setInterval(() => {
            current = Math.min(current + step, target);
            el.textContent = current + suffix;
            if (current >= target) clearInterval(timer);
        }, 16);
    }
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.querySelectorAll('.stat-number').forEach(animateCounter);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    document.querySelectorAll('.stat-card') .forEach(el => counterObserver.observe(el.closest('div.grid') || el));
    // Trigger on section
    document.querySelectorAll('[class*="stat-card"]').length &&
        counterObserver.observe(document.querySelectorAll('.stat-card')[0].parentElement);

    // Testimonial Carousel
    (function() {
        const track = document.getElementById('testimonial-track');
        if (!track) return;
        const slides = track.querySelectorAll('.testimonial-slide');
        const total = slides.length;
        let current = 0;
        let slidesPerView = window.innerWidth >= 1024 ? 3 : window.innerWidth >= 768 ? 2 : 1;
        const dots = document.querySelectorAll('.testimonial-dot');

        function goTo(index) {
            const max = Math.max(0, total - slidesPerView);
            current = Math.max(0, Math.min(index, max));
            const pct = (100 / slidesPerView) * current;
            track.style.transform = `translateX(-${pct}%)`;
            dots.forEach((d, i) => d.classList.toggle('bg-neon', i === current));
            dots.forEach((d, i) => d.classList.toggle('bg-zinc-700', i !== current));
        }

        document.getElementById('next-testimonial')?.addEventListener('click', () => goTo(current + 1));
        document.getElementById('prev-testimonial')?.addEventListener('click', () => goTo(current - 1));
        dots.forEach((d, i) => d.addEventListener('click', () => goTo(i)));

        // Auto-advance every 5s
        setInterval(() => goTo(current + 1 > total - slidesPerView ? 0 : current + 1), 5000);

        window.addEventListener('resize', () => {
            slidesPerView = window.innerWidth >= 1024 ? 3 : window.innerWidth >= 768 ? 2 : 1;
            goTo(0);
        });
    })();
</script>

<?php get_footer(); ?>
