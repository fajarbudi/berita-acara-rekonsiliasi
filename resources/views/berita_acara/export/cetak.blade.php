<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Rekonsiliasi</title>
    <style>
        @page { size: A4 portrait; margin: 12mm 10mm; }
        body { margin: 0; font-family: Arial, sans-serif; font-size: 10pt; }
        table { width: 100%; border-collapse: collapse; }
        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        /* Tiap seksi tidak boleh terpotong antar halaman */
        .no-break { page-break-inside: avoid; break-inside: avoid; }
    </style>
</head>
<body>
@php
    // Format Rupiah: 15475422024 -> 15.475.422.024,00
    $rp = fn($n) => number_format((float) $n, 2, ',', '.');

    $thHead   = 'background-color:#1B365D; color:#FFFFFF; font-weight:bold; text-align:center; vertical-align:middle; border:0.5pt solid #7F7F7F; padding:3px 4px;';
    $tdGrid   = 'border:0.5pt solid #7F7F7F; padding:3px 5px;';
    $tdTot    = 'background-color:#F0F4F8; font-weight:bold; border:0.5pt solid #7F7F7F; padding:3px 5px;';
    $colgroup = '<col width="5%"><col width="12%"><col width="24%"><col width="16%"><col width="16%"><col width="14%"><col width="13%">';
@endphp


<table>
    <tr><td style="font-size:14pt; font-weight:bold;" colspan="7" align="center">BERITA ACARA REKONSILIASI PENERIMAAN DAN PENGELUARAN</td></tr>
    <tr><td style="font-size:11pt; font-weight:bold;" colspan="7" align="center">ANTARA SKPKD DAN SKPD</td></tr>
    <tr><td style="font-size:11pt; font-weight:bold;" colspan="7" align="center">PERIODE {{ strtoupper($data->berita_acara_periode) }} TAHUN ANGGARAN {{ $data->berita_acara_tahun_anggaran }}</td></tr>
    <tr><td colspan="7" height="8"></td></tr>
    <tr><td style="font-style:italic;" colspan="7" align="center">Nomor BAR (BUD) : {{ $data->berita_acara_no_bud }}</td></tr>
    <tr><td style="font-style:italic;" colspan="7" align="center">Nomor BAR (SKPD) : {{ $data->berita_acara_no_skpd }}</td></tr>
    <tr><td colspan="7" height="8"></td></tr>
    <tr>
        <td style="vertical-align:top;" colspan="7">
            Pada hari ini, {{ $terbilang['hari'] ?? '[Nama Hari]' }} tanggal {{ $terbilang['tanggal'] ?? '[Tanggal]' }} bulan {{ $terbilang['bulan'] ?? '[Bulan]' }} tahun {{ $terbilang['tahun'] ?? '[Tahun]' }}, bertempat di {{ $data->berita_acara_tempat ?? 'Kantor Badan Pengelolaan Keuangan dan Aset Daerah' }}, kami yang bertandatangan di bawah ini:
        </td>
    </tr>
    <tr><td colspan="7" height="6"></td></tr>
    <tr>
        <td align="right">1.</td>
        <td>Nama / NIP</td>
        <td colspan="5">: {{ $data->berita_acara_nama_bud ?? 'Ichtiawan J. Aziz, S.E.I' }} / NIP. {{ $data->berita_acara_nip_bud ?? '198506162020121006' }}</td>
    </tr>
    <tr>
        <td></td><td>Jabatan</td>
        <td colspan="5">: Kepala Sub Bidang Penerimaan dan Belanja</td>
    </tr>
    <tr>
        <td></td>
        <td style="vertical-align:top;" colspan="6">Dalam hal ini bertindak untuk dan atas nama BPKAD selaku SKPKD Pemerintah Kabupaten Kutai Timur, selanjutnya disebut PIHAK KESATU.</td>
    </tr>
    <tr><td colspan="7" height="6"></td></tr>
    <tr>
        <td align="right">2.</td>
        <td>Nama / NIP</td>
        <td colspan="5">: {{ $data->berita_acara_nama_ppk ?? '[Nama Pejabat SKPD]' }} / NIP. {{ $data->berita_acara_nip_ppk ?? '[NIP]' }}</td>
    </tr>
    <tr>
        <td></td><td>Jabatan</td>
        <td colspan="5">: Pejabat Penatausahaan Keuangan (PPK-SKPD)</td>
    </tr>
    <tr>
        <td></td>
        <td style="vertical-align:top;" colspan="6">Dalam hal ini bertindak untuk dan atas nama {{ $data->berita_acara_skpd_nama ?? ($data->skpd->skpd_nama ?? '[Nama SKPD]') }}, selanjutnya disebut PIHAK KEDUA.</td>
    </tr>
    <tr><td colspan="7" height="6"></td></tr>
    <tr>
        <td style="vertical-align:top;" colspan="7">PIHAK KESATU dan PIHAK KEDUA secara bersama-sama telah melakukan rekonsiliasi data Penerimaan (Pendapatan) dan Pengeluaran (Belanja) sampai dengan periode {{ $data->berita_acara_periode }} Tahun Anggaran {{ $data->berita_acara_tahun_anggaran }}, dengan hasil kesepakatan sebagai berikut:</td>
    </tr>
