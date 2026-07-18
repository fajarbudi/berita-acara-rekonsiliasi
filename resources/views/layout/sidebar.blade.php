<aside class="sidebar" id="sidebar">
<div class="brand">
    <svg width="60" height="60" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(0,-19)" fill="#F5B740">
            <rect x="48" y="86" width="160" height="12" rx="6"/>
            <rect x="122" y="92" width="12" height="104" rx="6"/>
            <rect x="98" y="196" width="60" height="12" rx="6"/>
            <rect x="51.5" y="92" width="5" height="40" rx="2.5"/>
            <rect x="199.5" y="92" width="5" height="40" rx="2.5"/>
            <path d="M32 132 Q54 156 76 132 Z"/>
            <path d="M180 132 Q202 156 224 132 Z"/>
            <circle cx="128" cy="92" r="9"/>
        </g>
    </svg>
    <div class="brand-text">
        <b>SIPKD</b>
        <small>BPKAD Kutai Timur</small>
    </div>
</div>

    <nav class="side-scroll">
        <div class="side-label">Beranda</div>
        <a href="{{route('dashboard')}}" class="side-link"><i class="bi bi-grid-1x2"></i><span>Dashboard</span></a>
        <a href="{{ route('berita_acara.view') }}" class="side-link"><i
                class="bi bi-file-earmark-check"></i><span>Berita
                Acara</span></a>

        <div class="side-label">Pengguna</div>
        <a href="{{ route('user.view') }}" class="side-link">
            <i class="bi bi-people"></i><span>Users</span>
        </a>

        @can('isVerifikator')
                    <div class="side-label">Referensi</div>
        <a href="{{ route('skpd.view') }}" class="side-link">
            <i class="bi bi-cash-coin"></i><span>SKPD</span>
        </a>
        <a href="{{ route('rekening.view') }}" class="side-link">
            <i class="bi bi-cash-coin"></i><span>Rekening</span>
        </a>
        <a href="{{ route('belanja.view') }}" class="side-link"><i class="bi bi-basket"></i><span>Belanja</span></a>
        @endcan
        {{-- <a href="{{ route('mekanisme.view') }}" class="side-link"><i class="bi bi-gear"></i><span>Mekanisme</span></a> --}}

    </nav>

     <a href="https://web.anauri.id" target="_blank" class="side-foot text-center" style="text-decoration: none">
        <i class="bi bi-shield-check"></i> Powered By Anauri
    </a>
</aside>
