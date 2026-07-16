<script>
    const MOBILE = () => window.matchMedia('(max-width:991.98px)').matches;

    function toggleSidebar() {
        if (MOBILE()) {
            document.body.classList.toggle('drawer');
        } else {
            document.body.classList.toggle('mini');
            localStorage.setItem('sidebarMini', document.body.classList.contains('mini') ? '1' : '0');
        }
    }

    function tutupDrawer() {
        document.body.classList.remove('drawer');
    }

    // Pulihkan preferensi sidebar (desktop saja)
    if (!MOBILE() && localStorage.getItem('sidebarMini') === '1') {
        document.body.classList.add('mini');
    }

    // Esc menutup drawer; ganti breakpoint membersihkan state
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') tutupDrawer();
    });
    window.addEventListener('resize', () => {
        if (!MOBILE()) tutupDrawer();
    });

    // Sinkronkan tinggi iframe dengan isi form
    const frame = document.getElementById('docFrame');

    function sinkronTinggi() {
        try {
            const d = frame.contentDocument;
            if (d) frame.style.height = (d.documentElement.scrollHeight + 24) + 'px';
        } catch (e) {}
    }
    frame.addEventListener('load', () => {
        sinkronTinggi();
        try {
            // Sembunyikan toolbar internal form — tombolnya sudah ada di page header
            const tb = frame.contentDocument.querySelector('.toolbar');
            if (tb) tb.style.display = 'none';
            new ResizeObserver(sinkronTinggi).observe(frame.contentDocument.body);
        } catch (e) {}
    });

    // Jembatan ke fungsi di dalam form
    function frameCall(fn) {
        try {
            frame.contentWindow[fn]();
        } catch (e) {
            alert('Form belum selesai dimuat.');
        }
    }

    function cetakDokumen() {
        frame.contentWindow.focus();
        frame.contentWindow.print();
    }
</script>
