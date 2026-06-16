<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?php wp_title('|', true, 'right'); ?></title>  <?php wp_head(); ?>


  <style>
    :root {
      --neon: #00ff1d;
      --dark: #000000;
      --glass: rgba(255, 255, 255, 0.03);
    }
    * { box-sizing: border-box; cursor: none !important; }
    body { background-color: var(--dark); color: #ffffff; font-family: 'DM Sans', sans-serif; overflow-x: hidden; }

    /* ESTILOS DEL MOUSE LÁSER */
    #laser-cursor {
      position: fixed; top: 0; left: 0; width: 8px; height: 8px; background: var(--neon);
      border-radius: 50%; pointer-events: none; z-index: 9999;
      box-shadow: 0 0 15px var(--neon), 0 0 30px var(--neon);
      mix-blend-mode: screen; will-change: transform;
    }
    #laser-cursor-trail {
      position: fixed; top: 0; left: 0; width: 24px; height: 24px; border: 1px solid var(--neon);
      border-radius: 50%; pointer-events: none; z-index: 9998;
      transition: transform 0.15s ease-out, opacity 0.3s; opacity: 0.3;
    }
    .laser-btn {
      position: relative; overflow: hidden; border: 1px solid rgba(0, 255, 29, 0.3);
      background: rgba(0, 255, 29, 0.02); transition: all 0.3s ease;
    }
    .laser-btn:hover { border-color: var(--neon); box-shadow: 0 0 30px rgba(0, 255, 29, 0.3); }

    header.scrolled { background: rgba(0, 0, 0, 0.85); backdrop-filter: blur(20px); }
    
    .mobile-menu {
      transform: translateX(100%); transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
      position: fixed; inset: 0; background: black; z-index: 9999;
    }
    .mobile-menu.open { transform: translateX(0); }
    @media (hover: none), (pointer: coarse) {
      * { cursor: auto !important; }
      #laser-cursor,
      #laser-cursor-trail { display: none; }
    }
  </style>
</head>

<body <?php body_class(); ?>>


  <!-- ELEMENTOS DEL MOUSE -->
  <div id="laser-cursor"></div>
  <div id="laser-cursor-trail"></div>

  <?php wp_body_open(); ?>

  <script>
    // LÓGICA DEL MOUSE LÁSER
    const cursor = document.getElementById('laser-cursor');
    const trail = document.getElementById('laser-cursor-trail');

    document.addEventListener('mousemove', (e) => {
      const x = e.clientX;
      const y = e.clientY;
      cursor.style.transform = `translate(${x - 4}px, ${y - 4}px)`;
      requestAnimationFrame(() => {
        trail.style.transform = `translate(${x - 12}px, ${y - 12}px)`;
      });
    });

    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('a, button, .laser-btn, .service-card').forEach(el => {
        el.addEventListener('mouseenter', () => {
          cursor.style.transform += ' scale(2.5)';
          trail.style.transform += ' scale(2)';
          trail.style.opacity = '0.7';
        });
        el.addEventListener('mouseleave', () => {
          cursor.style.transform = cursor.style.transform.replace(' scale(2.5)', '');
          trail.style.transform = trail.style.transform.replace(' scale(2)', '');
          trail.style.opacity = '0.3';
        });
      });

      const header = document.getElementById('header');
      const updateHeader = () => header && header.classList.toggle('scrolled', window.scrollY > 24);
      updateHeader();
      window.addEventListener('scroll', updateHeader, { passive: true });
    });

    function toggleMobileMenu() {
      document.getElementById('mobileMenu').classList.toggle('open');
    }
  </script>

  <header id="header" class="fixed top-0 left-0 right-0 z-50 py-6 transition-all">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
      <a href="#inicio"><img src="https://laserman.com.ar/wp-admin/images/Logo-Laserman-01.svg" class="h-8 md:h-10"></a>
      
      <nav class="hidden md:flex items-center gap-12">
        <a href="#servicios" class="text-[10px] text-white/40 hover:text-neon uppercase tracking-widest">Servicios</a>
        <a href="#galeria" class="text-[10px] text-white/40 hover:text-neon uppercase tracking-widest">Videos</a>
        <a href="#clientes" class="text-[10px] text-white/40 hover:text-neon uppercase tracking-widest">Trayectoria</a>
        <a href="#contacto" class="px-8 py-3 border border-neon text-neon text-[9px] uppercase hover:bg-neon hover:text-black">Cotizar</a>
      </nav>

      <button class="md:hidden text-white" onclick="toggleMobileMenu()">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
      </button>
    </div>
  </header>

  <!-- MENÚ MÓVIL -->
  <div id="mobileMenu" class="mobile-menu flex flex-col items-center justify-center gap-8 md:hidden">
    <button onclick="toggleMobileMenu()" class="absolute top-8 right-8 text-white/50 text-2xl">✕</button>
    <a href="#inicio" onclick="toggleMobileMenu()" class="text-2xl text-white">Inicio</a>
    <a href="#servicios" onclick="toggleMobileMenu()" class="text-2xl text-white">Servicios</a>
    <a href="#galeria" onclick="toggleMobileMenu()" class="text-2xl text-white">Videos</a>
    <a href="#clientes" onclick="toggleMobileMenu()" class="text-2xl text-white">Trayectoria</a>
    <a href="#contacto" onclick="toggleMobileMenu()" class="px-10 py-4 bg-neon text-black font-bold">Cotizar</a>
  </div>

  <main>
