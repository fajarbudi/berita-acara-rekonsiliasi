        @php
            $user = Auth::user();
        @endphp

        <header class="topnav">
            <button class="nav-toggle" onclick="toggleSidebar()" aria-label="Buka tutup sidebar"
                title="Buka / tutup sidebar">
                <i class="bi bi-list"></i>
            </button>

            {{-- <div class="crumb d-none d-md-block">
                Rekonsiliasi <i class="bi bi-chevron-right" style="font-size:9px"></i> <b>Berita Acara</b>
            </div> --}}

            {{-- <div class="nav-search">
    <i class="bi bi-search"></i>
    <input type="search" placeholder="Cari nomor BAR, SKPD, atau SP2D...">
  </div> --}}

            <div class="nav-right">
                {{-- <button class="nav-icon" title="Bantuan"><i class="bi bi-question-circle"></i></button>
    <button class="nav-icon" title="Notifikasi">
      <i class="bi bi-bell"></i><span class="nav-dot"></span>
    </button> --}}

                <div class="dropdown">
                    <button class="user-btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar">{{ substr($user->name, 0, 2) }}</div>
                        <div class="user-meta d-none d-sm-block">
                            <b>{{ $user->name }}</b>
                            <small>{{ $user->user_role }}</small>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li>
                            <h6 class="dropdown-header">{{ $user->name }}</h6>
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil Saya</a>
                        </li>
                        {{-- <li><a class="dropdown-item" href="#"><i class="bi bi-building me-2"></i>Ganti Unit Kerja</a></li> --}}
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
