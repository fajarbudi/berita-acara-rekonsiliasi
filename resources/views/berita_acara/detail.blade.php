@extends('layout.base_layout')

@section('content')
            <div class="page-head d-flex align-items-center gap-3 flex-wrap no-print">
                <div>
                    <h1>Berita Acara Rekonsiliasi</h1>
                    <p>Nomor {{ $data->berita_acara_no_bud }} &middot; Periode {{ $data->berita_acara_periode }} TA
                        {{ $data->berita_acara_tahun_anggaran }}</p>
                </div>
                <div class="ms-auto d-flex gap-2 no-print">
                    <a href="{{ route('berita_acara.view') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('berita_acara.edit', ['id' => $berita_acara_id]) }}" class="btn btn-sm btn-info">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <button class="btn btn-sm btn-secondary" onclick="cetakData()">
                        <i class="bi bi-printer"></i> Cetak / PDF
                    </button>
                    <a href="{{ route('berita_acara.excel', $berita_acara_id) }}" class="btn btn-sm btn-success">
                        <i class="bi bi-file-earmark-excel"></i> Ekspor Excel
                    </a>
                    {{-- <button class="btn btn-sm text-white" style="background:var(--bar-navy)">
                        <i class="bi bi-pen"></i> Tanda Tangani
                    </button> --}}
                </div>
            </div>

            <div class="content">
                <!-- ============ LEMBAR DOKUMEN ============ -->
                <article class="sheet px-auto" id="lembar">
                    <iframe id="print-frame" src="/berita-acara/detailKonten/{{$berita_acara_id}}" style="width: 100%; border: none; height: 80vh;" style="background-color: #1B365D"></iframe>
                </article>
            </div>
@endsection

@push('script')
    <script>
function cetakData(id = 1) {
const iframe = document.getElementById('print-frame');
    
    // Pastikan src mengarah ke route cetak Anda
    iframe.src = `/berita-acara/detailKonten/${id}`;
    
    // Tunggu sampai iframe selesai dimuat, lalu cetak
    iframe.onload = function() {
        iframe.contentWindow.print();
    };
}
    </script>
@endpush