</table>


<table class="no-break" style="margin-top:8px;">
    <colgroup>{!! $colgroup !!}</colgroup>
    <tr><td style="font-size:11pt; font-weight:bold; color:#1B365D;" colspan="7">I. REKONSILIASI PENERIMAAN (PENDAPATAN)</td></tr>
    <tr><td style="vertical-align:top;" colspan="7">Berdasarkan pencatatan pada Buku Kas Umum (BKU) Penerimaan SKPD dan Catatan Kas Daerah (BUD), realisasi pendapatan adalah sebagai berikut:</td></tr>
    <tr height="26">
        <td style="{{ $thHead }}">No.</td>
        <td style="{{ $thHead }}">Kode Rekening</td>
        <td style="{{ $thHead }}">Uraian Pendapatan</td>
        <td style="{{ $thHead }}">Catatan SKPD (Rp)</td>
        <td style="{{ $thHead }}">Catatan BUD (Rp)</td>
        <td style="{{ $thHead }}">Selisih (Rp)</td>
        <td style="{{ $thHead }}">Keterangan</td>
    </tr>
    @php $totPendSkpd = 0; $totPendBud = 0; @endphp
    @foreach ($data_pendapatan as $i => $p)
        @php
            $totPendSkpd += (float) $p->skpd;
            $totPendBud  += (float) $p->bud;
            $selisih = (float) $p->skpd - (float) $p->bud;   
        @endphp
        <tr>
            <td style="{{ $tdGrid }}" align="center">{{ $i + 1 }}</td>
            <td style="{{ $tdGrid }}" align="center">{{ $p->rekening_kode }}</td>
            <td style="{{ $tdGrid }}">{{ $p->rekening_uraian }}</td>
            <td style="{{ $tdGrid }}" align="right">{{ $rp($p->skpd) }}</td>
            <td style="{{ $tdGrid }}" align="right">{{ $rp($p->bud) }}</td>
            <td style="{{ $tdGrid }} @if($selisih < 0) color:#FF0000; @endif" align="right">{{ $rp($selisih) }}</td>
            <td style="{{ $tdGrid }}" align="center">{{ abs($selisih) < 0.001 ? 'Cocok' : 'Tidak Cocok' }}</td>
        </tr>
    @endforeach
    @php $selPend = $totPendSkpd - $totPendBud; @endphp
    <tr>
        <td style="{{ $tdTot }}" colspan="3" align="right">TOTAL PENERIMAAN</td>
        <td style="{{ $tdTot }}" align="right">{{ $rp($totPendSkpd) }}</td>
        <td style="{{ $tdTot }}" align="right">{{ $rp($totPendBud) }}</td>
        <td style="{{ $tdTot }} @if($selPend < 0) color:#FF0000; @endif" align="right">{{ $rp($selPend) }}</td>
        <td style="{{ $tdTot }}" align="center">{{ abs($selPend) < 0.001 ? 'Sesuai' : 'Tidak Sesuai' }}</td>
    </tr>
