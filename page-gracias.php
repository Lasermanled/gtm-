<?php
/*
Template Name: Gracias
*/
get_header();
?>

<section class="min-h-screen flex flex-col justify-center items-center text-center px-6 bg-black pt-24">
    <div class="relative max-w-2xl bg-white/[0.02] border border-white/5 p-16 overflow-hidden">
        <div class="absolute -top-24 -left-24 w-64 h-64 bg-neon/5 blur-3xl rounded-full"></div>

        <div class="relative z-10">
            <div class="text-neon text-6xl mb-8 neon-glow italic font-display font-black">OK</div>

            <h1
                class="text-4xl md:text-7xl font-display font-black text-white mb-6 uppercase tracking-tighter leading-none">
                MENSAJE <br><span class="text-neon italic">RECIBIDO</span>
            </h1>

            <p class="text-zinc-500 text-sm font-light uppercase tracking-[0.3em] mb-12">
                Te contactaremos en menos de 24 horas.
            </p>

            <div class="flex flex-col md:flex-row gap-4">
                <a href="https://wa.me/5492994133481" target="_blank"
                    class="flex-1 py-5 bg-neon text-black font-black uppercase text-[10px] tracking-widest hover:bg-white transition-colors">
                    WhatsApp Directo
                </a>
                <a href="<?php echo home_url(); ?>"
                    class="flex-1 py-5 border border-white/10 text-white font-black uppercase text-[10px] tracking-widest hover:bg-white/[0.05] transition-colors">
                    Volver al sitio
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Track conversion en pagina de gracias -->
<script>
    if (typeof window.trackCustomEvent === 'function') {
        window.trackCustomEvent('conversion_complete', {
            content_name: 'Pagina_Gracias',
            content_category: 'conversion',
            value: 2000,
            currency: 'ARS'
        });
    }
</script>

<?php get_footer(); ?>