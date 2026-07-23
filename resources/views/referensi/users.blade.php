@extends('layout.base_layout')

@section('content')
    <div class="page-head d-flex align-items-center gap-3 flex-wrap mb-4">
        <div>
            <h1>{{ $halaman_judul }}</h1>
            <p>{{ $halaman_deskripsi }}</p>
        </div>
        {{-- <div class="ms-auto d-flex gap-2">
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#mdlEkspor">
                <i class="bi bi-file-earmark-arrow-down"></i> Ekspor
            </button>
            <button class="btn btn-sm text-white" style="background:var(--bar-navy)" onclick="bukaNew()">
                <i class="bi bi-plus-lg"></i> Tambah Data
            </button>
        </div> --}}
    </div>

    <div class="content">

        <!-- TABLE CARD -->
        <div class="card-bar">
            <div class="card-top">
                <div class="ms-auto d-flex gap-2">
                    <a href="{{ route('user.view') }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </a>
                    <button class="btn btn-sm btn-primary" onclick="bukaFilter()">
                        <i class="bi bi-search"></i> Search
                    </button>
                    @can('isAdmin')
                    <button class="btn btn-sm text-white" style="background:var(--bar-navy)" onclick="bukaNew()">
                        <i class="bi bi-plus-lg"></i> Tambah Data
                    </button>
                    @endcan
                </div>
            </div>
            <!-- TABLE -->
            <div class="table-scroll">
                <table class="grid" id="tbl">
                    <thead>
                        <tr>
                            <th style="width:42px">No.</th>
                            <th data-col="1" onclick="urut(this)">Nama</th>
                            <th data-col="2" onclick="urut(this)">Email</th>
                            <th data-col="3" onclick="urut(this)">Role</th>
                            @can('isAdmin')
                                <th style="width:120px">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($users as $index => $item)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->user_role }}</td>
                                @can('isAdmin')
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="bukaEdit({{ $item }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Hapus"
                                        onclick='bukaHapus({{ $item }})'><i class="bi bi-trash"></i></button>
                                </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="empty d-none" id="kosong">
                    <i class="bi bi-inbox"></i>
                    Tidak ada berita acara yang cocok dengan filter.<br>
                    <button class="btn btn-sm btn-outline-secondary mt-3" onclick="resetFilter()">Hapus filter</button>
                </div>
            </div>

            <!-- FOOT -->
            <div style="min-height: 50px" class="ms-auto p-2 d-flex justify-content-end">
                <div>
                    {!! $users->appends(Request::all())->links() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- ============ MODAL: HAPUS ============ -->
    <div class="modal" id="mdlHapus" tabindex="1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <form id="frmHapus" method="POST" action="{{ route('user.delete') }}">
                @csrf
                <input type="hidden" id="hapusTarget" name='hapusTarget'>
                <div class="modal-content">
                    <div class="modal-header" style="background:#c00000">
                        <div class="modal-title"><i class="bi bi-trash"></i> Hapus Data</div>
                        <button class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <div class="modal-body">
                        <div class="danger-box mb-3">
                            <b>Tindakan ini tidak dapat dibatalkan.</b> Seluruh data yang berkaitan akan dihapus permanen.
                        </div>
                        <p class="mb-2" style="font-size:13px" id="hapusTeks">—</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"
                            type="button">Batal</button>
                        <button class="btn btn-sm btn-danger" id="btnHapus" type="submit">Hapus Permanen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ============ MODAL: Filter ============ -->
    <div class="modal fade" id="mdlFilter" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <div class="modal-title"><i class="bi bi-search"></i> <span>Filter Data</span>
                        </div>
                        <div class="modal-sub">
                        </div>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formFilter" novalidate method="GET" action="{{ route('user.view') }}">
                    <input type="hidden" name="rekening_id" id="rekening_id">
                    <div class="modal-body">
                        <div class="sec-title">Identitas Dokumen</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label req">Nama</label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Masukkan nama pengguna" required name="name"
                                    id="f_name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">SKPD</label>
                                <select class="form-select form-select-sm" id="f_skpd_id" name="skpd_id">
                                    <option value="" selected>-- Pilih SKPD --</option>
                                    @foreach ($ref_skpd as $skpd)
                                        <option value="{{ $skpd->skpd_id }}">
                                            {{ $skpd->skpd_nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label req">Role</label>
                                <select class="form-select form-select-sm" name="user_role" id="f_user_role">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin">Admin</option>
                                    <option value="operator">Operator</option>
                                    <option value="verifikator">Verifikator</option>
                                </select>
                                <div class="invalid-feedback">Role wajib dipilih.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Urutan Data</label>
                                <select class="form-select form-select-sm" id="f_urutan_data" name="urutan_data">
                                    <option value="desc">Terbaru</option>
                                    <option value="asc">Terlama</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-sm text-white" style="background:var(--bar-navy)">
                                <i class="bi bi-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ============ MODAL: BUAT BAR BARU ============ -->
    <div class="modal fade" id="mdlBaru" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <div class="modal-title"><i class="bi bi-file-earmark-plus"></i> <span id="judulModal"></span>
                        </div>
                        <div class="modal-sub" id="deskripsiModal">
                        </div>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formBaru" novalidate method="POST" action="{{ route('user.simpan') }}">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <div class="sec-title">Identitas Users</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label req">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Masukkan nama lengkap" required name="name" id="name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label req">Username</label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Masukkan username" required name="username" id="username">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label req">Email</label>
                                <input type="email" class="form-control form-control-sm" placeholder="Masukkan email"
                                    required name="email" id="email">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label req">Password</label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Masukkan password" required name="password" id="password">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label req">SKPD</label>
                                <select class="form-select form-select-sm" name="skpd_id" id="skpd_id">
                                    <option value="">-- Pilih SKPD --</option>
                                    @foreach ($ref_skpd as $skpd) 
                                        <option value="{{$skpd->skpd_id}}">      {{$skpd->skpd_nama}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label req">Role</label>
                                <select class="form-select form-select-sm" name="user_role" id="user_role">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin">Admin</option>
                                    <option value="operator">Operator</option>
                                    <option value="verifikator">Verifikator</option>
                                </select>
                                <div class="invalid-feedback">Role wajib dipilih.</div>
                            </div>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-sm text-white" style="background:var(--bar-navy)">
                                <i class="bi bi-arrow-right"></i> Simpan Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const judulHalaman = "{{ $halaman_judul }}";
        const deskripsiHalaman = "{{ $halaman_deskripsi }}";

        function bukaNew(data = []) {
            document.getElementById('judulModal').textContent = `Tambah Data ${judulHalaman}`;
            document.getElementById('deskripsiModal').textContent = `Menambahkan data ${judulHalaman} baru.`;
            new bootstrap.Modal('#mdlBaru').show();
        }

        function bukaEdit(data) {
            document.getElementById('judulModal').textContent = `Edit Data ${judulHalaman}`;
            document.getElementById('deskripsiModal').textContent = `Mengubah data ${judulHalaman} yang sudah ada.`;

            Object.entries(data).forEach(([i, val]) => {
                if (val !== null && document.getElementById(i)) {
                    document.getElementById(i).value = val;
                }
            });

            new bootstrap.Modal('#mdlBaru').show();
        }

        function bukaHapus(data) {
            document.getElementById('hapusTarget').value = data.id;
            document.getElementById('hapusTeks').innerHTML = `Data <b>${data.username}</b> akan dihapus.`;
            new bootstrap.Modal('#mdlHapus').show();
        }

        const dataFilter = @json($filterData);
        //set filter value
        Object.entries(dataFilter).forEach(([i, val]) => {
            if (val !== null && document.getElementById(`f_${i}`)) {
                document.getElementById(`f_${i}`).value = val;
            }
        });
        const bukaFilter = () =>{
            new bootstrap.Modal('#mdlFilter').show();
        }
    </script>
@endpush