</table>


<table class="no-break" style="margin-top:8px;">
    <colgroup>{!! $colgroup !!}</colgroup>
    <tr><td style="font-size:11pt; font-weight:bold; color:#1B365D;" colspan="7">II. REKONSILIASI PENGELUARAN (BELANJA)</td></tr>
    <tr><td style="vertical-align:top;" colspan="7">Berdasarkan penerbitan Surat Perintah Pencairan Dana (SP2D) oleh BUD dan Surat Pertanggungjawaban (SPJ) Pengeluaran oleh SKPD, realisasi belanja adalah sebagai berikut:</td></tr>
    <tr height="39">
        <td style="{{ $thHead }}">No.</td>
        <td style="{{ $thHead }}">Jenis / Mekanisme Belanja</td>
        <td style="{{ $thHead }}">Uraian</td>
        <td style="{{ $thHead }}">Catatan SKPD (Rp)</td>
        <td style="{{ $thHead }}">Catatan BUD (Rp)</td>
        <td style="{{ $thHead }}">Selisih (Rp)</td>
        <td style="{{ $thHead }}">Keterangan</td>
    </tr>

   
    @php $totBelSkpd = 0; $totBelBud = 0; @endphp
    @foreach ($data_belanja as $i => $b)
        @php
            $totBelSkpd += (float) $b->skpd;
            $totBelBud  += (float) $b->bud;
            $selisih = (float) $b->bud - (float) $b->skpd;  
        @endphp
        <tr>
            <td style="{{ $tdGrid }}" align="center">{{ $i + 1 }}</td>
            <td style="{{ $tdGrid }}">{{ $b->belanja_nama }}</td>
            <td style="{{ $tdGrid }}">{{ $b->belanja_uraian }}</td>
            <td style="{{ $tdGrid }} @if($b->skpd < 0) color:#FF0000; @endif" align="right">{{ $rp($b->skpd) }}</td>
            <td style="{{ $tdGrid }} @if($b->bud < 0) color:#FF0000; @endif" align="right">{{ $rp($b->bud) }}</td>
            <td style="{{ $tdGrid }} @if($selisih < 0) color:#FF0000; @endif" align="right">{{ $rp($selisih) }}</td>
            <td style="{{ $tdGrid }}" align="center">{{ abs($selisih) < 0.001 ? 'Cocok' : 'Tidak Cocok' }}</td>
        </tr>
    @endforeach
    @php $selBel = $totBelBud - $totBelSkpd; @endphp
    <tr>
        <td style="{{ $tdTot }}" colspan="3" align="right">TOTAL BELANJA (JENIS)</td>
        <td style="{{ $tdTot }}" align="right">{{ $rp($totBelSkpd) }}</td>
        <td style="{{ $tdTot }}" align="right">{{ $rp($totBelBud) }}</td>
        <td style="{{ $tdTot }} @if($selBel < 0) color:#FF0000; @endif" align="right">{{ $rp($selBel) }}</td>
        <td style="{{ $tdTot }}" align="center">{{ abs($selBel) < 0.001 ? 'Sesuai' : 'Tidak Sesuai' }}</td>
    </tr>

    
    @php
        $lsS  = (float) ($data->berita_acara_sp2dLS_skpd ?? 0);
        $lsB  = (float) ($data->berita_acara_sp2dLS_bud ?? 0);
        $upS  = (float) ($data->berita_acara_sp2dUP_skpd ?? 0);
        $upB  = (float) ($data->berita_acara_sp2dUP_bud ?? 0);
        $stsS = (float) ($data->berita_acara_sts_skpd ?? 0);
        $stsB = (float) ($data->berita_acara_sts_bud ?? 0);

        $lsSel  = $lsB - $lsS;
        $upSel  = $upB - $upS;
        $stsSel = $stsB - $stsS;

        // Total mekanisme dijumlahkan manual dari tiga baris di atas
        $totMekSkpd = $lsS + $upS + $stsS;
        $totMekBud  = $lsB + $upB + $stsB;
    @endphp
    <tr>
        <td style="{{ $tdGrid }}" align="center">1</td>
        <td style="{{ $tdGrid }}">Mekanisme SP2D-LS</td>
        <td style="{{ $tdGrid }}">Langsung ke Pihak Ketiga / Gaji</td>
        <td style="{{ $tdGrid }} @if($lsS < 0) color:#FF0000; @endif" align="right">{{ $rp($lsS) }}</td>
        <td style="{{ $tdGrid }} @if($lsB < 0) color:#FF0000; @endif" align="right">{{ $rp($lsB) }}</td>
        <td style="{{ $tdGrid }} @if($lsSel < 0) color:#FF0000; @endif" align="right">{{ $rp($lsSel) }}</td>
        <td style="{{ $tdGrid }}" align="center">{{ abs($lsSel) < 0.001 ? 'Cocok' : 'Tidak Cocok' }}</td>
    </tr>
    <tr>
        <td style="{{ $tdGrid }}" align="center">2</td>
        <td style="{{ $tdGrid }}">Mekanisme SP2D-UP/GU/TU</td>
        <td style="{{ $tdGrid }}">Uang Persediaan / Ganti Uang</td>
        <td style="{{ $tdGrid }} @if($upS < 0) color:#FF0000; @endif" align="right">{{ $rp($upS) }}</td>
        <td style="{{ $tdGrid }} @if($upB < 0) color:#FF0000; @endif" align="right">{{ $rp($upB) }}</td>
        <td style="{{ $tdGrid }} @if($upSel < 0) color:#FF0000; @endif" align="right">{{ $rp($upSel) }}</td>
        <td style="{{ $tdGrid }}" align="center">{{ abs($upSel) < 0.001 ? 'Cocok' : 'Tidak Cocok' }}</td>
    </tr>
    <tr>
        <td style="{{ $tdGrid }}" align="center">3</td>
        <td style="{{ $tdGrid }}">STS</td>
        <td style="{{ $tdGrid }}">{{ $data->berita_acara_sts_uraian ?? 'Pengembalian ke Kasda (-)' }}</td>
        <td style="{{ $tdGrid }} @if($stsS < 0) color:#FF0000; @endif" align="right">{{ $rp($stsS) }}</td>
        <td style="{{ $tdGrid }} @if($stsB < 0) color:#FF0000; @endif" align="right">{{ $rp($stsB) }}</td>
        <td style="{{ $tdGrid }} @if($stsSel < 0) color:#FF0000; @endif" align="right">{{ $rp($stsSel) }}</td>
        <td style="{{ $tdGrid }}" align="center">{{ abs($stsSel) < 0.001 ? 'Cocok' : 'Tidak Cocok' }}</td>
    </tr>
    @php $selMek = $totMekBud - $totMekSkpd; @endphp
    <tr>
        <td style="{{ $tdTot }}" colspan="3" align="right">TOTAL BELANJA (MEKANISME)</td>
        <td style="{{ $tdTot }}" align="right">{{ $rp($totMekSkpd) }}</td>
        <td style="{{ $tdTot }}" align="right">{{ $rp($totMekBud) }}</td>
        <td style="{{ $tdTot }} @if($selMek < 0) color:#FF0000; @endif" align="right">{{ $rp($selMek) }}</td>
        <td style="{{ $tdTot }}" align="center">{{ abs($selMek) < 0.001 ? 'Sesuai' : 'Potensi' }}</td>
    </tr>

  
    @php
        $gapSkpd = $totMekSkpd - $totBelSkpd;
        $gapBud  = $totMekBud  - $totBelBud;
        $gapSel  = $gapBud - $gapSkpd;
    @endphp
    <tr>
        <td style="{{ $tdTot }}" colspan="3" align="right">SELISIH (POTENSI SISA UP/GU/TU)</td>
        <td style="{{ $tdTot }} @if($gapSkpd < 0) color:#FF0000; @endif" align="right">{{ $rp($gapSkpd) }}</td>
        <td style="{{ $tdTot }} @if($gapBud < 0) color:#FF0000; @endif" align="right">{{ $rp($gapBud) }}</td>
        <td style="{{ $tdTot }} @if($gapSel < 0) color:#FF0000; @endif" align="right">{{ $rp($gapSel) }}</td>
        <td style="{{ $tdTot }}" align="center">{{ abs($gapSel) < 0.001 ? 'Sesuai' : 'Potensi' }}</td>
    </tr>
