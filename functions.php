<?php
/**
 * DK Laserman Theme - Functions
 * @package DK_Laserman
 * @version 2026.02
 * ACTUALIZADO: Integrado con Data Layer GTM + Stape + Meta CAPI
 */

if (!defined('ABSPATH'))
    exit;

/**
 * Theme Setup
 */
function dk_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    register_nav_menus(array(
        'primary' => __('Menu Principal', 'dk-laserman'),
    ));
}
add_action('after_setup_theme', 'dk_setup');

/**
 * Enqueue Scripts & Styles
 */
function dk_scripts()
{
    // Google Fonts - AGREGANDO UNBOUNDED PARA ESTÉTICA MINIMALISTA
    wp_enqueue_style('dk-fonts', 'https://fonts.googleapis.com/css2?family=Unbounded:wght@200..900&family=DM+Sans:wght@100..1000&display=swap', array(), null);

    // Tailwind CSS
    wp_enqueue_script('tailwindcss', 'https://cdn.tailwindcss.com', array(), '3.4', false);

    // Theme styles
    wp_enqueue_style('dk-style', get_stylesheet_uri(), array(), '2026.02');

    // Tailwind config - ACTUALIZADO CON TIPOGRAFÍA Y COLORES PREMIUM
    wp_add_inline_script('tailwindcss', "
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['DM Sans', 'sans-serif'],
                        display: ['Unbounded', 'sans-serif'],
                    },
                    colors: {
                        neon: '#00ff1d',
                        dark: '#090f0a',
                        surface: '#0c140d'
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'glow-pulse': 'glowPulse 2s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        glowPulse: {
                            '0%, 100%': { boxShadow: '0 0 20px rgba(0, 255, 29, 0.3)' },
                            '50%': { boxShadow: '0 0 40px rgba(0, 255, 29, 0.6)' },
                        }
                    }
                }
            }
        }
    ");
}
add_action('wp_enqueue_scripts', 'dk_scripts');

/**
 * WhatsApp URL Helper
 */
function dk_whatsapp_url($message = 'Hola, quiero más información')
{
    return 'https://wa.me/5492995920418?text=' . rawurlencode($message);
}

/**
 * Site Data Configuration
 */
