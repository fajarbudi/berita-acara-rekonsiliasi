<aside class="sidebar" id="sidebar">
    <div class="brand">
        <div class="brand-mark">KT</div>
        <div class="brand-text">
            <b>SIPKD</b>
            <small>BPKAD Kutai Timur</small>
        </div>
    </div>

    <nav class="side-scroll">
        <div class="side-label">Beranda</div>
        <a href="#" class="side-link"><i class="bi bi-grid-1x2"></i><span>Dashboard</span></a>
        <a href="{{ route('berita_acara.view') }}" class="side-link"><i
                class="bi bi-file-earmark-check"></i><span>Berita
                Acara</span></a>

        <div class="side-label">Pengguna</div>
        <a href="{{ route('user.view', ['kewenangan' => 'skpd']) }}" class="side-link">
            <i class="bi bi-people"></i><span>SKPD</span>
        </a>
        <a href="{{ route('user.view', ['kewenangan' => 'skpkd']) }}" class="side-link">
            <i class="bi bi-people"></i><span>SKPKD</span>
        </a>
        <a href="{{ route('user.view', ['kewenangan' => 'admin']) }}" class="side-link">
            <i class="bi bi-people"></i><span>Admin</span>
        </a>

        <div class="side-label">Referensi</div>
        <a href="{{ route('rekening.view') }}" class="side-link"><i class="bi bi-cash-coin"></i><span>Rekening</span>
        </a>
        <a href="{{ route('skpd.view') }}" class="side-link"><i class="bi bi-cash-coin"></i><span>SKPD</span>
        </a>
        <a href="{{ route('belanja.view') }}" class="side-link"><i class="bi bi-basket"></i><span>Belanja</span></a>
        <a href="{{ route('mekanisme.view') }}" class="side-link"><i class="bi bi-gear"></i><span>Mekanisme</span></a>

    </nav>

    <div class="side-foot">
        <i class="bi bi-shield-check"></i> Versi 2.4.1 &middot; TA 2026
    </div>
</aside>