</table>


<table class="no-break" style="margin-top:8px;">
    <colgroup>{!! $colgroup !!}</colgroup>
    <tr><td style="font-size:11pt; font-weight:bold; color:#1B365D;" colspan="7">III. REKONSILIASI SALDO KAS DAN SISA UP/GU/TU</td></tr>
    <tr height="26">
        <td style="{{ $thHead }}">No.</td>
        <td style="{{ $thHead }}" colspan="3">Uraian Saldo Kas</td>
        <td style="{{ $thHead }}">Jumlah (Rp)</td>
        <td style="{{ $thHead }}" colspan="2">Keterangan</td>
    </tr>
    @php
        $saldo = [
            ['Saldo Awal Bulan Kas di Bendahara Pengeluaran', $data->berita_acara_saldo_awal_bulan ?? 0, 'Kas Awal Bulan'],
            ['Penerimaan SP2D (UP/GU/TU) Periode Ini',        $data->berita_acara_penerimaan_sp2d ?? 0,   'Pencairan UP/GU/TU'],
            ['Pengeluaran BKU (SPJ Belanja UP/GU/TU)',        $data->berita_acara_pengeluaran_bku ?? 0,   'Realisasi UP/GU/TU'],
            ['Pengembalian Sisa UP/GU/TU (STS/S3UP)',         $data->berita_acara_pengembalian ?? 0,      'Penyetoran Sisa Kas'],
        ];
        $saldoAkhir = 0;
    @endphp
    @foreach ($saldo as $i => $row)
        @php $saldoAkhir += (float) $row[1]; @endphp
        <tr>
            <td style="{{ $tdGrid }}" align="center">{{ $i + 1 }}</td>
            <td style="{{ $tdGrid }}" colspan="3">{{ $row[0] }}</td>
            <td style="{{ $tdGrid }} @if($row[1] < 0) color:#FF0000; @endif" align="right">{{ $rp($row[1]) }}</td>
            <td style="{{ $tdGrid }}" colspan="2" align="center">{{ $row[2] }}</td>
        </tr>
    @endforeach
    <tr>
        <td style="{{ $tdTot }}" colspan="4" align="right">SALDO AKHIR KAS DI BENDAHARA PENGELUARAN</td>
        <td style="{{ $tdTot }} @if($saldoAkhir < 0) color:#FF0000; @endif" align="right">{{ $rp($saldoAkhir) }}</td>
        <td style="{{ $tdTot }}" colspan="2" align="center">{{ abs($saldoAkhir - $gapBud) < 0.001 ? 'Sesuai' : 'Nihil' }}</td>
    </tr>
