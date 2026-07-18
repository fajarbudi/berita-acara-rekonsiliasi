<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="margin: 0; display: flex; justify-content: center;">
    <table style="font-family:Arial, sans-serif; font-size:10pt; margin: 0" border="0" cellspacing="0" cellpadding="0">
    <colgroup>
        <col width="45"> {{-- A: No.            --}}
        <col width="105"> {{-- B: Kode Rekening  --}}
        <col width="180"> {{-- C: Uraian         --}}
        <col width="130"> {{-- D: Catatan SKPD   --}}
        <col width="130"> {{-- E: Catatan BUD    --}}
        <col width="110"> {{-- F: Selisih        --}}
        <col width="90"> {{-- G: Keterangan     --}}
    </colgroup>

    {{-- ============ JUDUL (baris 1–3) ============ --}}
    <tr>
        <td style="font-size:14pt; font-weight:bold;" colspan="7" align="center">
            BERITA ACARA REKONSILIASI PENERIMAAN DAN PENGELUARAN
        </td>
    </tr>
    <tr>
        <td style="font-size:11pt; font-weight:bold;" colspan="7" align="center">
            ANTARA SKPKD DAN SKPD
        </td>
    </tr>
    <tr>
        <td style="font-size:11pt; font-weight:bold;" colspan="7" align="center">
            PERIODE {{ strtoupper($data->berita_acara_periode) }}
            TAHUN ANGGARAN {{ $data->berita_acara_tahun_anggaran }}
        </td>
    </tr>
    <tr>
        <td colspan="7" height="8"></td>
    </tr>

    {{-- ============ NOMOR BAR (baris 5–6) ============ --}}
    <tr>
        <td style="font-style:italic;" colspan="7" align="center">
            Nomor BAR (BUD) : {{ $data->berita_acara_no_bud }}
        </td>
    </tr>
    <tr>
        <td style="font-style:italic;" colspan="7" align="center">
            Nomor BAR (SKPD) : {{ $data->berita_acara_no_skpd }}
        </td>
    </tr>
    <tr>
        <td colspan="7" height="8"></td>
    </tr>

    {{-- ============ PARAGRAF PEMBUKA (baris 8) ============ --}}
    <tr>
        <td style="vertical-align:top;" colspan="7" height="33">
            Pada hari ini, {{ $terbilang['hari'] ?? '[Nama Hari]' }}
            tanggal {{ $terbilang['tanggal'] ?? '[Tanggal]' }}
            bulan {{ $terbilang['bulan'] ?? '[Bulan]' }}
            tahun {{ $terbilang['tahun'] ?? '[Tahun]' }},
            bertempat di Kantor Badan Pengelolaan Keuangan dan Aset Daerah,
            kami yang bertandatangan di bawah ini:
        </td>
    </tr>
    <tr>
        <td colspan="7" height="6"></td>
    </tr>

    {{-- ============ PARA PIHAK (baris 10–16) ============ --}}
    <tr>
        <td align="right">1.</td>
        <td>Nama / NIP</td>
        <td colspan="5">
            : Ichtiawan J. Aziz, S.E.I
            / NIP. 198506162020121006
        </td>
    </tr>
    <tr>
        <td></td>
        <td>Jabatan</td>
        <td colspan="5">: Kepala Sub Bidang Penerimaan dan Belanja</td>
    </tr>
    <tr>
        <td></td>
        <td style="vertical-align:top;" colspan="6" height="29">
            Dalam hal ini bertindak untuk dan atas nama BPKAD selaku SKPKD
            Pemerintah Kabupaten Kutai Timur, selanjutnya disebut PIHAK KESATU.
        </td>
    </tr>
    <tr>
        <td colspan="7" height="6"></td>
    </tr>

    <tr>
        <td align="right">2.</td>
        <td>Nama / NIP</td>
        <td colspan="5">
            : {{ $data->berita_acara_nama_ppk ?? '[Nama Pejabat SKPD]' }}
            / NIP. {{ $data->berita_acara_nip_ppk ?? '[NIP]' }}
        </td>
    </tr>
    <tr>
        <td></td>
        <td>Jabatan</td>
        <td colspan="5">: Pejabat Penatausahaan Keuangan (PPK-SKPD)</td>
    </tr>
    <tr>
        <td></td>
        <td style="vertical-align:top;" colspan="6" height="29">
            Dalam hal ini bertindak untuk dan atas nama
            {{ $data->berita_acara_skpd ?? '[Nama SKPD]' }},
            selanjutnya disebut PIHAK KEDUA.
        </td>
    </tr>
    <tr>
        <td colspan="7" height="6"></td>
    </tr>

    {{-- ============ PARAGRAF KESEPAKATAN (baris 18) ============ --}}
    <tr>
        <td style="vertical-align:top;" colspan="7" height="41">
            PIHAK KESATU dan PIHAK KEDUA secara bersama-sama telah melakukan
            rekonsiliasi data Penerimaan (Pendapatan) dan Pengeluaran (Belanja)
            sampai dengan periode {{ $data->berita_acara_periode }}
            Tahun Anggaran {{ $data->berita_acara_tahun_anggaran }},
            dengan hasil kesepakatan sebagai berikut:
        </td>
    </tr>
    <tr>
        <td colspan="7" height="8"></td>
    </tr>

    {{-- ============ I. PENERIMAAN (baris 20–26) ============ --}}
    <tr>
        <td style="font-size:11pt; font-weight:bold; color:#1B365D;" colspan="7">
            I. REKONSILIASI PENERIMAAN (PENDAPATAN)
        </td>
    </tr>
    <tr>
        <td style="vertical-align:top;" colspan="7" height="33">
            Berdasarkan pencatatan pada Buku Kas Umum (BKU) Penerimaan SKPD dan
            Catatan Kas Daerah (BUD), realisasi pendapatan adalah sebagai berikut:
        </td>
    </tr>

    @php
        $thHead =
            'background-color:#1B365D; color:#FFFFFF; font-weight:bold; ' .
            'text-align:center; vertical-align:middle; ' .
            'border:0.5pt solid #7F7F7F;';
        $tdGrid = 'border:0.5pt solid #7F7F7F;';
        $tdTot = 'background-color:#F0F4F8; font-weight:bold; border:0.5pt solid #7F7F7F;';
        $fmtRp = '#,##0.00';
    @endphp

    <tr height="26">
        <td style="{{ $thHead }}">No.</td>
        <td style="{{ $thHead }}">Kode Rekening</td>
        <td style="{{ $thHead }}">Uraian Pendapatan</td>
        <td style="{{ $thHead }}">Catatan SKPD (Rp)</td>
        <td style="{{ $thHead }}">Catatan BUD (Rp)</td>
        <td style="{{ $thHead }}">Selisih (Rp)</td>
        <td style="{{ $thHead }}">Keterangan</td>
    </tr>

    @php
        $totPendSkpd = 0;
        $totPendBud = 0;
    @endphp

    @foreach ($data_pendapatan as $i => $p)
        @php
            $totPendSkpd += (float) $p->skpd;
            $totPendBud += (float) $p->bud;
            // Penerimaan: SKPD dikurangi BUD
            $selisih = (float) $p->skpd - (float) $p->bud;
        @endphp
        <tr>
            <td style="{{ $tdGrid }}" align="center">{{ $i + 1 }}</td>
            <td style="{{ $tdGrid }}" align="center">{{ $p->rekening_kode }}</td>
            <td style="{{ $tdGrid }}">{{ $p->rekening_uraian }}</td>
            <td data-num-fmt="{{ $fmtRp }}" style="{{ $tdGrid }}" align="right">{{ $p->skpd }}
            </td>
            <td data-num-fmt="{{ $fmtRp }}" style="{{ $tdGrid }}" align="right">{{ $p->bud }}
            </td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($selisih < 0) color:#FF0000; @endif" align="right">
                {{ $selisih }}</td>
            <td style="{{ $tdGrid }}" align="center">
                {{ abs($selisih) < 0.001 ? 'Cocok' : 'Tidak Cocok' }}
            </td>
        </tr>
    @endforeach

    @php $selPend = $totPendSkpd - $totPendBud; @endphp
    <tr>
        <td style="{{ $tdTot }}" colspan="3" align="right">TOTAL PENERIMAAN</td>
        <td data-num-fmt="{{ $fmtRp }}" style="{{ $tdTot }}" align="right">{{ $totPendSkpd }}</td>
        <td data-num-fmt="{{ $fmtRp }}" style="{{ $tdTot }}" align="right">{{ $totPendBud }}</td>
        <td data-num-fmt="{{ $fmtRp }}"
            style="{{ $tdTot }} @if ($selPend < 0) color:#FF0000; @endif" align="right">
            {{ $selPend }}</td>
        <td style="{{ $tdTot }}" align="center">
            {{ abs($selPend) < 0.001 ? 'Sesuai' : 'Tidak Sesuai' }}
        </td>
    </tr>
    <tr>
        <td colspan="7" height="8"></td>
    </tr>

    {{-- ============ II. BELANJA (baris 28–40) ============ --}}
    <tr>
        <td style="font-size:11pt; font-weight:bold; color:#1B365D;" colspan="7">
            II. REKONSILIASI PENGELUARAN (BELANJA)
        </td>
    </tr>
    <tr>
        <td style="vertical-align:top;" colspan="7" height="33">
            Berdasarkan penerbitan Surat Perintah Pencairan Dana (SP2D) oleh BUD dan
            Surat Pertanggungjawaban (SPJ) Pengeluaran oleh SKPD, realisasi belanja
            adalah sebagai berikut:
        </td>
    </tr>

    <tr height="39">
        <td style="{{ $thHead }}">No.</td>
        <td style="{{ $thHead }}">Jenis / Mekanisme Belanja</td>
        <td style="{{ $thHead }}">Uraian</td>
        <td style="{{ $thHead }}">Catatan SKPD (Rp)</td>
        <td style="{{ $thHead }}">Catatan BUD (Rp)</td>
        <td style="{{ $thHead }}">Selisih (Rp)</td>
        <td style="{{ $thHead }}">Keterangan</td>
    </tr>

    {{-- II.A menurut jenis belanja --}}
    @php
        $totBelSkpd = 0;
        $totBelBud = 0;
    @endphp

    @foreach ($data_belanja as $i => $b)
        @php
            $totBelSkpd += (float) $b->skpd;
            $totBelBud += (float) $b->bud;
            // Belanja: BUD dikurangi SKPD, kebalikan dari penerimaan
            $selisih = (float) $b->bud - (float) $b->skpd;
        @endphp
        <tr>
            <td style="{{ $tdGrid }}" align="center">{{ $i + 1 }}</td>
            <td style="{{ $tdGrid }}">{{ $b->belanja_nama }}</td>
            <td style="{{ $tdGrid }}">{{ $b->belanja_uraian }}</td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($b->skpd < 0) color:#FF0000; @endif" align="right">
                {{ $b->skpd }}</td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($b->bud < 0) color:#FF0000; @endif" align="right">
                {{ $b->bud }}</td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($selisih < 0) color:#FF0000; @endif" align="right">
                {{ $selisih }}</td>
            <td style="{{ $tdGrid }}" align="center">
                {{ abs($selisih) < 0.001 ? 'Cocok' : 'Tidak Cocok' }}
            </td>
        </tr>
    @endforeach

    @php $selBel = $totBelBud - $totBelSkpd; @endphp
    <tr>
        <td style="{{ $tdTot }}" colspan="3" align="right">TOTAL BELANJA (JENIS)</td>
        <td data-num-fmt="{{ $fmtRp }}" style="{{ $tdTot }}" align="right">{{ $totBelSkpd }}</td>
        <td data-num-fmt="{{ $fmtRp }}" style="{{ $tdTot }}" align="right">{{ $totBelBud }}</td>
        <td data-num-fmt="{{ $fmtRp }}"
            style="{{ $tdTot }} @if ($selBel < 0) color:#FF0000; @endif" align="right">
            {{ $selBel }}</td>
        <td style="{{ $tdTot }}" align="center">
            {{ abs($selBel) < 0.001 ? 'Sesuai' : 'Tidak Sesuai' }}
        </td>
    </tr>

    {{-- II.B menurut mekanisme pencairan --}}
    @php
        $totMekSkpd = 0;
        $totMekBud = 0;
    @endphp

    @foreach ($data_mekanisme as $i => $m)
        @php
            $totMekSkpd += (float) $m->skpd;
            $totMekBud += (float) $m->bud;
            $selisih = (float) $m->bud - (float) $m->skpd;
        @endphp
        <tr>
            <td style="{{ $tdGrid }}" align="center">{{ $i + 1 }}</td>
            <td style="{{ $tdGrid }}">{{ $m->mekanisme_nama }}</td>
            <td style="{{ $tdGrid }}">{{ $m->mekanisme_uraian }}</td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($m->skpd < 0) color:#FF0000; @endif" align="right">
                {{ $m->skpd }}</td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($m->bud < 0) color:#FF0000; @endif" align="right">
                {{ $m->bud }}</td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($selisih < 0) color:#FF0000; @endif" align="right">
                {{ $selisih }}</td>
            <td style="{{ $tdGrid }}" align="center">
                {{ abs($selisih) < 0.001 ? 'Cocok' : 'Tidak Cocok' }}
            </td>
        </tr>
    @endforeach
        <tr>
            <td style="{{ $tdGrid }}" align="center">1</td>
            <td style="{{ $tdGrid }}">Mekanisme SP2D-LS</td>
            <td style="{{ $tdGrid }}">Langsung ke Pihak Ketiga / Gaji</td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($data->berita_acara_sp2dLS_skpd < 0) color:#FF0000; @endif" align="right">
                {{ $data->berita_acara_sp2dLS_skpd }}
            </td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($data->berita_acara_sp2dLS_bud < 0) color:#FF0000; @endif" align="right">
                {{ $data->berita_acara_sp2dLS_bud }}
            </td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($data->berita_acara_sp2dLS_selisih < 0) color:#FF0000; @endif" align="right">
                {{ $data->berita_acara_sp2dLS_selisih }}
            </td>
            <td style="{{ $tdGrid }}" align="center">
                {{ abs($data->berita_acara_sp2dLS_selisih) < 0.001 ? 'Cocok' : 'Tidak Cocok' }}
            </td>
        </tr>
        <tr>
            <td style="{{ $tdGrid }}" align="center">2</td>
            <td style="{{ $tdGrid }}">Mekanisme SP2D-UP/GU/TU</td>
            <td style="{{ $tdGrid }}">Uang Persediaan / Ganti Uang</td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($data->berita_acara_sp2dUP_skpd < 0) color:#FF0000; @endif" align="right">
                {{ $data->berita_acara_sp2dUP_skpd }}
            </td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($data->berita_acara_sp2dUP_bud < 0) color:#FF0000; @endif" align="right">
                {{ $data->berita_acara_sp2dUP_bud }}
            </td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($data->berita_acara_sp2dUP_selisih < 0) color:#FF0000; @endif" align="right">
                {{ $data->berita_acara_sp2dUP_selisih }}
            </td>
            <td style="{{ $tdGrid }}" align="center">
                {{ abs($data->berita_acara_sp2dUP_selisih) < 0.001 ? 'Cocok' : 'Tidak Cocok' }}
            </td>
        </tr>
        <tr>
            <td style="{{ $tdGrid }}" align="center">3</td>
            <td style="{{ $tdGrid }}">SKS</td>
            <td style="{{ $tdGrid }}">Pengembalian ke Kasda (-)</td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($data->berita_acara_sts_skpd < 0) color:#FF0000; @endif" align="right">
                {{ $data->berita_acara_sts_skpd }}
            </td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($data->berita_acara_sts_bud < 0) color:#FF0000; @endif" align="right">
                {{ $data->berita_acara_sts_bud }}
            </td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($data->berita_acara_sts_selisih < 0) color:#FF0000; @endif" align="right">
                {{ $data->berita_acara_sts_selisih }}
            </td>
            <td style="{{ $tdGrid }}" align="center">
                {{ abs($data->berita_acara_sts_selisih) < 0.001 ? 'Cocok' : 'Tidak Cocok' }}
            </td>
        </tr>

    @php $selMek = $totMekBud - $totMekSkpd; @endphp
    <tr>
        <td style="{{ $tdTot }}" colspan="3" align="right">TOTAL BELANJA (MEKANISME)</td>
        <td data-num-fmt="{{ $fmtRp }}" style="{{ $tdTot }}" align="right">{{ $totMekSkpd }}
        </td>
        <td data-num-fmt="{{ $fmtRp }}" style="{{ $tdTot }}" align="right">{{ $totMekBud }}
        </td>
        <td data-num-fmt="{{ $fmtRp }}"
            style="{{ $tdTot }} @if ($selMek < 0) color:#FF0000; @endif" align="right">
            {{ $selMek }}</td>
        <td style="{{ $tdTot }}" align="center">
            {{ abs($selMek) < 0.001 ? 'Sesuai' : 'Potensi' }}
        </td>
    </tr>

    {{-- Selisih potensi sisa UP/GU/TU = total mekanisme dikurangi total jenis --}}
    @php
        $gapSkpd = $totMekSkpd - $totBelSkpd;
        $gapBud = $totMekBud - $totBelBud;
        $gapSel = $gapBud - $gapSkpd;
    @endphp
    <tr>
        <td style="{{ $tdTot }}" colspan="3" align="right">SELISIH (POTENSI SISA UP/GU/TU)</td>
        <td data-num-fmt="{{ $fmtRp }}"
            style="{{ $tdTot }} @if ($gapSkpd < 0) color:#FF0000; @endif" align="right">
            {{ $gapSkpd }}</td>
        <td data-num-fmt="{{ $fmtRp }}"
            style="{{ $tdTot }} @if ($gapBud < 0) color:#FF0000; @endif" align="right">
            {{ $gapBud }}</td>
        <td data-num-fmt="{{ $fmtRp }}"
            style="{{ $tdTot }} @if ($gapSel < 0) color:#FF0000; @endif" align="right">
            {{ $gapSel }}</td>
        <td style="{{ $tdTot }}" align="center">
            {{ abs($gapSel) < 0.001 ? 'Sesuai' : 'Potensi' }}
        </td>
    </tr>
    <tr>
        <td colspan="7" height="8"></td>
    </tr>

    {{-- ============ III. SALDO KAS (baris 42–48) ============ --}}
    <tr>
        <td style="font-size:11pt; font-weight:bold; color:#1B365D;" colspan="7">
            III. REKONSILIASI SALDO KAS DAN SISA UP/GU/TU
        </td>
    </tr>

    <tr height="26">
        <td style="{{ $thHead }}">No.</td>
        <td style="{{ $thHead }}" colspan="3">Uraian Saldo Kas</td>
        <td style="{{ $thHead }}">Jumlah (Rp)</td>
        <td style="{{ $thHead }}" colspan="2">Keterangan</td>
    </tr>

    @php
        // Bila tabel saldo kas belum tersedia, keempat baris ini
        // dibentuk dari kolom di tabel berita_acara.
        $saldo = [
            ['Saldo Awal Bulan Kas di Bendahara Pengeluaran', $data->berita_acara_saldo_awal_bulan ?? 0, 'Kas Awal Bulan'],
            ['Penerimaan SP2D (UP/GU/TU) Periode Ini', $data->berita_acara_penerimaan_sp2d ?? 0, 'Pencairan UP/GU/TU'],
            ['Pengeluaran BKU (SPJ Belanja UP/GU/TU)', $data->berita_acara_pengeluaran_bku ?? 0, 'Realisasi UP/GU/TU'],
            ['Pengembalian Sisa UP/GU/TU (STS/S3UP)', $data->berita_acara_pengembalian ?? 0, 'Penyetoran Sisa Kas'],
        ];
        $saldoAkhir = 0;
    @endphp

    @foreach ($saldo as $i => $row)
        @php $saldoAkhir += (float) $row[1]; @endphp
        <tr>
            <td style="{{ $tdGrid }}" align="center">{{ $i + 1 }}</td>
            <td style="{{ $tdGrid }}" colspan="3">{{ $row[0] }}</td>
            <td data-num-fmt="{{ $fmtRp }}"
                style="{{ $tdGrid }} @if ($row[1] < 0) color:#FF0000; @endif"
                align="right">{{ $row[1] }}</td>
            <td style="{{ $tdGrid }}" colspan="2" align="center">{{ $row[2] }}</td>
        </tr>
    @endforeach

    <tr>
        <td style="{{ $tdTot }}" colspan="4" align="right">
            SALDO AKHIR KAS DI BENDAHARA PENGELUARAN
        </td>
        <td data-num-fmt="{{ $fmtRp }}"
            style="{{ $tdTot }} @if ($saldoAkhir < 0) color:#FF0000; @endif" align="right">
            {{ $saldoAkhir }}</td>
        <td style="{{ $tdTot }}" colspan="2" align="center">
            {{ abs($saldoAkhir - $gapBud) < 0.001 ? 'Sesuai' : 'Nihil' }}
        </td>
    </tr>
    <tr>
        <td colspan="7" height="8"></td>
    </tr>

    {{-- ============ IV. CATATAN (baris 50–52) ============ --}}
    <tr>
        <td style="font-size:11pt; font-weight:bold; color:#1B365D;" colspan="7">
            IV. CATATAN DAN KESIMPULAN
        </td>
    </tr>
    @php
        $catatans = explode("\n", $data->berita_acara_kesimpulan)
    @endphp
    @foreach ($catatans as $index => $catatan)
        <tr>
            <td style="font-style:italic;" colspan="7">
                <span>{{$index + 1}}. </span> {{$catatan}}
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="7" height="14"></td>
    </tr>

    {{-- ============ TANDA TANGAN (baris 55–72) ============ --}}
    <tr>
        <td style="font-weight:bold;" colspan="3" align="center">PIHAK KEDUA</td>
        <td></td>
        <td style="font-weight:bold;" colspan="3" align="center">PIHAK KESATU</td>
    </tr>
    <tr>
        <td colspan="3" align="center">Pejabat Penatausahaan Keuangan (PPK-SKPD)</td>
        <td></td>
        <td colspan="3" align="center">Kepala Sub Bidang Penerimaan dan Belanja</td>
    </tr>
    {{-- Ruang untuk tanda tangan basah --}}
    @for ($i = 0; $i < 4; $i++)
        <tr>
            <td colspan="7" height="18"></td>
        </tr>
    @endfor
    <tr>
        <td style="font-weight:bold;" colspan="3" align="center">
            {{ $data->berita_acara_nama_ppk ?? '[NAMA PEJABAT/PPK SKPD]' }}
        </td>
        <td></td>
        <td style="font-weight:bold;" colspan="3" align="center">
            Ichtiawan J. Aziz, S.E.I
        </td>
    </tr>
    <tr>
        <td colspan="3" align="center">
            NIP. {{ $data->berita_acara_nip_ppk ?? '[---------------------]' }}
        </td>
        <td></td>
        <td colspan="3" align="center">
            NIP. 198506162020121006
        </td>
    </tr>
    <tr>
        <td colspan="7" height="14"></td>
    </tr>

    <tr>
        <td style="font-weight:bold;" colspan="3" align="center">MENGETAHUI / MENYETUJUI:</td>
        <td></td>
        <td style="font-weight:bold;" colspan="3" align="center">MENGETAHUI / MENYETUJUI:</td>
    </tr>
    <tr>
        <td colspan="3" align="center">Pengguna Anggaran</td>
        <td></td>
        <td colspan="3" align="center">Kepala Bidang Akuntansi</td>
    </tr>
    @for ($i = 0; $i < 4; $i++)
        <tr>
            <td colspan="7" height="18"></td>
        </tr>
    @endfor
    <tr>
        <td style="font-weight:bold;" colspan="3" align="center">
            {{ $data->berita_acara_nama_pa ?? '[NAMA KEPALA SKPD]' }}
        </td>
        <td></td>
        <td style="font-weight:bold;" colspan="3" align="center">
            M. Adnan, S.E., M.Si.
        </td>
    </tr>
    <tr>
        <td colspan="3" align="center">
            NIP. {{ $data->berita_acara_nip_pa ?? '[---------------------]' }}
        </td>
        <td></td>
        <td colspan="3" align="center">
            NIP. 197612262007011010
        </td>
    </tr>
</table>

</body>
</html>