function dk_get_site_data()
{
    $uploads = 'https://laserman.com.ar/wp-content/uploads/2026/01';
    $uploads_old = 'https://laserman.com.ar/wp-content/uploads/2025/12';

    return array(
        // Contact
        'whatsapp' => '+5492995920418',
        'whatsapp_display' => '299 592 0418',
        'email' => 'info@laserman.com.ar',
        'phone' => '+54 9 299 592 0418',
        'location' => 'Neuquen, Patagonia Argentina',
        'instagram' => 'https://www.instagram.com/laseryshow/',

        // Images
        'hero_image' => 'https://laserman.com.ar/wp-content/uploads/2026/04/image.png',

        // Logos
        'logo_rionegro' => $uploads . '/LOGO-rio-negro.png',
        'logo_misiones' => $uploads . '/LOGO-misiones.png',
        'logo_formosa' => $uploads . '/LOGO-formosa.png',
        'logo_neuquen' => $uploads . '/LOGO-NEUQUEN2.png',

        // Brand logos
        'brand_logos' => array(
            'Sancor',
            'Banco Patagonia',
            'BPN',
            'Casinos del Río',
            'CAIC'
        ),

        // Stats
        'stats' => array(
            array('number' => '15+', 'label' => 'Años de Trayectoria'),
            array('number' => '50+', 'label' => 'Shows Realizados'),
            array('number' => '8', 'label' => 'Fiestas Nacionales'),
            array('number' => '43', 'label' => 'Ciudades Recorridas'),
        ),

        // Videos (REELS ESTILO 9:16)
        'videos' => array(
            array(
                'url' => 'https://youtube.com/shorts/-vmRI2P1kw8',
                'title' => 'Promo Principal Laserman',
                'thumbnail' => 'https://i.ytimg.com/vi/-vmRI2P1kw8/maxresdefault.jpg'
            ),
            array(
                'url' => 'https://www.youtube.com/shorts/h6-5NnUaf44',
                'title' => 'Fiesta del Chocolate',
                'thumbnail' => 'https://i.ytimg.com/vi/h6-5NnUaf44/maxresdefault.jpg'
            ),
            array(
                'url' => 'https://youtube.com/shorts/rVg2YEs9OWk',
                'title' => 'Fiesta del Pionero',
                'thumbnail' => 'https://i.ytimg.com/vi/rVg2YEs9OWk/maxresdefault.jpg'
            ),
        ),

        // Services (enriched with idealFor, subtitle, videoUrl)
        'services' => array(
            array(
                'id' => 'laserman',
                'icon' => '⚡',
                'title' => 'Show Central Laserman',
                'subtitle' => 'El Nuevo Himno Visual',
                'description' => 'El único espectáculo de este tipo en Latinoamérica. Nuestro artista manipula haces de luz en tiempo real, creando una coreografía futurista sincronizada con la música. Altamente viral - cada asistente filma y comparte.',
                'image' => 'https://laserman.com.ar/wp-content/uploads/2026/04/vision_extract_shot_1771059870-scaled.png',
                'videoUrl' => 'https://youtube.com/shorts/UejPB4htjps',
                'idealFor' => array('Actos de Apertura', 'Eventos Culturales', 'Escenarios Principales'),
                'featured' => true,
                'gallery' => array(
                    'https://laserman.com.ar/wp-content/uploads/2026/04/LASERMAN-007_4_2_2-frame-at-0m16s-e1777785805679.jpg',
                    'https://laserman.com.ar/wp-content/uploads/2026/04/omni-3d65b4f9-ca83-4559-bec1-67709650faf4.png',
                    'https://laserman.com.ar/wp-content/uploads/2026/04/vision_extract_shot_1771383265-scaled.png',
                    'https://laserman.com.ar/wp-content/uploads/2026/04/LASERMAN-007_4_2_1-frame-at-0m21s.jpg',
                    'https://laserman.com.ar/wp-content/uploads/2026/04/videoframe_1099.png',
                    'https://laserman.com.ar/wp-content/uploads/2026/04/ChatGPT-Image-11-feb-2026-22_24_56.png',
                ),
            ),
            array(
                'id' => 'tuneles',
                'icon' => '🚪',
                'title' => 'Túneles',
                'subtitle' => 'Impacto desde el Ingreso',
                'description' => 'La experiencia comienza en la entrada. Creamos túneles inmersivos de luz y sonido que transforman el acceso al predio en una atracción turística por sí misma.',
                'image' => 'https://laserman.com.ar/wp-content/uploads/2026/04/vision_extract_shot_1771058374-scaled.png',
                'videoUrl' => 'https://youtube.com/shorts/ToSEWX40VYk',
                'idealFor' => array('Predios Feriales', 'Aniversarios de Ciudad', 'Fiestas Nacionales'),
                'featured' => false,
                'gallery' => array(
                    'https://laserman.com.ar/wp-content/uploads/2026/05/IMG-20260311-WA0058-scaled.jpg',
                    'https://laserman.com.ar/wp-content/uploads/2026/05/IMG-20260311-WA0056-scaled.jpg',
                    'https://laserman.com.ar/wp-content/uploads/2026/05/IMG-20260222-WA0008-scaled.jpg',
                    'https://laserman.com.ar/wp-content/uploads/2026/05/VideoCapture_20250317-200821.jpg',
                    'https://laserman.com.ar/wp-content/uploads/2026/05/WhatsApp-Image-2024-09-18-at-12.38.32-1.jpeg',
                    'https://laserman.com.ar/wp-content/uploads/2026/05/laserpower-Randers-ugen-2015-07.jpg',
                ),
            ),
            array(
                'id' => 'proyecciones',
                'icon' => '🏔️',
                'title' => 'Mapping y Proyecciones',
                'subtitle' => 'Arquitectura Viva',
                'description' => 'Utilice el patrimonio arquitectónico como lienzo. Proyectamos narrativas históricas, escudos municipales y animaciones sobre Cabildos, Catedrales o Edificios Públicos. Visible a kilómetros.',
                'image' => 'https://laserman.com.ar/wp-content/uploads/2026/04/IMG-20250809-WA00121.jpg',
                'videoUrl' => '',
                'idealFor' => array('Edificios Históricos', 'Monumentos', 'Grandes Superficies'),
                'featured' => false,
                'gallery' => array(
                    'https://laserman.com.ar/wp-content/uploads/2026/04/Gemini_Generated_Image_o10sl9o10sl9o10s-1.png',
                    'https://laserman.com.ar/wp-content/uploads/2026/04/DEOPARTAMENTO-scaled.jpg',
                    'https://laserman.com.ar/wp-content/uploads/2026/04/588201315_1558115451868099_6265983890239278468_n-1.jpg',
                ),
            ),
            array(
                'id' => 'sponsors',
                'icon' => '💰',
                'title' => 'Sponsors & Marcas',
                'subtitle' => 'Rentabilidad Visual',
                'description' => 'Ofrezca a sus patrocinadores una visibilidad que deja obsoleta cualquier publicidad convencional. Logotipos proyectados a gran escala sobre montañas, edificios o cualquier superficie urbana.',
                'image' => 'https://laserman.com.ar/wp-content/uploads/2026/05/Copia-de-Sin-titulo-scaled.jpeg',
                'videoUrl' => '',
                'idealFor' => array('Impacto para Sponsors', 'Campañas Políticas', 'Marca Ciudad'),
                'featured' => false,
                'gallery' => array(
                    'https://laserman.com.ar/wp-content/uploads/2026/05/IMG-20240105-WA0039.jpg',
                    'https://laserman.com.ar/wp-content/uploads/2026/05/20240510_220956-1-scaled.jpg',
                    'https://laserman.com.ar/wp-content/uploads/2026/05/Sin-titulo.jpeg',
                    'https://laserman.com.ar/wp-content/uploads/2026/05/IMG-20231228-WA0063.jpg',
                    'https://laserman.com.ar/wp-content/uploads/2026/05/IMG_0562-scaled.jpeg',
                ),
            ),
            array(
                'id' => 'custom',
                'icon' => '✨',
                'title' => 'Creación de Experiencias',
                'subtitle' => 'Co-creamos lo Imposible',
                'description' => 'Creemos en el poder de las grandes ideas. Si tiene un concepto, por más descabellado que parezca, nuestro equipo acepta el desafío.',
                'image' => 'https://laserman.com.ar/wp-content/uploads/2026/05/1765380823186.png',
                'videoUrl' => '',
                'idealFor' => array('Proyectos Especiales', 'Shows Personalizados', 'Instalaciones Interactivas'),
                'featured' => false,
                'gallery' => array(),
            ),
        ),

        // Feature Cards (propuesta de valor)
        'features' => array(
            array('icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>', 'title' => 'Modernidad', 'desc' => 'Integramos tecnología de punta respetando la identidad cultural de cada fiesta.'),
            array('icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>', 'title' => 'Eficiencia', 'desc' => 'Impacto visual de superproducción optimizando los recursos técnicos.'),
            array('icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>', 'title' => 'Viralidad', 'desc' => 'Diseñamos momentos instagrameables que potencian tu destino en redes sociales.'),
        ),
        'festivals' => array(
            array('name' => 'Fiesta Nacional del Lúpulo', 'location' => 'El Bolsón, Río Negro', 'year' => '2025'),
            array('name' => 'Fiesta Nacional del Chef Patagónico', 'location' => 'Villa Pehuenia, Neuquén', 'year' => '2024'),
            array('name' => 'Fiesta Nacional del Tomate', 'location' => 'Lamarque, Río Negro', 'year' => '2024'),
            array('name' => 'Fiesta Nacional de la Navidad', 'location' => 'Leandro N. Alem, Misiones', 'year' => '2024'),
            array('name' => 'Fiesta de la Actividad Física', 'location' => 'Cipolletti, Río Negro', 'year' => '2024'),
            array('name' => 'Fiesta Nacional del Fútbol Infantil', 'location' => 'Sunchales, Santa Fe', 'year' => '2024'),
            array('name' => 'Fiesta Nacional del Chocolate', 'location' => 'Bariloche, Río Negro', 'year' => '2023'),
            array('name' => 'Fiesta Nacional del Pionero', 'location' => 'Centenario, Neuquén', 'year' => '2023'),
        ),
        'participations2025' => array(
            "Fiesta Nacional del Chef Patagónico – Villa Pehuenia / Moquehue",
            "Fiesta Nacional del Tomate – Lamarque, Río Negro",
            "Fiesta Nacional del Chocolate – Bariloche",
            "Fiesta Nacional del Pionero – Centenario",
            "Fiesta Nacional de la Navidad – Leandro N. Alem, Misiones",
            "Fiesta Nacional de la Actividad Física – Cipolletti, Río Negro",
            "Fiesta Nacional del Fútbol Infantil – Sunchales, Santa Fe",
            "Fiesta Nacional del Lúpulo – El Bolsón, Río Negro"
        ),

        // Testimonials
        'testimonials' => array(
            array(
                'quote' => 'Rompimos los moldes de lo tradicional. Fue algo disruptivo que logró captar la atención, sobre todo de los jóvenes.',
                'name' => 'Julieta Corroza',
                'role' => 'Ministra - Neuquén',
            ),
            array(
                'quote' => 'Nunca se vio algo así. Es único, innovador. La gente filma, saca fotos. Las proyecciones se viralizan solas.',
                'name' => 'Juan Cruz',
                'role' => 'Jefe de Prensa - Fiesta del Pionero',
            ),
            array(
                'quote' => 'La profesionalidad y el impacto del show superaron nuestras expectativas. Fue el punto más comentado del evento.',
                'name' => 'Productora de Shows',
                'role' => 'Buenos Aires',
            ),
        ),
    );
}

