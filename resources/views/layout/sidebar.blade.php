<aside class="sidebar" id="sidebar">
<div class="brand">
    <svg width="32" height="32" viewBox="0 0 32 32" style="flex:0 0 32px" aria-hidden="true">
        <rect width="32" height="32" rx="5" fill="#F0B429"/>
        <g fill="none" stroke="#1F3864" stroke-width="1.5" stroke-linecap="round">
            <path d="M8 11 C12.5 7.5 19.5 14.5 24 11"/>
            <path d="M8 16 C12.5 12.5 19.5 19.5 24 16"/>
            <path d="M8 21 C12.5 17.5 19.5 24.5 24 21"/>
        </g>
    </svg>
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
        <a href="{{ route('user.view') }}" class="side-link">
            <i class="bi bi-people"></i><span>Users</span>
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
