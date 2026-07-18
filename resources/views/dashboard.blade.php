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
@endsection