/**
 * Declarar funciones de tracking en la cabecera para que estén listas antes de cualquier script
 */
function laserman_define_tracking_globals() {
    ?>
    <script>
        (function() {
            'use strict';
            window.generateEventId = window.generateEventId || function() {
                return 'gtm_' + Math.random().toString(36).substring(2, 15) + '_' + Date.now();
            };
            window.getMetaCookies = window.getMetaCookies || function() {
                var getCookie = function(name) {
                    var value = "; " + document.cookie;
                    var parts = value.split("; " + name + "=");
                    if (parts.length === 2) return parts.pop().split(";").shift();
                    return '';
                };
                return {
                    fbp: getCookie('_fbp') || '',
                    fbc: getCookie('_fbc') || ''
                };
            };
            window.trackCustomEvent = window.trackCustomEvent || function(eventName, eventData) {
                var eventId = window.generateEventId();
                var cookies = window.getMetaCookies();
                window.dataLayer = window.dataLayer || [];
                var payload = {
                    event: eventName,
                    event_id: eventId,
                    fbp: cookies.fbp,
                    fbc: cookies.fbc
                };
                if (eventData && typeof eventData === 'object') {
                    for (var key in eventData) {
                        if (eventData.hasOwnProperty(key)) {
                            payload[key] = eventData[key];
                        }
                    }
                }
                window.dataLayer.push(payload);
                console.log('[GTM Tracking] Evento registrado en DataLayer:', eventName, payload);
            };
        })();
    </script>
    <?php
}
add_action('wp_head', 'laserman_define_tracking_globals', 1);

