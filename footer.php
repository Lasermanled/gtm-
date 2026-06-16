<?php $data = dk_get_site_data(); ?>
</main>

<footer class="py-24 bg-black border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 flex flex-col items-center">
        <div class="mb-12">
            <h3 class="text-white font-display font-black text-2xl tracking-tighter italic">
                DK <span class="text-neon neon-glow">LASERMAN</span>
            </h3>
        </div>

        <div class="flex flex-wrap justify-center gap-x-12 gap-y-6 mb-12">
            <a href="https://instagram.com/laseryshow" target="_blank"
                class="text-zinc-600 hover:text-white transition-colors text-[10px] font-black uppercase tracking-[0.4em]">Instagram</a>
            <a href="https://wa.me/5492994133481" target="_blank"
                class="text-zinc-600 hover:text-white transition-colors text-[10px] font-black uppercase tracking-[0.4em]">WhatsApp</a>
            <a href="mailto:info@laserman.com.ar"
                class="text-zinc-600 hover:text-white transition-colors text-[10px] font-black uppercase tracking-[0.4em]">Email</a>
        </div>

        <div class="text-[8px] text-zinc-800 font-display tracking-[0.8em] uppercase">
            &copy; <?php echo date('Y'); ?> DK LASER - ARGENTINA
        </div>
    </div>
</footer>

<!-- WHATSAPP FLOTANTE -->
<a href="<?php echo dk_whatsapp_url('Hola, vi su pagina y me interesa cotizar'); ?>" target="_blank"
    class="fixed bottom-8 right-8 bg-neon w-16 h-16 flex items-center justify-center text-black rounded-full hover:scale-110 transition-transform shadow-lg z-50 neon-box">
    <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654z" />
    </svg>
</a>

<?php wp_footer(); ?>
</body>

</html>