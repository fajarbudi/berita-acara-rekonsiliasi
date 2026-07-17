{{-- <!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SIPKD — Lihat Berita Acara Rekonsiliasi</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <style>
            :root {
                --bar-navy: #1F3864;
                --bar-navy-soft: #2E4E8F;
                --xl-navy: #1B365D;
                /* warna header tabel persis dari file Excel */
                --xl-tot: #F0F4F8;
                /* warna fill baris total dari file Excel */
                --bar-gold: #F0B429;
                --bar-line: #c9d2e3;
                --bar-bg: #eef1f6;
                --side-w: 262px;
                --side-w-mini: 68px;
                --nav-h: 56px;
            }

            html,
            body {
                height: 100%
            }

            body {
                background: var(--bar-bg);
                font-family: "Segoe UI", system-ui, Arial, sans-serif;
                font-size: 14px;
                color: #1b1b1b;
                overflow-x: hidden
            }

            /* ---------- SIDEBAR ---------- */
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                width: var(--side-w);
                background: linear-gradient(180deg, #1F3864 0%, #152647 100%);
                color: #cdd8ee;
                display: flex;
                flex-direction: column;
                z-index: 1040;
                transition: width .22s ease, transform .22s ease;
                overflow: hidden
            }

            .sidebar .brand {
                height: var(--nav-h);
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 0 18px;
                border-bottom: 1px solid rgba(255, 255, 255, .10);
                flex: 0 0 auto;
                white-space: nowrap
            }

            .brand-mark {
                width: 32px;
                height: 32px;
                flex: 0 0 32px;
                border-radius: 6px;
                background: var(--bar-gold);
                color: var(--bar-navy);
                display: grid;
                place-items: center;
                font-weight: 800;
                font-size: 13px;
                letter-spacing: -.5px
            }

            .brand-text b {
                color: #fff;
                font-size: 15px;
                letter-spacing: .4px;
                display: block;
                line-height: 1.1
            }

            .brand-text small {
                color: #8fa4cc;
                font-size: 10.5px;
                letter-spacing: .5px;
                text-transform: uppercase
            }

            .side-scroll {
                overflow-y: auto;
                overflow-x: hidden;
                padding: 12px 0 20px;
                flex: 1 1 auto
            }

            .side-scroll::-webkit-scrollbar {
                width: 6px
            }

            .side-scroll::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, .16);
                border-radius: 3px
            }

            .side-label {
                font-size: 10px;
                font-weight: 700;
                letter-spacing: 1.2px;
                text-transform: uppercase;
                color: #7b90b8;
                padding: 14px 20px 6px;
                white-space: nowrap
            }

            .side-link {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 9px 20px;
                color: #cdd8ee;
                text-decoration: none;
                font-size: 13.5px;
                border-left: 3px solid transparent;
                white-space: nowrap;
                transition: background .14s, color .14s
            }

            .side-link i {
                font-size: 16px;
                flex: 0 0 18px;
                text-align: center
            }

            .side-link:hover {
                background: rgba(255, 255, 255, .07);
                color: #fff
            }

            .side-link.active {
                background: rgba(240, 180, 41, .14);
                color: #fff;
                font-weight: 600;
                border-left-color: var(--bar-gold)
            }

            .side-link .badge {
                margin-left: auto;
                font-size: 10px
            }

            .side-link .chev {
                margin-left: auto;
                font-size: 11px;
                transition: transform .18s
            }

            .side-link[aria-expanded="true"] .chev {
                transform: rotate(90deg)
            }

            .side-sub .side-link {
                padding-left: 50px;
                font-size: 13px;
                color: #a9bad9
            }

            .side-foot {
                flex: 0 0 auto;
                border-top: 1px solid rgba(255, 255, 255, .10);
                padding: 12px 18px;
                font-size: 11.5px;
                color: #8fa4cc;
                white-space: nowrap
            }

            body.mini .sidebar {
                width: var(--side-w-mini)
            }

            body.mini .brand-text,
            body.mini .side-label,
            body.mini .side-link span,
            body.mini .side-link .badge,
            body.mini .side-link .chev,
            body.mini .side-foot,
            body.mini .side-sub {
                display: none
            }

            body.mini .side-link {
                justify-content: center;
                padding: 11px 0
            }

            body.mini .brand {
                justify-content: center;
                padding: 0
            }

            body.mini .main {
                margin-left: var(--side-w-mini)
            }

            body.mini .topnav {
                left: var(--side-w-mini)
            }

            /* ---------- NAVBAR ---------- */
            .topnav {
                position: fixed;
                top: 0;
                right: 0;
                left: var(--side-w);
                height: var(--nav-h);
                background: #fff;
                border-bottom: 1px solid #dfe4ec;
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 0 18px;
                z-index: 1030;
                transition: left .22s ease
            }

            .nav-toggle {
                border: 0;
                background: transparent;
                font-size: 20px;
                color: var(--bar-navy);
                width: 36px;
                height: 36px;
                border-radius: 6px;
                display: grid;
                place-items: center
            }

            .nav-toggle:hover {
                background: #eef1f6
            }

            .crumb {
                font-size: 12.5px;
                color: #5b6474
            }

            .crumb b {
                color: var(--bar-navy)
            }

            .crumb a {
                color: #5b6474;
                text-decoration: none
            }

            .crumb a:hover {
                color: var(--bar-navy)
            }

            .nav-right {
                margin-left: auto;
                display: flex;
                align-items: center;
                gap: 6px
            }

            .nav-icon {
                position: relative;
                border: 0;
                background: transparent;
                width: 36px;
                height: 36px;
                border-radius: 6px;
                color: #4a5567;
                font-size: 16px;
                display: grid;
                place-items: center
            }

            .nav-icon:hover {
                background: #eef1f6;
                color: var(--bar-navy)
            }

            .nav-dot {
                position: absolute;
                top: 7px;
                right: 8px;
                width: 7px;
                height: 7px;
                border-radius: 50%;
                background: #d93025;
                border: 1.5px solid #fff
            }

            .avatar {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                background: var(--bar-navy-soft);
                color: #fff;
                display: grid;
                place-items: center;
                font-size: 12px;
                font-weight: 700
            }

            .user-btn {
                display: flex;
                align-items: center;
                gap: 9px;
                border: 0;
                background: transparent;
                padding: 4px 6px;
                border-radius: 6px
            }

            .user-btn:hover {
                background: #eef1f6
            }

            .user-meta {
                text-align: left;
                line-height: 1.2
            }

            .user-meta b {
                font-size: 12.5px;
                color: #1b1b1b;
                display: block
            }

            .user-meta small {
                font-size: 10.5px;
                color: #7b8494
            }

            /* ---------- MAIN ---------- */
            .main {
                margin-left: var(--side-w);
                padding-top: var(--nav-h);
                min-height: 100vh;
                transition: margin-left .22s ease
            }

            .page-head {
                background: #fff;
                border-bottom: 1px solid #dfe4ec;
                padding: 14px 24px
            }

            .page-head h1 {
                font-size: 17px;
                font-weight: 700;
                margin: 0;
                color: var(--bar-navy)
            }

            .page-head p {
                margin: 2px 0 0;
                font-size: 12.5px;
                color: #6b7482
            }

            .content {
                padding: 20px 24px 44px
            }

            .backdrop {
                position: fixed;
                inset: 0;
                background: rgba(15, 25, 45, .5);
                z-index: 1035;
                display: none
            }

            body.drawer .backdrop {
                display: block
            }

            .chip {
                font-size: 10.5px;
                font-weight: 600;
                padding: 3px 9px;
                border-radius: 20px;
                display: inline-flex;
                align-items: center;
                gap: 4px;
                white-space: nowrap;
                border: 1px solid
            }

            .c-wait {
                background: #fff6e0;
                color: #8a5a00;
                border-color: #f0d38a
            }

            /* ---------- LEMBAR DOKUMEN (meniru worksheet) ---------- */
            .sheet {
                background: #fff;
                max-width: 1000px;
                margin: 0 auto;
                padding: 38px 46px 46px;
                border: 1px solid #dfe4ec;
                box-shadow: 0 2px 14px rgba(20, 35, 70, .10);
            }

            /* Excel memakai Arial 10pt untuk badan dokumen */
            .sheet,
            .sheet table {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 10pt
            }

            .doc-title {
                text-align: center;
                line-height: 1.45;
                margin-bottom: 18px
            }

            .doc-title h1 {
                font-size: 14pt;
                font-weight: 700;
                margin: 0
            }

            /* A1: bold 14pt */
            .doc-title h2,
            .doc-title h3 {
                font-size: 11pt;
                font-weight: 700;
                margin: 0
            }

            /* A2,A3: bold 11pt */
            .doc-no {
                text-align: center;
                font-style: italic;
                font-size: 10pt;
                line-height: 1.5;
                margin-bottom: 20px
            }

            .pembuka {
                text-align: justify;
                line-height: 1.5;
                margin-bottom: 14px
            }

            /* blok para pihak — meniru kolom A(No) B(Label) C(Isi) */
            .pihak {
                margin: 0 0 12px;
                padding: 0;
                list-style: none
            }

            .pihak>li {
                display: flex;
                gap: 8px;
                margin-bottom: 12px
            }

            .pihak .urut {
                flex: 0 0 22px;
                text-align: right
            }

            .pihak .isi {
                flex: 1 1 auto
            }

            .baris {
                display: flex;
                gap: 6px;
                line-height: 1.55
            }

            .baris .lbl {
                flex: 0 0 96px
            }

            /* kolom B = 13.45 char */
            .baris .sep {
                flex: 0 0 8px
            }

            .baris .val {
                flex: 1 1 auto
            }

            .ket-pihak {
                margin-top: 4px;
                text-align: justify;
                line-height: 1.5
            }

            .sec {
                color: var(--xl-navy);
                font-weight: 700;
                font-size: 11pt;
                margin: 24px 0 6px;
            }

            .sec-desc {
                text-align: justify;
                line-height: 1.5;
                margin-bottom: 8px
            }

            /* ---------- TABEL (persis kisi Excel) ---------- */
            table.xl {
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed
            }

            table.xl th,
            table.xl td {
                border: 1px solid #7f7f7f;
                /* garis kisi tipis seperti Excel */
                padding: 4px 6px;
                vertical-align: middle;
                word-wrap: break-word;
            }

            table.xl thead th {
                background: var(--xl-navy);
                color: #fff;
                font-weight: 700;
                font-size: 10pt;
                text-align: center;
                line-height: 1.25;
            }

            table.xl tbody td {
                font-size: 10pt
            }

            table.xl tr.tot td {
                background: var(--xl-tot);
                font-weight: 700
            }

            .c {
                text-align: center
            }

            .r {
                text-align: right
            }

            .num {
                text-align: right;
                font-variant-numeric: tabular-nums;
                white-space: nowrap
            }

            .neg {
                color: #FF0000
            }

            /* format [Red]-#,##0.00 dari Excel */
            .lbl-tot {
                text-align: right;
                font-weight: 700;
                background: #fff
            }

            /* lebar kolom mengikuti column width Excel (A5 B13.45 C24 D17 E17 F14.45 G11.54) */
            col.cA {
                width: 4.5%
            }

            col.cB {
                width: 12.5%
            }

            col.cC {
                width: 22.5%
            }

            col.cD {
                width: 15.5%
            }

            col.cE {
                width: 15.5%
            }

            col.cF {
                width: 13.5%
            }

            col.cG {
                width: 16%
            }

            .catatan {
                font-style: italic;
                line-height: 1.6;
                margin: 6px 0 0
            }

            /* tanda tangan */
            .ttd {
                display: flex;
                gap: 24px;
                margin-top: 26px
            }

            .ttd>div {
                flex: 1 1 50%;
                text-align: center;
                line-height: 1.5
            }

            .ttd .ruang {
                height: 64px
            }

            .ttd .nm {
                font-weight: 700
            }

            .doc-foot {
                display: flex;
                justify-content: space-between;
                font-size: 8pt;
                color: #666;
                border-top: 1px solid #dfe4ec;
                margin-top: 30px;
                padding-top: 8px;
            }

            @media (max-width:991.98px) {
                .sidebar {
                    transform: translateX(-100%);
                    width: var(--side-w)
                }

                body.drawer .sidebar {
                    transform: translateX(0)
                }

                body.mini .sidebar {
                    width: var(--side-w)
                }

                body.mini .brand-text,
                body.mini .side-label,
                body.mini .side-link span,
                body.mini .side-link .chev,
                body.mini .side-foot,
                body.mini .side-sub {
                    display: revert
                }

                body.mini .side-link {
                    justify-content: flex-start;
                    padding: 9px 20px
                }

                body.mini .brand {
                    justify-content: flex-start;
                    padding: 0 18px
                }

                .main,
                body.mini .main {
                    margin-left: 0
                }

                .topnav,
                body.mini .topnav {
                    left: 0
                }

                .content {
                    padding: 12px 8px 30px
                }

                .sheet {
                    padding: 20px 14px
                }

                .tbl-scroll {
                    overflow-x: auto
                }

                table.xl {
                    min-width: 660px
                }
            }
        </style>
    </head>

    <body>

        <!-- ============ SIDEBAR ============ -->
        @include('layout.sidebar')
        <div class="backdrop" onclick="tutupDrawer()"></div>

        <!-- ============ NAVBAR ============ -->
        @include('layout.navbar')

        <!-- ============ MAIN ============ -->
        <main class="main">
            <div class="page-head d-flex align-items-center gap-3 flex-wrap">
                <div>
                    <h1>Berita Acara Rekonsiliasi <span class="chip c-wait ms-1"><i class="bi bi-hourglass-split"></i>
                            Menunggu TTD</span></h1>
                    <p>Nomor {{ $data->berita_acara_no_bud }} &middot; Periode {{ $data->berita_acara_periode }} TA
                        {{ $data->berita_acara_tahun_anggaran }}</p>
                </div>
                <div class="ms-auto d-flex gap-2 no-print">
                    <a href="{{ route('berita_acara.view') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                        <i class="bi bi-printer"></i> Cetak / PDF
                    </button>
                    <a href="{{ route('berita_acara.excel', $berita_acara_id) }}" class="btn btn-sm btn-outline-success">
                        <i class="bi bi-file-earmark-excel"></i> Ekspor Excel
                    </a>
                    <button class="btn btn-sm text-white" style="background:var(--bar-navy)">
                        <i class="bi bi-pen"></i> Tanda Tangani
                    </button>
                </div>
            </div>

            <div class="content">
                <!-- ============ LEMBAR DOKUMEN ============ -->
                <article class="sheet" id="lembar">

                    <!-- Baris 1–3 -->
                    <div class="doc-title">
                        <h1>BERITA ACARA REKONSILIASI PENERIMAAN DAN PENGELUARAN</h1>
                        <h2>ANTARA SKPKD DAN SKPD</h2>
                        <h3>PERIODE {{ $data->berita_acara_periode }} TAHUN ANGGARAN
                            {{ $data->berita_acara_tahun_anggaran }}</h3>
                    </div>

                    <!-- Baris 5–6 -->
                    <div class="doc-no">
                        Nomor BAR (BUD) : {{ $data->berita_acara_no_bud }}<br>
                        Nomor BAR (SKPD) : {{ $data->berita_acara_no_skpd }}
                    </div>

                    <!-- Baris 8 -->
                    <p class="pembuka">
                        Pada hari ini, {{$terbilang['hari']}} tanggal {{$terbilang['tanggal']}} bulan {{$terbilang['bulan']}} tahun {{$terbilang['tahun']}},
                        bertempat di Kantor Badan Pengelolaan Keuangan dan Aset Daerah, kami yang
                        bertandatangan di bawah ini:
                    </p>

                    <!-- Baris 10–16 -->
                    <ol class="pihak">
                        <li>
                            <div class="urut">1.</div>
                            <div class="isi">
                                <div class="baris"><span class="lbl">Nama / NIP</span><span
                                        class="sep">:</span><span class="val">Ichtiawan J. Aziz, S.E.I / NIP.
                                        198506162020121006</span></div>
                                <div class="baris"><span class="lbl">Jabatan</span><span
                                        class="sep">:</span><span class="val">Kepala Sub Bidang Penerimaan dan
                                        Belanja</span></div>
                                <div class="ket-pihak">
                                    Dalam hal ini bertindak untuk dan atas nama BPKAD selaku SKPKD Pemerintah
                                    Kabupaten Kutai Timur, selanjutnya disebut PIHAK KESATU.
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="urut">2.</div>
                            <div class="isi">
                                <div class="baris"><span class="lbl">Nama / NIP</span><span
                                        class="sep">:</span><span class="val">Budi Santoso, S.E. / NIP.
                                        198203142009011004</span></div>
                                <div class="baris"><span class="lbl">Jabatan</span><span
                                        class="sep">:</span><span class="val">Pejabat Penatausahaan Keuangan
                                        (PPK-SKPD)</span></div>
                                <div class="ket-pihak">
                                    Dalam hal ini bertindak untuk dan atas nama Dinas Pendidikan, selanjutnya
                                    disebut PIHAK KEDUA.
                                </div>
                            </div>
                        </li>
                    </ol>

                    <!-- Baris 18 -->
                    <p class="pembuka">
                        PIHAK KESATU dan PIHAK KEDUA secara bersama-sama telah melakukan rekonsiliasi data
                        Penerimaan (Pendapatan) dan Pengeluaran (Belanja) sampai dengan periode Juni Tahun
                        Anggaran 2026, dengan hasil kesepakatan sebagai berikut:
                    </p>

                    <!-- ===== I. PENERIMAAN (baris 20–26) ===== -->
                    <div class="sec">I. REKONSILIASI PENERIMAAN (PENDAPATAN)</div>
                    <p class="sec-desc">
                        Berdasarkan pencatatan pada Buku Kas Umum (BKU) Penerimaan SKPD dan Catatan Kas
                        Daerah (BUD), realisasi pendapatan adalah sebagai berikut:
                    </p>
                    <div class="tbl-scroll">
                        <table class="xl" id="tPend">
                            <colgroup>
                                <col class="cA">
                                <col class="cB">
                                <col class="cC">
                                <col class="cD">
                                <col class="cE">
                                <col class="cF">
                                <col class="cG">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Rekening</th>
                                    <th>Uraian Pendapatan</th>
                                    <th>Catatan SKPD<br>(Rp)</th>
                                    <th>Catatan BUD<br>(Rp)</th>
                                    <th>Selisih<br>(Rp)</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totPendapatanSKPD = $data_pendapatan->sum('skpd');
                                    $totpendapatanBUD = $data_pendapatan->sum('bud');
                                    $selisihPendapatan = $totPendapatanSKPD - $totpendapatanBUD;
                                @endphp
                                @foreach ($data_pendapatan as $index => $pendapatan)
                                    <tr>
                                        <td class="c">{{ $index + 1 }}</td>
                                        <td class="c">{{ $pendapatan->rekening_kode }}</td>
                                        <td>{{ $pendapatan->rekening_uraian }}</td>
                                        <td class="num" data-v="{{ $pendapatan->skpd }}">
                                            {{ number_format($pendapatan->skpd, 2, ',', '.') }}</td>
                                        <td class="num" data-v="{{ $pendapatan->bud }}">
                                            {{ number_format($pendapatan->bud, 2, ',', '.') }}</td>
                                        <td class="num" data-v="{{ $pendapatan->selisih }}">
                                            {{ number_format($pendapatan->selisih, 2, ',', '.') }}</td>
                                        <td class="c">{{ $pendapatan->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="tot">
                                    <td colspan="3" class="lbl-tot">TOTAL PENERIMAAN</td>
                                    <td class="num" data-v="{{ $totPendapatanSKPD }}">
                                        {{ number_format($totPendapatanSKPD, 2, ',', '.') }}
                                    </td>
                                    <td class="num" data-v="{{ $totpendapatanBUD }}">
                                        {{ number_format($totpendapatanBUD, 2, ',', '.') }}
                                    </td>
                                    <td class="num" data-v="{{ $selisihPendapatan }}">
                                        {{ number_format($selisihPendapatan, 2, ',', '.') }}</td>
                                    <td class="c">
                                        {{ $selisihPendapatan == 0 ? 'Sesuai' : 'Tidak Sesuai' }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- ===== II. BELANJA (baris 28–40) ===== -->
                    <div class="sec">II. REKONSILIASI PENGELUARAN (BELANJA)</div>
                    <p class="sec-desc">
                        Berdasarkan penerbitan Surat Perintah Pencairan Dana (SP2D) oleh BUD dan Surat
                        Pertanggungjawaban (SPJ) Pengeluaran oleh SKPD, realisasi belanja adalah sebagai
                        berikut:
                    </p>
                    <div class="tbl-scroll">
                        <table class="xl" id="tBel">
                            <colgroup>
                                <col class="cA">
                                <col class="cB">
                                <col class="cC">
                                <col class="cD">
                                <col class="cE">
                                <col class="cF">
                                <col class="cG">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis / Mekanisme Belanja</th>
                                    <th>Uraian</th>
                                    <th>Catatan SKPD<br>(Rp)</th>
                                    <th>Catatan BUD<br>(Rp)</th>
                                    <th>Selisih<br>(Rp)</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totBelanjaSKPD = $data_belanja->sum('skpd');
                                    $totBelanjaBUD = $data_belanja->sum('bud');
                                    $selisihBelanja = $totBelanjaSKPD - $totBelanjaBUD;
                                @endphp
                                @foreach ($data_belanja as $index => $belanja)
                                    <tr>
                                        <td class="c">{{ $index + 1 }}</td>
                                        <td>{{ $belanja->belanja_nama }}</td>
                                        <td>{{ $belanja->belanja_uraian }}</td>
                                        <td class="num" data-v="{{ $belanja->skpd }}">
                                            {{ number_format($belanja->skpd, 2, ',', '.') }}</td>
                                        <td class="num" data-v="{{ $belanja->bud }}">
                                            {{ number_format($belanja->bud, 2, ',', '.') }}</td>
                                        <td class="num" data-v="{{ $belanja->selisih }}">
                                            {{ number_format($belanja->selisih, 2, ',', '.') }}</td>
                                        <td class="c">{{ $belanja->keterangan }}</td>
                                    </tr>
                                @endforeach
                                <tr class="tot">
                                    <td colspan="3" class="lbl-tot">TOTAL BELANJA (JENIS)</td>
                                    <td class="num" data-v="{{ $totBelanjaSKPD }}">
                                        {{ number_format($totBelanjaSKPD, 2, ',', '.') }}</td>
                                    <td class="num" data-v="{{ $totBelanjaBUD }}">
                                        {{ number_format($totBelanjaBUD, 2, ',', '.') }}</td>
                                    <td class="num" data-v="{{ $selisihBelanja }}">
                                        {{ number_format($selisihBelanja, 2, ',', '.') }}</td>
                                    <td class="c">
                                        {{ $selisihBelanja == 0 ? 'Sesuai' : 'Tidak Sesuai' }}</td>
                                </tr>
                                @php
                                    $totMekanismeSKPD = $data_mekanisme->sum('skpd');
                                    $totMekanismeBUD = $data_mekanisme->sum('bud');
                                    $selisihMekanisme = $totMekanismeSKPD - $totMekanismeBUD;
                                @endphp
                                @foreach ($data_mekanisme as $mekanisme)
                                    <tr>
                                        <td class="c">{{ $loop->iteration }}</td>
                                        <td>{{ $mekanisme->mekanisme_nama }}</td>
                                        <td>{{ $mekanisme->mekanisme_uraian }}</td>
                                        <td class="num" data-v="{{ $mekanisme->skpd }}">
                                            {{ number_format($mekanisme->skpd, 2, ',', '.') }}</td>
                                        <td class="num" data-v="{{ $mekanisme->bud }}">
                                            {{ number_format($mekanisme->bud, 2, ',', '.') }}</td>
                                        <td class="num" data-v="{{ $mekanisme->selisih }}">
                                            {{ number_format($mekanisme->selisih, 2, ',', '.') }}</td>
                                        <td class="c">{{ $mekanisme->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @php
                                $selisihPotensiSKPD = $totMekanismeSKPD - $totBelanjaSKPD;
                                $selisihPotensiBUD = $totMekanismeBUD - $totBelanjaBUD;
                                $selisihPotensi = $selisihPotensiBUD - $selisihPotensiSKPD;
                            @endphp
                            <tfoot>
                                <tr class="tot">
                                    <td colspan="3" class="lbl-tot">TOTAL BELANJA (MEKANISME)</td>
                                    <td class="num" data-v="{{ $totMekanismeSKPD }}">
                                        {{ number_format($totMekanismeSKPD, 2, ',', '.') }}
                                    </td>
                                    <td class="num" data-v="{{ $totMekanismeBUD }}">
                                        {{ number_format($totMekanismeBUD, 2, ',', '.') }}
                                    </td>
                                    <td class="num" data-v="{{ $selisihMekanisme }}">
                                        {{ number_format($selisihMekanisme, 2, ',', '.') }}
                                    </td>
                                    <td class="c">{{ $selisihMekanisme == 0 ? 'Sesuai' : 'Potensi' }}</td>
                                </tr>
                                <tr class="tot">
                                    <td colspan="3" class="lbl-tot">SELISIH (POTENSI SISA UP/GU/TU)</td>
                                    <td class="num" data-v="{{ $selisihPotensiSKPD }}">
                                        {{ number_format($selisihPotensiSKPD, 2, ',', '.') }}
                                    </td>
                                    <td class="num" data-v="{{ $selisihPotensiBUD }}">
                                        {{ number_format($selisihPotensiBUD, 2, ',', '.') }}
                                    </td>
                                    <td class="num" data-v="{{ $selisihPotensi }}">
                                        {{ number_format($selisihPotensi, 2, ',', '.') }}
                                    </td>
                                    <td class="c">{{ $selisihPotensi == 0 ? 'Sesuai' : 'Potensi' }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- ===== III. SALDO KAS (baris 42–48) ===== -->
                    <div class="sec">III. REKONSILIASI SALDO KAS DAN SISA UP/GU/TU</div>
                    <div class="tbl-scroll">
                        <table class="xl" id="tSaldo">
                            <colgroup>
                                <col class="cA">
                                <col style="width:56.5%">
                                <col class="cF">
                                <col style="width:26%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Uraian Saldo Kas</th>
                                    <th>Jumlah<br>(Rp)</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="c">1</td>
                                    <td>Saldo Awal Bulan Kas di Bendahara Pengeluaran</td>
                                    <td class="num" data-v="234840000">234.840.000,00</td>
                                    <td class="c">Kas Awal Bulan</td>
                                </tr>
                                <tr>
                                    <td class="c">2</td>
                                    <td>Penerimaan SP2D (UP/GU/TU) Periode Ini</td>
                                    <td class="num" data-v="224026427">224.026.427,00</td>
                                    <td class="c">Pencairan UP/GU/TU</td>
                                </tr>
                                <tr>
                                    <td class="c">3</td>
                                    <td>Pengeluaran BKU (SPJ Belanja UP/GU/TU)</td>
                                    <td class="num neg" data-v="-224026427">-224.026.427,00</td>
                                    <td class="c">Realisasi UP/GU/TU</td>
                                </tr>
                                <tr>
                                    <td class="c">4</td>
                                    <td>Pengembalian Sisa UP/GU/TU (STS/S3UP)</td>
                                    <td class="num" data-v="0">0,00</td>
                                    <td class="c">Penyetoran Sisa Kas</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="tot">
                                    <td colspan="2" class="lbl-tot">SALDO AKHIR KAS DI BENDAHARA PENGELUARAN</td>
                                    <td class="num" data-v="234840000">234.840.000,00</td>
                                    <td class="c">Sesuai</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- ===== IV. CATATAN (baris 50–52) ===== -->
                    <div class="sec">IV. CATATAN DAN KESIMPULAN</div>
                    <p class="catatan">
                        1. Data Penerimaan dan Pengeluaran antara BUD dan SKPD untuk periode ini dinyatakan
                        TELAH SESUAI / COCOK.
                    </p>
                    <p class="catatan">
                        2. Berita Acara ini dibuat dalam rangkap 2 (dua) sebagai bahan penyusunan Laporan
                        Keuangan Pemerintah Daerah (LKPD).
                    </p>

                    <!-- ===== TANDA TANGAN (baris 55–72) ===== -->
                    <div class="ttd">
                        <div>
                            <div class="fw-bold">PIHAK KEDUA</div>
                            <div>Pejabat Penatausahaan Keuangan (PPK-SKPD)</div>
                            <div class="ruang"></div>
                            <div class="nm">Budi Santoso, S.E.</div>
                            <div>NIP. 198203142009011004</div>
                        </div>
                        <div>
                            <div class="fw-bold">PIHAK KESATU</div>
                            <div>Kepala Sub Bidang Penerimaan dan Belanja</div>
                            <div class="ruang"></div>
                            <div class="nm">Ichtiawan J. Aziz, S.E.I</div>
                            <div>NIP. 198506162020121006</div>
                        </div>
                    </div>

                    <div class="ttd">
                        <div>
                            <div class="fw-bold">MENGETAHUI / MENYETUJUI:</div>
                            <div>Pengguna Anggaran</div>
                            <div class="ruang"></div>
                            <div class="nm">Dr. H. Suprihanto, M.Pd.</div>
                            <div>NIP. 196908121994031008</div>
                        </div>
                        <div>
                            <div class="fw-bold">MENGETAHUI / MENYETUJUI:</div>
                            <div>Kepala Bidang Akuntansi</div>
                            <div class="ruang"></div>
                            <div class="nm">M. Adnan, S.E., M.Si.</div>
                            <div>NIP. 197612262007011010</div>
                        </div>
                    </div>

                    <div class="doc-foot">
                        <span>BAR Penerimaan dan Pengeluaran 2026</span>
                        <span>Halaman 1 dari 2</span>
                    </div>
                </article>
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            /* ---------- SIDEBAR ---------- */
            const MOBILE = () => window.matchMedia('(max-width:991.98px)').matches;

            function toggleSidebar() {
                if (MOBILE()) document.body.classList.toggle('drawer');
                else {
                    document.body.classList.toggle('mini');
                    localStorage.setItem('sidebarMini', document.body.classList.contains('mini') ? '1' : '0');
                }
            }

            function tutupDrawer() {
                document.body.classList.remove('drawer');
            }
            if (!MOBILE() && localStorage.getItem('sidebarMini') === '1') document.body.classList.add('mini');
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') tutupDrawer();
            });
            window.addEventListener('resize', () => {
                if (!MOBILE()) tutupDrawer();
            });
        </script>
    </body>

</html> --}}

@extends('layout.base_layout')
@push('cssTambahan')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endpush

@section('content')
            <div class="page-head d-flex align-items-center gap-3 flex-wrap no-print">
                <div>
                    <h1>Berita Acara Rekonsiliasi <span class="chip c-wait ms-1"><i class="bi bi-hourglass-split"></i>
                            Menunggu TTD</span></h1>
                    <p>Nomor {{ $data->berita_acara_no_bud }} &middot; Periode {{ $data->berita_acara_periode }} TA
                        {{ $data->berita_acara_tahun_anggaran }}</p>
                </div>
                <div class="ms-auto d-flex gap-2 no-print">
                    <a href="{{ route('berita_acara.view') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                        <i class="bi bi-printer"></i> Cetak / PDF
                    </button>
                    <a href="{{ route('berita_acara.excel', $berita_acara_id) }}" class="btn btn-sm btn-outline-success">
                        <i class="bi bi-file-earmark-excel"></i> Ekspor Excel
                    </a>
                    <button class="btn btn-sm text-white" style="background:var(--bar-navy)">
                        <i class="bi bi-pen"></i> Tanda Tangani
                    </button>
                </div>
            </div>

            <div class="content">
                <!-- ============ LEMBAR DOKUMEN ============ -->
                <article class="sheet" id="lembar">

                    <!-- Baris 1–3 -->
                    <div class="doc-title">
                        <h1>BERITA ACARA REKONSILIASI PENERIMAAN DAN PENGELUARAN</h1>
                        <h2>ANTARA SKPKD DAN SKPD</h2>
                        <h3>PERIODE {{ $data->berita_acara_periode }} TAHUN ANGGARAN
                            {{ $data->berita_acara_tahun_anggaran }}</h3>
                    </div>

                    <!-- Baris 5–6 -->
                    <div class="doc-no">
                        Nomor BAR (BUD) : {{ $data->berita_acara_no_bud }}<br>
                        Nomor BAR (SKPD) : {{ $data->berita_acara_no_skpd }}
                    </div>

                    <!-- Baris 8 -->
                    <p class="pembuka">
                        Pada hari ini, {{$terbilang['hari']}} tanggal {{$terbilang['tanggal']}} bulan {{$terbilang['bulan']}} tahun {{$terbilang['tahun']}},
                        bertempat di Kantor Badan Pengelolaan Keuangan dan Aset Daerah, kami yang
                        bertandatangan di bawah ini:
                    </p>

                    <!-- Baris 10–16 -->
                    <ol class="pihak">
                        <li>
                            <div class="urut">1.</div>
                            <div class="isi">
                                <div class="baris"><span class="lbl">Nama / NIP</span><span
                                        class="sep">:</span><span class="val">Ichtiawan J. Aziz, S.E.I / NIP.
                                        198506162020121006</span></div>
                                <div class="baris"><span class="lbl">Jabatan</span><span
                                        class="sep">:</span><span class="val">Kepala Sub Bidang Penerimaan dan
                                        Belanja</span></div>
                                <div class="ket-pihak">
                                    Dalam hal ini bertindak untuk dan atas nama BPKAD selaku SKPKD Pemerintah
                                    Kabupaten Kutai Timur, selanjutnya disebut PIHAK KESATU.
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="urut">2.</div>
                            <div class="isi">
                                <div class="baris"><span class="lbl">Nama / NIP</span><span
                                        class="sep">:</span><span class="val">Budi Santoso, S.E. / NIP.
                                        198203142009011004</span></div>
                                <div class="baris"><span class="lbl">Jabatan</span><span
                                        class="sep">:</span><span class="val">Pejabat Penatausahaan Keuangan
                                        (PPK-SKPD)</span></div>
                                <div class="ket-pihak">
                                    Dalam hal ini bertindak untuk dan atas nama Dinas Pendidikan, selanjutnya
                                    disebut PIHAK KEDUA.
                                </div>
                            </div>
                        </li>
                    </ol>

                    <!-- Baris 18 -->
                    <p class="pembuka">
                        PIHAK KESATU dan PIHAK KEDUA secara bersama-sama telah melakukan rekonsiliasi data
                        Penerimaan (Pendapatan) dan Pengeluaran (Belanja) sampai dengan periode Juni Tahun
                        Anggaran 2026, dengan hasil kesepakatan sebagai berikut:
                    </p>

                    <!-- ===== I. PENERIMAAN (baris 20–26) ===== -->
                    <div class="sec">I. REKONSILIASI PENERIMAAN (PENDAPATAN)</div>
                    <p class="sec-desc">
                        Berdasarkan pencatatan pada Buku Kas Umum (BKU) Penerimaan SKPD dan Catatan Kas
                        Daerah (BUD), realisasi pendapatan adalah sebagai berikut:
                    </p>
                    <div class="tbl-scroll">
                        <table class="xl" id="tPend">
                            <colgroup>
                                <col class="cA">
                                <col class="cB">
                                <col class="cC">
                                <col class="cD">
                                <col class="cE">
                                <col class="cF">
                                <col class="cG">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Rekening</th>
                                    <th>Uraian Pendapatan</th>
                                    <th>Catatan SKPD<br>(Rp)</th>
                                    <th>Catatan BUD<br>(Rp)</th>
                                    <th>Selisih<br>(Rp)</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totPendapatanSKPD = $data_pendapatan->sum('skpd');
                                    $totpendapatanBUD = $data_pendapatan->sum('bud');
                                    $selisihPendapatan = $totPendapatanSKPD - $totpendapatanBUD;
                                @endphp
                                @foreach ($data_pendapatan as $index => $pendapatan)
                                    <tr>
                                        <td class="c">{{ $index + 1 }}</td>
                                        <td class="c">{{ $pendapatan->rekening_kode }}</td>
                                        <td>{{ $pendapatan->rekening_uraian }}</td>
                                        <td class="num" data-v="{{ $pendapatan->skpd }}">
                                            {{ number_format($pendapatan->skpd, 2, ',', '.') }}</td>
                                        <td class="num" data-v="{{ $pendapatan->bud }}">
                                            {{ number_format($pendapatan->bud, 2, ',', '.') }}</td>
                                        <td class="num" data-v="{{ $pendapatan->selisih }}">
                                            {{ number_format($pendapatan->selisih, 2, ',', '.') }}</td>
                                        <td class="c">{{ $pendapatan->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="tot">
                                    <td colspan="3" class="lbl-tot">TOTAL PENERIMAAN</td>
                                    <td class="num" data-v="{{ $totPendapatanSKPD }}">
                                        {{ number_format($totPendapatanSKPD, 2, ',', '.') }}
                                    </td>
                                    <td class="num" data-v="{{ $totpendapatanBUD }}">
                                        {{ number_format($totpendapatanBUD, 2, ',', '.') }}
                                    </td>
                                    <td class="num" data-v="{{ $selisihPendapatan }}">
                                        {{ number_format($selisihPendapatan, 2, ',', '.') }}</td>
                                    <td class="c">
                                        {{ $selisihPendapatan == 0 ? 'Sesuai' : 'Tidak Sesuai' }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- ===== II. BELANJA (baris 28–40) ===== -->
                    <div class="sec">II. REKONSILIASI PENGELUARAN (BELANJA)</div>
                    <p class="sec-desc">
                        Berdasarkan penerbitan Surat Perintah Pencairan Dana (SP2D) oleh BUD dan Surat
                        Pertanggungjawaban (SPJ) Pengeluaran oleh SKPD, realisasi belanja adalah sebagai
                        berikut:
                    </p>
                    <div class="tbl-scroll">
                        <table class="xl" id="tBel">
                            <colgroup>
                                <col class="cA">
                                <col class="cB">
                                <col class="cC">
                                <col class="cD">
                                <col class="cE">
                                <col class="cF">
                                <col class="cG">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis / Mekanisme Belanja</th>
                                    <th>Uraian</th>
                                    <th>Catatan SKPD<br>(Rp)</th>
                                    <th>Catatan BUD<br>(Rp)</th>
                                    <th>Selisih<br>(Rp)</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totBelanjaSKPD = $data_belanja->sum('skpd');
                                    $totBelanjaBUD = $data_belanja->sum('bud');
                                    $selisihBelanja = $totBelanjaSKPD - $totBelanjaBUD;
                                @endphp
                                @foreach ($data_belanja as $index => $belanja)
                                    <tr>
                                        <td class="c">{{ $index + 1 }}</td>
                                        <td>{{ $belanja->belanja_nama }}</td>
                                        <td>{{ $belanja->belanja_uraian }}</td>
                                        <td class="num" data-v="{{ $belanja->skpd }}">
                                            {{ number_format($belanja->skpd, 2, ',', '.') }}</td>
                                        <td class="num" data-v="{{ $belanja->bud }}">
                                            {{ number_format($belanja->bud, 2, ',', '.') }}</td>
                                        <td class="num" data-v="{{ $belanja->selisih }}">
                                            {{ number_format($belanja->selisih, 2, ',', '.') }}</td>
                                        <td class="c">{{ $belanja->keterangan }}</td>
                                    </tr>
                                @endforeach
                                <tr class="tot">
                                    <td colspan="3" class="lbl-tot">TOTAL BELANJA (JENIS)</td>
                                    <td class="num" data-v="{{ $totBelanjaSKPD }}">
                                        {{ number_format($totBelanjaSKPD, 2, ',', '.') }}</td>
                                    <td class="num" data-v="{{ $totBelanjaBUD }}">
                                        {{ number_format($totBelanjaBUD, 2, ',', '.') }}</td>
                                    <td class="num" data-v="{{ $selisihBelanja }}">
                                        {{ number_format($selisihBelanja, 2, ',', '.') }}</td>
                                    <td class="c">
                                        {{ $selisihBelanja == 0 ? 'Sesuai' : 'Tidak Sesuai' }}</td>
                                </tr>
                                @php
                                    $totMekanismeSKPD = $data_mekanisme->sum('skpd');
                                    $totMekanismeBUD = $data_mekanisme->sum('bud');
                                    $selisihMekanisme = $totMekanismeSKPD - $totMekanismeBUD;
                                @endphp
                                @foreach ($data_mekanisme as $mekanisme)
                                    <tr>
                                        <td class="c">{{ $loop->iteration }}</td>
                                        <td>{{ $mekanisme->mekanisme_nama }}</td>
                                        <td>{{ $mekanisme->mekanisme_uraian }}</td>
                                        <td class="num" data-v="{{ $mekanisme->skpd }}">
                                            {{ number_format($mekanisme->skpd, 2, ',', '.') }}</td>
                                        <td class="num" data-v="{{ $mekanisme->bud }}">
                                            {{ number_format($mekanisme->bud, 2, ',', '.') }}</td>
                                        <td class="num" data-v="{{ $mekanisme->selisih }}">
                                            {{ number_format($mekanisme->selisih, 2, ',', '.') }}</td>
                                        <td class="c">{{ $mekanisme->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @php
                                $selisihPotensiSKPD = $totMekanismeSKPD - $totBelanjaSKPD;
                                $selisihPotensiBUD = $totMekanismeBUD - $totBelanjaBUD;
                                $selisihPotensi = $selisihPotensiBUD - $selisihPotensiSKPD;
                            @endphp
                            <tfoot>
                                <tr class="tot">
                                    <td colspan="3" class="lbl-tot">TOTAL BELANJA (MEKANISME)</td>
                                    <td class="num" data-v="{{ $totMekanismeSKPD }}">
                                        {{ number_format($totMekanismeSKPD, 2, ',', '.') }}
                                    </td>
                                    <td class="num" data-v="{{ $totMekanismeBUD }}">
                                        {{ number_format($totMekanismeBUD, 2, ',', '.') }}
                                    </td>
                                    <td class="num" data-v="{{ $selisihMekanisme }}">
                                        {{ number_format($selisihMekanisme, 2, ',', '.') }}
                                    </td>
                                    <td class="c">{{ $selisihMekanisme == 0 ? 'Sesuai' : 'Potensi' }}</td>
                                </tr>
                                <tr class="tot">
                                    <td colspan="3" class="lbl-tot">SELISIH (POTENSI SISA UP/GU/TU)</td>
                                    <td class="num" data-v="{{ $selisihPotensiSKPD }}">
                                        {{ number_format($selisihPotensiSKPD, 2, ',', '.') }}
                                    </td>
                                    <td class="num" data-v="{{ $selisihPotensiBUD }}">
                                        {{ number_format($selisihPotensiBUD, 2, ',', '.') }}
                                    </td>
                                    <td class="num" data-v="{{ $selisihPotensi }}">
                                        {{ number_format($selisihPotensi, 2, ',', '.') }}
                                    </td>
                                    <td class="c">{{ $selisihPotensi == 0 ? 'Sesuai' : 'Potensi' }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- ===== III. SALDO KAS (baris 42–48) ===== -->
                    <div class="sec">III. REKONSILIASI SALDO KAS DAN SISA UP/GU/TU</div>
                    <div class="tbl-scroll">
                        <table class="xl" id="tSaldo">
                            <colgroup>
                                <col class="cA">
                                <col style="width:56.5%">
                                <col class="cF">
                                <col style="width:26%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Uraian Saldo Kas</th>
                                    <th>Jumlah<br>(Rp)</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="c">1</td>
                                    <td>Saldo Awal Bulan Kas di Bendahara Pengeluaran</td>
                                    <td class="num" data-v="234840000">234.840.000,00</td>
                                    <td class="c">Kas Awal Bulan</td>
                                </tr>
                                <tr>
                                    <td class="c">2</td>
                                    <td>Penerimaan SP2D (UP/GU/TU) Periode Ini</td>
                                    <td class="num" data-v="224026427">224.026.427,00</td>
                                    <td class="c">Pencairan UP/GU/TU</td>
                                </tr>
                                <tr>
                                    <td class="c">3</td>
                                    <td>Pengeluaran BKU (SPJ Belanja UP/GU/TU)</td>
                                    <td class="num neg" data-v="-224026427">-224.026.427,00</td>
                                    <td class="c">Realisasi UP/GU/TU</td>
                                </tr>
                                <tr>
                                    <td class="c">4</td>
                                    <td>Pengembalian Sisa UP/GU/TU (STS/S3UP)</td>
                                    <td class="num" data-v="0">0,00</td>
                                    <td class="c">Penyetoran Sisa Kas</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="tot">
                                    <td colspan="2" class="lbl-tot">SALDO AKHIR KAS DI BENDAHARA PENGELUARAN</td>
                                    <td class="num" data-v="234840000">234.840.000,00</td>
                                    <td class="c">Sesuai</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- ===== IV. CATATAN (baris 50–52) ===== -->
                    <div class="sec">IV. CATATAN DAN KESIMPULAN</div>
                    @php
                        $catatans = explode("\n", $data->berita_acara_kesimpulan)
                    @endphp
                    @foreach ($catatans as $index => $catatan)
                     <p class="catatan">
                        <span>{{$index + 1}}. </span> {{$catatan}}
                     </p>
                    @endforeach

                    <!-- ===== TANDA TANGAN (baris 55–72) ===== -->
                    <div class="ttd">
                        <div>
                            <div class="fw-bold">PIHAK KEDUA</div>
                            <div>Pejabat Penatausahaan Keuangan (PPK-SKPD)</div>
                            <div class="ruang"></div>
                            <div class="nm">Budi Santoso, S.E.</div>
                            <div>NIP. 198203142009011004</div>
                        </div>
                        <div>
                            <div class="fw-bold">PIHAK KESATU</div>
                            <div>Kepala Sub Bidang Penerimaan dan Belanja</div>
                            <div class="ruang"></div>
                            <div class="nm">Ichtiawan J. Aziz, S.E.I</div>
                            <div>NIP. 198506162020121006</div>
                        </div>
                    </div>

                    <div class="ttd">
                        <div>
                            <div class="fw-bold">MENGETAHUI / MENYETUJUI:</div>
                            <div>Pengguna Anggaran</div>
                            <div class="ruang"></div>
                            <div class="nm">Dr. H. Suprihanto, M.Pd.</div>
                            <div>NIP. 196908121994031008</div>
                        </div>
                        <div>
                            <div class="fw-bold">MENGETAHUI / MENYETUJUI:</div>
                            <div>Kepala Bidang Akuntansi</div>
                            <div class="ruang"></div>
                            <div class="nm">M. Adnan, S.E., M.Si.</div>
                            <div>NIP. 197612262007011010</div>
                        </div>
                    </div>

                    <div class="doc-foot">
                        <span>BAR Penerimaan dan Pengeluaran 2026</span>
                        <span>Halaman 1 dari 2</span>
                    </div>
                </article>
            </div>
@endsection