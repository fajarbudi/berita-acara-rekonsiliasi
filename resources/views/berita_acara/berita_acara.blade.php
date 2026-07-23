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
                    <a href="{{ route('berita_acara.view') }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </a>
                    <button class="btn btn-sm btn-primary" onclick="bukaFilter()">
                        <i class="bi bi-search"></i> Search
                    </button>
                    @can('isVerifikator')
                    <a href="{{ route('berita_acara.new') }}" class="btn btn-sm text-white" style="background:var(--bar-navy)">
                        <i class="bi bi-plus-lg"></i> Tambah Data
                    </a>
                    @endcan
                </div>
            </div>
            <!-- TABLE -->
            <div class="table-scroll">
                <table class="grid" id="tbl">
                    <thead>
                        <tr>
                            <th style="width:42px">No.</th>
                            <th data-col="0">No SKPKD/SKPD</th>
                            <th data-col="0">SKPD</th>
                            <th data-col="1">Periode/Tanggal</th>
                            <th data-col="2">File</th>
                            <th style="width:120px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($datas as $index => $item)
                            <tr>
                                <td>{{ $datas->firstItem() + $index }}</td>
                                <td>
                                    <strong class="me-2">SKPKD : </strong>{{ $item->berita_acara_no_bud }}
                                    <br>
                                    <strong class="me-2">SKPD : </strong>{{ $item->berita_acara_no_skpd }}
                                </td>
                                <td>{{ $item->skpd->skpd_nama}}</td>
                                <td>
                                    <strong>{{$item->berita_acara_periode}}</strong>
                                    <br>
                                    {{ $item->berita_acara_tanggal }}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success mb-2" title="Hapus" {{ $item->berita_acara_file ? '' : 'disabled'}}
                                        onclick='bukaFile("{{ Storage::url($item->berita_acara_file) }}")'>Show File
                                    </button>
                                    <form action="{{ route('berita_acara.upFile', ['id'=> $item->berita_acara_id]) }}" enctype="multipart/form-data" id="formFile{{$item->berita_acara_id}}" method="POST">
                                        @csrf
                                        <input type="file" class="d-none" id="upFile{{$item->berita_acara_id}}" onchange="document.getElementById('formFile{{$item->berita_acara_id}}').submit()" name="berita_acara_file">
                                    </form>
                                    <button class="btn btn-sm text-white" style="background:var(--bar-navy)" onclick="document.getElementById('upFile{{$item->berita_acara_id}}').click()">Upload Berkas</button>
                                </td>
                                <td>
                                    <div class="row gap-2 me-1">
                                    <a href="{{ route('berita_acara.edit', ['id' => $item->berita_acara_id]) }}"
                                        class="btn btn-sm btn-info text-start">
                                        <i class="bi bi-pencil mx-1"></i> Update
                                    </a>
                                    <a href="{{ route('berita_acara.detail', ['id' => $item->berita_acara_id]) }}"
                                        class="btn btn-sm btn-warning text-start">
                                        <i class="bi bi-eye mx-1"></i> Detail
                                    </a>
                                    <a class="btn btn-sm btn-secondary text-start" href="{{ route('berita_acara.cetakPDF', $item->berita_acara_id) }}">
                                        <i class="bi bi-printer mx-1"></i> Pdf
                                    </a>
                                     <a href="{{ route('berita_acara.excel', $item->berita_acara_id) }}" class="btn btn-sm btn-success text-start">
                                        <i class="bi bi-file-earmark-excel mx-1"></i> Excel
                                    </a>
                                    @can('isVerifikator')
                                    <button class="btn btn-sm btn-danger text-start" title="Hapus"
                                        onclick='bukaHapus({{ $item }})' @if ($item->berita_acara_kunci_data == 'ya') disabled @endif >
                                        <i class="bi bi-trash mx-1"></i> Hapus
                                    </button>
                                    @endcan
                                    </div>
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
            <div style="min-height: 50px" class="ms-auto p-2 d-flex justify-content-end">
                <div>
                    {!! $datas->appends(Request::all())->links() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- ============ MODAL: HAPUS ============ -->
    <div class="modal" id="mdlHapus" tabindex="1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <form id="frmHapus" method="POST" action="{{ route('berita_acara.delete') }}">
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

    <div class="modal fade" id="mdlFile" tabindex="-1">
        <div class="modal-dialog" style="max-width: 70vw">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <div class="modal-title"><i class="bi bi-file-earmark-plus"></i> <span id="judulModal">File Berita Acara</span>
                        </div>
                        <div class="modal-sub" id="deskripsiModal">
                        </div>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div>
                    <iframe id="print-frame" style="width: 100%; border: none; height: 80vh;" style="background-color: #1B365D"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- ============ MODAL: Filter ============ -->
    <div class="modal fade" id="mdlFilter" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <div class="modal-title"><i class="bi bi-search"></i> <span id="judulModal">Filter Data</span>
                        </div>
                        <div class="modal-sub" id="deskripsiModal">
                        </div>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formFilter" novalidate method="GET" action="{{ route('berita_acara.view') }}">
                    <input type="hidden" name="rekening_id" id="rekening_id">
                    <div class="modal-body">
                        <div class="sec-title">Identitas Dokumen</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label req">No SKPKD</label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Masukkan No SKPKD" required name="berita_acara_no_bud"
                                    id="f_berita_acara_no_bud">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label req">No SKPD</label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Masukkan No SKPD" required name="berita_acara_no_skpd"
                                    id="f_berita_acara_no_skpd">
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
            document.getElementById('hapusTarget').value = data.berita_acara_id;
            document.getElementById('hapusTeks').innerHTML = `Data <b>${data.berita_acara_no_bud}</b> akan dihapus.`;
            new bootstrap.Modal('#mdlHapus').show();
        }

        const bukaFile = (path) => {
            const iframe = document.getElementById('print-frame');
            iframe.src = path;

            new bootstrap.Modal('#mdlFile').show();
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