/**
 * =============================================================================
 * TRACKING SCRIPTS - INTEGRADO CON DATA LAYER GTM
 * Todos los eventos van al dataLayer -> GTM Web -> GTM Server (Stape)
 * =============================================================================
 */
function laserman_tracking_2026()
{
    ?>
    <script>
        (function () {
            'use strict';

            /**
             * Helper para normalizar telefonos argentinos
             */
            function normalizePhoneAR(phone) {
                if (!phone) return '';
                phone = phone.replace(/[^0-9]/g, '');

                if (phone.startsWith('54')) return phone;
                if (phone.startsWith('0')) return '54' + phone.substring(1);
                if (phone.length >= 10 && !phone.startsWith('54')) return '54' + phone;

                return phone;
            }

            document.addEventListener('DOMContentLoaded', function () {

                // =========================================================
                // 1. TRACKING DE SEGMENTOS - Los 3 botones principales
                //    boliche / cultura / productor
                // =========================================================
                document.querySelectorAll('.segment-btn, a[data-segment]').forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        var segment = this.getAttribute('data-segment');
                        if (segment && typeof window.trackCustomEvent === 'function') {
                            window.trackCustomEvent('segment_click', {
                                segment_type: segment,
                                content_category: 'segmentacion',
                                content_name: 'Boton_Segmento_' + segment
                            });
                        }
                    });
                });

                // =========================================================
                // 2. TRACKING DE SECCIONES POR SCROLL (IntersectionObserver)
                //    Reemplaza el trigger por URL que nunca disparaba
                // =========================================================
                var sectionsSeen = {};
                var sectionObserver = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            var sectionName = entry.target.getAttribute('data-section');
                            if (sectionName && !sectionsSeen[sectionName]) {
                                sectionsSeen[sectionName] = true;
                                if (typeof window.trackCustomEvent === 'function') {
                                    window.trackCustomEvent('section_view', {
                                        content_name: sectionName,
                                        content_category: 'seccion',
                                        value: sectionName === 'show-laserman' ? 500 : 300,
                                        currency: 'ARS'
                                    });
                                }
                            }
                        }
                    });
                }, { threshold: 0.3 });

                document.querySelectorAll('[data-section]').forEach(function (section) {
                    sectionObserver.observe(section);
                });

                // =========================================================
                // 3. TRACKING DE WHATSAPP
                // =========================================================
                document.querySelectorAll('a[href*="wa.me"], a[href*="whatsapp"]').forEach(function (link) {
                    link.addEventListener('click', function () {
                        var location = this.closest('section')?.id || this.closest('footer') ? 'footer' : 'unknown';
                        if (typeof window.trackCustomEvent === 'function') {
                            window.trackCustomEvent('whatsapp_click', {
                                button_location: location,
                                contact_method: 'whatsapp',
                                content_name: 'WhatsApp_' + location,
                                value: 1000,
                                currency: 'ARS'
                            });
                        }
                    });
                });

                // =========================================================
                // 4. TRACKING DE FORMULARIO DE CONTACTO
                // =========================================================
                var contactForm = document.getElementById('contact-form');
                if (contactForm) {
                    contactForm.addEventListener('submit', function (e) {
                        e.preventDefault();

                        var nombre = contactForm.querySelector('#nombre');
                        var email = contactForm.querySelector('#email');
                        var telefono = contactForm.querySelector('#telefono');
                        var servicio = contactForm.querySelector('#servicio');

                        var formData = {
                            firstName: nombre ? nombre.value : '',
                            email: email ? email.value : '',
                            phone: normalizePhoneAR(telefono ? telefono.value : ''),
                            lastName: '',
                            servicio: servicio ? servicio.value : ''
                        };

                        // Push form_lead_submit para GTM → Meta CAPI + GA4
                        var eventId = typeof window.generateEventId === 'function' ? window.generateEventId() : (Date.now() + '_' + Math.random().toString(36).substr(2, 9));
                        var cookies = typeof window.getMetaCookies === 'function' ? window.getMetaCookies() : {fbp:'', fbc:''};
                        
                        window.dataLayer = window.dataLayer || [];
                        window.dataLayer.push({
                            event: 'form_lead_submit',
                            event_id: eventId,
                            fbp: cookies.fbp,
                            fbc: cookies.fbc,
                            content_category: formData.servicio || 'general',
                            gtm_user_data: {
                                email: formData.email,
                                phone: formData.phone,
                                first_name: formData.firstName,
                                last_name: formData.lastName
                            }
                        });

                        // Enviar formulario via fetch
                        var fd = new FormData(contactForm);
                        fetch(contactForm.action || window.location.href, {
                            method: 'POST',
                            body: fd
                        })
                            .catch(function (error) {
                                console.error('Error enviando formulario:', error);
                            })
                            .finally(function () {
                                setTimeout(function () {
                                    window.location.href = 'https://laserman.com.ar/gracias';
                                }, 500);
                            });
                    });
                }

                // =========================================================
                // 5. TRACKING DE CONTACTO POR TELEFONO
                // =========================================================
                document.querySelectorAll('a[href^="tel:"]').forEach(function (link) {
                    link.addEventListener('click', function () {
                        if (typeof window.trackCustomEvent === 'function') {
                            window.trackCustomEvent('phone_click', {
                                contact_method: 'phone',
                                content_name: 'Telefono',
                                value: 800,
                                currency: 'ARS'
                            });
                        }
                    });
                });

                // =========================================================
                // 6. TRACKING DE INSTAGRAM
                // =========================================================
                document.querySelectorAll('a[href*="instagram.com"]').forEach(function (link) {
                    link.addEventListener('click', function () {
                        if (typeof window.trackCustomEvent === 'function') {
                            window.trackCustomEvent('social_click', {
                                platform: 'instagram',
                                content_name: 'Instagram_Click'
                            });
                        }
                    });
                });

                // =========================================================
                // 7. MOBILE MENU
                // =========================================================
                window.toggleMobileMenu = function () {
                    var menu = document.getElementById('mobileMenu');
                    if (menu) menu.classList.toggle('open');
                };

                // =========================================================
                // 8. SMOOTH SCROLL
                // =========================================================
                document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
                    anchor.addEventListener('click', function (e) {
                        var href = this.getAttribute('href');
                        if (href === '#' || href === '#!') return;

                        var target = document.querySelector(href);
                        if (target) {
                            e.preventDefault();
                            target.scrollIntoView({ behavior: 'smooth', block: 'start' });

                            var mobileMenu = document.getElementById('mobileMenu');
                            if (mobileMenu && mobileMenu.classList.contains('open')) {
                                mobileMenu.classList.remove('open');
                            }
                        }
                    });
                });

                // =========================================================
                // 9. ANIMACIONES FADE-UP + SCROLL COLORIZE
                // =========================================================
                var fadeObserver = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                        }
                    });
                }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

                document.querySelectorAll('.fade-up').forEach(function (element) {
                    fadeObserver.observe(element);
                });

                var colorizeObserver = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('in-view');
                        }
                    });
                }, { threshold: 0.5 });

                document.querySelectorAll('.scroll-colorize').forEach(function (element) {
                    colorizeObserver.observe(element);
                });

                // =========================================================
                // 10. AUTO-SELECCIONAR SERVICIO EN FORMULARIO SEGUN BOTON
                // =========================================================
                document.querySelectorAll('.seg-btn, a[data-segment]').forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        var segment = this.getAttribute('data-segment');
                        var select = document.getElementById('servicio');
                        if (select && segment) {
                            // Mapear data-segment a value del select
                            var map = {
                                'boliche': 'boliche',
                                'cultura': 'cultura',
                                'productor': 'productor'
                            };
                            if (map[segment]) {
                                select.value = map[segment];
                            }
                        }
                    });
                });

            });
        })();
    </script>
    <?php
}
add_action('wp_footer', 'laserman_tracking_2026', 20);


function dk_body_classes($classes)
{
    $classes[] = 'bg-dark';
    $classes[] = 'text-white';
    $classes[] = 'font-sans';
    return $classes;
}
add_filter('body_class', 'dk_body_classes');

/**
 * Security & Performance
 */
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'wp_generator');

function dk_disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'dk_disable_emojis');