</table>


<table class="no-break" style="margin-top:8px;">
    <colgroup>{!! $colgroup !!}</colgroup>

    {{-- IV. Catatan --}}
    <tr><td colspan="7" style="font-size:11pt; font-weight:bold; color:#1B365D;">IV. CATATAN DAN KESIMPULAN</td></tr>
    @php $catatans = array_filter(explode("\n", $data->berita_acara_kesimpulan ?? '')); @endphp
    @if (count($catatans))
        @foreach ($catatans as $index => $catatan)
            <tr><td colspan="7" style="font-style:italic;">{{ $index + 1 }}. {{ trim($catatan) }}</td></tr>
        @endforeach
    @else
        <tr><td colspan="7" style="font-style:italic;">1. Data Penerimaan dan Pengeluaran antara BUD dan SKPD untuk periode ini dinyatakan TELAH SESUAI / COCOK.</td></tr>
        <tr><td colspan="7" style="font-style:italic;">2. Berita Acara ini dibuat dalam rangkap 2 (dua) sebagai bahan penyusunan Laporan Keuangan Pemerintah Daerah (LKPD).</td></tr>
    @endif

    {{-- Jarak sebelum tanda tangan --}}
    <tr><td colspan="7" height="24"></td></tr>

    {{-- Tanda tangan — tiap nama colspan 3 agar Excel membacanya sebagai merge --}}
    <tr>
        <td colspan="3" style="font-weight:bold;" align="center">PIHAK KEDUA</td>
        <td></td>
        <td colspan="3" style="font-weight:bold;" align="center">PIHAK KESATU</td>
    </tr>
    <tr>
        <td colspan="3" align="center">Pejabat Penatausahaan Keuangan (PPK-SKPD)</td>
        <td></td>
        <td colspan="3" align="center">Kepala Sub Bidang Penerimaan dan Belanja</td>
    </tr>
    <tr><td colspan="7" height="72"></td></tr>
    <tr>
        <td colspan="3" style="font-weight:bold;" align="center">{{ $data->berita_acara_nama_ppk ?? '[NAMA PEJABAT/PPK SKPD]' }}</td>
        <td></td>
        <td colspan="3" style="font-weight:bold;" align="center">{{ $data->berita_acara_nama_bud ?? 'Ichtiawan J. Aziz, S.E.I' }}</td>
    </tr>
    <tr>
        <td colspan="3" align="center">NIP. {{ $data->berita_acara_nip_ppk ?? '[---------------------]' }}</td>
        <td></td>
        <td colspan="3" align="center">NIP. {{ $data->berita_acara_nip_bud ?? '198506162020121006' }}</td>
    </tr>
    <tr><td colspan="7" height="20"></td></tr>
    <tr>
        <td colspan="3" style="font-weight:bold;" align="center">MENGETAHUI / MENYETUJUI:</td>
        <td></td>
        <td colspan="3" style="font-weight:bold;" align="center">MENGETAHUI / MENYETUJUI:</td>
    </tr>
    <tr>
        <td colspan="3" align="center">Pengguna Anggaran</td>
        <td></td>
        <td colspan="3" align="center">Kepala Bidang Akuntansi</td>
    </tr>
    <tr><td colspan="7" height="72"></td></tr>
    <tr>
        <td colspan="3" style="font-weight:bold;" align="center">{{ $data->berita_acara_nama_pa ?? '[NAMA KEPALA SKPD]' }}</td>
        <td></td>
        <td colspan="3" style="font-weight:bold;" align="center">{{ $data->berita_acara_nama_ka ?? 'M. Adnan, S.E., M.Si.' }}</td>
    </tr>
    <tr>
        <td colspan="3" align="center">NIP. {{ $data->berita_acara_nip_pa ?? '[---------------------]' }}</td>
        <td></td>
        <td colspan="3" align="center">NIP. {{ $data->berita_acara_nip_ka ?? '197612262007011010' }}</td>
    </tr>
</table>

</body>
</html>