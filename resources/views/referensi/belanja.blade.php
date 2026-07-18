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
                    {{-- <button class="btn btn-sm btn-outline-secondary" onclick="resetFilter()">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </button> --}}
                    <button class="btn btn-sm text-white" style="background:var(--bar-navy)" onclick="bukaNew()">
                        <i class="bi bi-plus-lg"></i> Tambah Data
                    </button>
                </div>
            </div>
            <!-- TABLE -->
            <div class="table-scroll">
                <table class="grid" id="tbl">
                    <thead>
                        <tr>
                            <th style="width:42px">No.</th>
                            <th data-col="0">Nama belanja</th>
                            <th data-col="2">Uraian</th>
                            <th style="width:120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($belanjas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->belanja_nama }}</td>
                                <td>{{ $item->belanja_uraian }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" onclick="bukaEdit({{ $item }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn-ico danger" title="Hapus"
                                        onclick='bukaHapus({{ $item }})'><i class="bi bi-trash"></i></button>
                                </td>
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
            <div style="min-height: 50px">
                <div class="ms-auto">
                    {!! $belanjas->appends(Request::all())->links() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- ============ MODAL: HAPUS ============ -->
    <div class="modal" id="mdlHapus" tabindex="1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <form id="frmHapus" method="POST" action="{{ route('belanja.delete') }}">
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
                <form id="formBaru" novalidate method="POST" action="{{ route('belanja.simpan') }}">
                    @csrf
                    <input type="hidden" name="belanja_id" id="belanja_id">
                    <div class="modal-body">
                        <div class="sec-title">Data Belanja</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label req">Nama belanja</label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Masukkan nama belanja" required name="belanja_nama" id="belanja_nama">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label req">Uraian</label>
                                <textarea class="form-control form-control-sm" placeholder="Masukkan uraian" required name="belanja_uraian"
                                    id="belanja_uraian"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-sm text-white" style="background:var(--bar-navy)">
                                <i class="bi bi-arrow-right"></i> Simpan Data
                            </button>
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
            document.getElementById('hapusTarget').value = data.belanja_id;
            document.getElementById('hapusTeks').innerHTML = `Data <b>${data.belanja_nama}</b> akan dihapus.`;
            new bootstrap.Modal('#mdlHapus').show();
        }
    </script>
@endpush
