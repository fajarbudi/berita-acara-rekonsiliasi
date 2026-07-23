@php
		$num = fn($n) => str_replace('.', '&#46;', number_format((float) $n, 2, ',', '.'));

		$eq0 = fn($x) => abs((float) $x) < 0.005;
		$eq = fn($a, $b) => abs((float) $a - (float) $b) < 0.005;

		/* Label keterangan — teks persis seperti Excel */
		$ketBaris = fn($selisih) => $eq0($selisih) ? 'Cocok' : 'Tidak Cocok'; // IF(F=0,"Cocok","Tidak Cocok")
		$ketTotal = fn($selisih) => $eq0($selisih) ? 'Sesuai' : 'Tidak Sesuai'; // IF(F=0,"Sesuai","Tidak Sesuai")
		$ketPot = fn($selisih) => $eq0($selisih) ? 'Sesuai' : 'Potensi'; // IF(F=0,"Sesuai","Potensi")

		/* Warna merah hanya bila benar-benar tidak nol (mengikuti $eq0) */
		$isNeg = fn($x) => (float) $x < 0;

		/* ---------- LEBAR KOLOM (grid 7 kolom, total 100) ----------
       Kolom "kode/jenis" dinaikkan 13->17 supaya "Mekanisme SP2D-UP/GU/TU"
       tidak pecah 3 baris. Kolom angka diturunkan 18->16 (masih cukup
       untuk "100.884.833.110,00"), selisih 15->14, uraian 21->19. */
		$w = ['no' => 4, 'kode' => 17, 'ur' => 19, 'skpd' => 16, 'bud' => 16, 'sel' => 14, 'ket' => 14];

		$wd = fn($k) => ' width="' . $w[$k] . '%"';
		$wdSum = fn(...$k) => ' width="' . array_sum(array_map(fn($x) => $w[$x], $k)) . '%"';

		$cBlue = '#1B365D';
		$cZebra = '#F7F9FC';
		$cTot = '#E8EEF6';

		$th = "background-color:{$cBlue};color:#FFFFFF;font-weight:bold;text-align:center;vertical-align:middle;font-size:7.5pt;";
		$td = 'font-size:8pt;';
		$tdR = $td . 'text-align:right;';
		$tdC = $td . 'text-align:center;';
		$tot = "background-color:{$cTot};font-weight:bold;font-size:8pt;";
		$totR = $tot . 'text-align:right;';
		$totC = $tot . 'text-align:center;';
		$red = 'color:#C00000;';
		$sec = "font-size:10pt;font-weight:bold;color:{$cBlue};";

		$tbl = 'border="0.4" cellpadding="3" cellspacing="0" width="100%"';
		$tblPlain = 'border="0" cellpadding="2" cellspacing="0" width="100%"';

		$spacer = fn($h = 6) => '<table border="0" cellpadding="0" cellspacing="0" width="100%">' .
		    '<tr><td style="font-size:' .
		    $h .
		    'pt;">&nbsp;</td></tr></table>';
@endphp

{{-- ================= JUDUL ================= --}}
<table {!! $tblPlain !!}>
		<tr>
				<td align="center" style="font-size:13pt;font-weight:bold;color:{{ $cBlue }};line-height:130%;">BERITA ACARA
						REKONSILIASI PENERIMAAN DAN PENGELUARAN</td>
		</tr>
		<tr>
				<td align="center" style="font-size:10pt;font-weight:bold;line-height:130%;">ANTARA SKPKD (BPKAD) DAN SKPD
						({{ strtoupper($data->skpd->skpd_nama) }})</td>
		</tr>
		<tr>
				<td align="center" style="font-size:10pt;font-weight:bold;line-height:130%;">PERIODE
						{{ strtoupper($data->berita_acara_periode) }} TAHUN ANGGARAN {{ $data->berita_acara_tahun_anggaran }}</td>
		</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
				<td style="border-bottom:1.2pt solid {{ $cBlue }};font-size:1pt;">&nbsp;</td>
		</tr>
</table>

{!! $spacer(4) !!}

{{-- ================= NOMOR BAR — RATA TENGAH ================= --}}
<table {!! $tblPlain !!}>
		<tr>
				<td align="center" style="font-size:9pt;line-height:135%;">Nomor BAR (SKPKD) : {{ $data->berita_acara_no_bud }}</td>
		</tr>
		<tr>
				<td align="center" style="font-size:9pt;line-height:135%;">Nomor BAR (SKPD) &nbsp;&nbsp;:
						{{ $data->berita_acara_no_skpd }}</td>
		</tr>
</table>

{!! $spacer(6) !!}

{{-- ================= PEMBUKA ================= --}}
@php
		$txtOpen =
		    'Pada hari ini, ' .
		    ($terbilang['hari'] ?? '[Nama Hari]') .
		    ' tanggal ' .
		    ($terbilang['tanggal'] ?? '[Tanggal]') .
		    ' bulan ' .
		    ($terbilang['bulan'] ?? '[Bulan]') .
		    ' tahun ' .
		    ($terbilang['tahun'] ?? '[Tahun]') .
		    ', bertempat di ' .
		    ($data->berita_acara_tempat ?? 'Kantor Badan Pengelolaan Keuangan dan Aset Daerah') .
		    ', kami yang bertandatangan di bawah ini:';
		$txt1 =
		    'Dalam hal ini bertindak untuk dan atas nama BPKAD selaku SKPKD Pemerintah Kabupaten Kutai Timur, selanjutnya disebut PIHAK KESATU.';
		$txt2 =
		    'Dalam hal ini bertindak untuk dan atas nama ' .
		    ($data->berita_acara_skpd_nama ?? ($data->skpd->skpd_nama ?? '[Nama SKPD]')) .
		    ', selanjutnya disebut PIHAK KEDUA.';
		$txtRekon =
		    'PIHAK KESATU dan PIHAK KEDUA secara bersama-sama telah melakukan rekonsiliasi data Penerimaan (Pendapatan) dan Pengeluaran (Belanja) sampai dengan periode ' .
		    $data->berita_acara_periode .
		    ' Tahun Anggaran ' .
		    $data->berita_acara_tahun_anggaran .
		    ', dengan hasil kesepakatan sebagai berikut:';
@endphp

<table {!! $tblPlain !!}>
		<tr>
				<td align="justify" style="font-size:9pt;line-height:145%;">{{ $txtOpen }}</td>
		</tr>
</table>

{!! $spacer(4) !!}

{{-- Blok identitas pihak: nobr agar tidak terbelah halaman --}}
<table border="0" cellpadding="1" cellspacing="0" nobr="true" width="100%">
		<tr>
				<td align="right" style="font-size:9pt;" width="5%">1.</td>
				<td style="font-size:9pt;" width="20%">Nama / NIP</td>
				<td style="font-size:9pt;" width="75%">: <b>{{ $data->berita_acara_nama_bud ?? 'Ichtiawan J. Aziz, S.E.I' }}</b>
						/ NIP. {{ $data->berita_acara_nip_bud ?? '198506162020121006' }}</td>
		</tr>
		<tr>
				<td width="5%">&nbsp;</td>
				<td style="font-size:9pt;" width="20%">Jabatan</td>
				<td style="font-size:9pt;" width="75%">:
						{{ $data->berita_acara_jabatan_kepala_skpkd ?? 'Kepala Sub Bidang Penerimaan dan Belanja' }}</td>
		</tr>
		<tr>
				<td width="5%">&nbsp;</td>
				<td align="justify" colspan="2" style="font-size:9pt;line-height:140%;" width="95%">{{ $txt1 }}</td>
		</tr>
</table>

{!! $spacer(4) !!}

<table border="0" cellpadding="1" cellspacing="0" nobr="true" width="100%">
		<tr>
				<td align="right" style="font-size:9pt;" width="5%">2.</td>
				<td style="font-size:9pt;" width="20%">Nama / NIP</td>
				<td style="font-size:9pt;" width="75%">: <b>{{ $data->berita_acara_nama_ppk ?? '[Nama Pejabat SKPD]' }}</b> /
						NIP. {{ $data->berita_acara_nip_ppk ?? '[NIP]' }}</td>
		</tr>
		<tr>
				<td width="5%">&nbsp;</td>
				<td style="font-size:9pt;" width="20%">Jabatan</td>
				<td style="font-size:9pt;" width="75%">: Pejabat Penatausahaan Keuangan (PPK-SKPD)</td>
		</tr>
		<tr>
				<td width="5%">&nbsp;</td>
				<td align="justify" colspan="2" style="font-size:9pt;line-height:140%;" width="95%">{{ $txt2 }}</td>
		</tr>
</table>

{!! $spacer(4) !!}

<table {!! $tblPlain !!}>
		<tr>
				<td align="justify" style="font-size:9pt;line-height:145%;">{{ $txtRekon }}</td>
		</tr>
</table>

{!! $spacer(6) !!}

{{-- ================= I. PENERIMAAN =================
     Judul + kalimat pengantar + header tabel disatukan dalam satu tabel
     nobr, supaya judul tidak pernah tertinggal sendirian di akhir halaman. --}}
<table {!! $tbl !!}>
		{{-- Judul & pengantar jadi baris tanpa border di tabel yang sama,
         supaya TCPDF tidak bisa memotong di antara judul dan header. --}}
		<tr>
				<td colspan="7" style="{{ $sec }}border:none;" width="100%">I. REKONSILIASI PENERIMAAN (PENDAPATAN)
				</td>
		</tr>
		<tr>
				<td align="justify" colspan="7" style="font-size:8.5pt;line-height:140%;border:none;padding-bottom:4px;"
						width="100%">Berdasarkan pencatatan pada Buku Kas Umum (BKU) Penerimaan SKPD dan Catatan Kas Daerah (BUD),
						realisasi pendapatan adalah sebagai berikut:</td>
		</tr>
		<thead>
				<tr>
						<td{!! $wd('no') !!} style="{{ $th }}">No.</td>
						<td{!! $wd('kode') !!} style="{{ $th }}">Kode Rekening</td>
						<td{!! $wd('ur') !!} style="{{ $th }}">Uraian Pendapatan</td>
						<td{!! $wd('skpd') !!} style="{{ $th }}">Catatan SKPD (Rp)</td>
						<td{!! $wd('bud') !!} style="{{ $th }}">Catatan BUD (Rp)</td>
						<td{!! $wd('sel') !!} style="{{ $th }}">Selisih (Rp)</td>
						<td{!! $wd('ket') !!} style="{{ $th }}">Keterangan</td>
				</tr>
		</thead>
		<tbody>
				@php
						$totPendSkpd = 0;
						$totPendBud = 0;
				@endphp
				@foreach ($data_pendapatan as $i => $p)
						@php
								$totPendSkpd += (float) $p->skpd;
								$totPendBud += (float) $p->bud;
								$selisih = (float) $p->skpd - (float) $p->bud; // Excel F23: =D-E (SKPD - BUD)
								$bg = $i % 2 ? "background-color:{$cZebra};" : '';
						@endphp
						<tr>
								<td{!! $wd('no') !!} style="{{ $tdC }}{{ $bg }}">{{ $i + 1 }}</td>
								<td{!! $wd('kode') !!} style="{{ $tdC }}{{ $bg }}">{{ $p->rekening_kode }}</td>
								<td{!! $wd('ur') !!} style="{{ $td }}{{ $bg }}">{{ $p->rekening_uraian }}</td>
								<td{!! $wd('skpd') !!} style="{{ $tdR }}{{ $bg }}">{!! $num($p->skpd) !!}</td>
								<td{!! $wd('bud') !!} style="{{ $tdR }}{{ $bg }}">{!! $num($p->bud) !!}</td>
								<td{!! $wd('sel') !!} style="{{ $tdR }}{{ $bg }}{{ $eq0($selisih) ? '' : $red }}">
										{!! $num($selisih) !!}
								</td>
								<td{!! $wd('ket') !!} style="{{ $tdC }}{{ $bg }}{{ $eq0($selisih) ? '' : $red }}">
										{{ $ketBaris($selisih) }}
								</td>
						</tr>
				@endforeach
				@php $selPend = $totPendSkpd - $totPendBud; @endphp {{-- Excel F26: =D26-E26 --}}
				<tr>
						<td colspan="3"{!! $wdSum('no', 'kode', 'ur') !!} style="{{ $totR }}">TOTAL PENERIMAAN</td>
						<td{!! $wd('skpd') !!} style="{{ $totR }}">{!! $num($totPendSkpd) !!}</td>
						<td{!! $wd('bud') !!} style="{{ $totR }}">{!! $num($totPendBud) !!}</td>
						<td{!! $wd('sel') !!} style="{{ $totR }}{{ $eq0($selPend) ? '' : $red }}">
							{!! $num($selPend) !!}
						</td>
						<td{!! $wd('ket') !!} style="{{ $totC }}">{{ $ketTotal($selPend) }}</td>
				</tr>
		</tbody>
</table>

{!! $spacer(8) !!}

{{-- ================= II. PENGELUARAN ================= --}}
<table {!! $tbl !!}>
		<tr>
				<td colspan="7" style="{{ $sec }}border:none;" width="100%">II. REKONSILIASI PENGELUARAN (BELANJA)
				</td>
		</tr>
		<tr>
				<td align="justify" colspan="7" style="font-size:8.5pt;line-height:140%;border:none;padding-bottom:4px;"
						width="100%">Berdasarkan penerbitan Surat Perintah Pencairan Dana (SP2D) oleh BUD dan Surat Pertanggungjawaban
						(SPJ) Pengeluaran oleh SKPD, realisasi belanja adalah sebagai berikut:</td>
		</tr>
		<thead>
				<tr>
						<td{!! $wd('no') !!} style="{{ $th }}">No.</td>
						<td{!! $wd('kode') !!} style="{{ $th }}">Jenis / Mekanisme Belanja</td>
						<td{!! $wd('ur') !!} style="{{ $th }}">Uraian</td>
						<td{!! $wd('skpd') !!} style="{{ $th }}">Catatan SKPD (Rp)</td>
						<td{!! $wd('bud') !!} style="{{ $th }}">Catatan BUD (Rp)</td>
						<td{!! $wd('sel') !!} style="{{ $th }}">Selisih (Rp)</td>
						<td{!! $wd('ket') !!} style="{{ $th }}">Keterangan</td>
				</tr>
		</thead>
		<tbody>
				@php
						$totBelSkpd = 0;
						$totBelBud = 0;
				@endphp
				@foreach ($data_belanja as $i => $b)
						@php
								$totBelSkpd += (float) $b->skpd;
								$totBelBud += (float) $b->bud;
								$selisih = (float) $b->bud - (float) $b->skpd; // Excel F31: =E-D (BUD - SKPD)
								$bg = $i % 2 ? "background-color:{$cZebra};" : '';
						@endphp
						<tr>
								<td{!! $wd('no') !!} style="{{ $tdC }}{{ $bg }}">{{ $i + 1 }}</td>
								<td{!! $wd('kode') !!} style="{{ $td }}{{ $bg }}">{{ $b->belanja_nama }}</td>
								<td{!! $wd('ur') !!} style="{{ $td }}{{ $bg }}">{{ $b->belanja_uraian }}</td>
								<td{!! $wd('skpd') !!} style="{{ $tdR }}{{ $bg }}{{ $isNeg($b->skpd) ? $red : '' }}">
									{!! $num($b->skpd) !!}
								</td>
								<td{!! $wd('bud') !!} style="{{ $tdR }}{{ $bg }}{{ $isNeg($b->bud) ? $red : '' }}">
									{!! $num($b->bud) !!}
								</td>
								<td{!! $wd('sel') !!} style="{{ $tdR }}{{ $bg }}{{ $eq0($selisih) ? '' : $red }}">
									{!! $num($selisih) !!}
								</td>
								<td{!! $wd('ket') !!} style="{{ $tdC }}{{ $bg }}{{ $eq0($selisih) ? '' : $red }}">
									{{ $ketBaris($selisih) }}
								</td>
						</tr>
				@endforeach
				@php $selBel = $totBelBud - $totBelSkpd; @endphp {{-- Excel F35: =E35-D35 --}}
				<tr>
						<td colspan="3"{!! $wdSum('no', 'kode', 'ur') !!} style="{{ $totR }}">TOTAL BELANJA (JENIS)</td>
						<td{!! $wd('skpd') !!} style="{{ $totR }}">{!! $num($totBelSkpd) !!}</td>
						<td{!! $wd('bud') !!} style="{{ $totR }}">{!! $num($totBelBud) !!}</td>
						<td{!! $wd('sel') !!} style="{{ $totR }}{{ $eq0($selBel) ? '' : $red }}">
							{!! $num($selBel) !!}
						</td>
						<td{!! $wd('ket') !!} style="{{ $totC }}">{{ $ketTotal($selBel) }}</td>
				</tr>

				@php
						$lsS = (float) ($data->berita_acara_sp2dLS_skpd ?? 0);
						$lsB = (float) ($data->berita_acara_sp2dLS_bud ?? 0);
						$upS = (float) ($data->berita_acara_sp2dUP_skpd ?? 0);
						$upB = (float) ($data->berita_acara_sp2dUP_bud ?? 0);
						$bpS = (float) ($data->berita_acara_sp2BP_skpd ?? 0);
						$bpB = (float) ($data->berita_acara_sp2BP_bud ?? 0);
						$stsS = (float) ($data->berita_acara_sts_skpd ?? 0);
						$stsB = (float) ($data->berita_acara_sts_bud ?? 0);

						$mekanisme = [
						    ['Mekanisme SP2D-LS', 'Langsung ke Pihak Ketiga / Gaji', $lsS, $lsB],
						    ['Mekanisme SP2D-UP/GU/TU', 'Uang Persediaan / Ganti Uang', $upS, $upB],
						    ['Mekanisme SPB/SP2BP', 'Pengesahan realisasi anggaran dana', $bpS, $bpB],
						    ['STS', $data->berita_acara_sts_uraian ?? 'Pengembalian ke Kasda (-)', $stsS, $stsB],
						];
						$totMekSkpd = $lsS + $upS + $bpS + $stsS;
						$totMekBud = $lsB + $upB + $bpB + $stsB;
				@endphp

				<tr>
						<td colspan="7" style="background-color:#DCE4EF;font-weight:bold;font-size:7.5pt;color:{{ $cBlue }};"
								width="100%">RINCIAN BERDASARKAN MEKANISME PENCAIRAN</td>
				</tr>

				@foreach ($mekanisme as $i => $m)
						@php
								$sel = $m[3] - $m[2]; // Excel F36: =E-D (BUD - SKPD)
								$bg = $i % 2 ? "background-color:{$cZebra};" : '';
						@endphp
						<tr>
								<td{!! $wd('no') !!} style="{{ $tdC }}{{ $bg }}">{{ $i + 1 }}</td>
								<td{!! $wd('kode') !!} style="{{ $td }}{{ $bg }}">{{ $m[0] }}</td>
								<td{!! $wd('ur') !!} style="{{ $td }}{{ $bg }}">{{ $m[1] }}</td>
								<td{!! $wd('skpd') !!} style="{{ $tdR }}{{ $bg }}{{ $isNeg($m[2]) ? $red : '' }}">
									{!! $num($m[2]) !!}
								</td>
								<td{!! $wd('bud') !!} style="{{ $tdR }}{{ $bg }}{{ $isNeg($m[3]) ? $red : '' }}">
									{!! $num($m[3]) !!}
								</td>
								<td{!! $wd('sel') !!} style="{{ $tdR }}{{ $bg }}{{ $eq0($sel) ? '' : $red }}">
									{!! $num($sel) !!}
								</td>
								<td{!! $wd('ket') !!} style="{{ $tdC }}{{ $bg }}{{ $eq0($sel) ? '' : $red }}">
									{{ $ketBaris($sel) }}
								</td>
						</tr>
				@endforeach

				@php
						$selMek = $totMekBud - $totMekSkpd;
						$gapSkpd = $totMekSkpd - $totBelSkpd; // Excel D40: =D39-D35
						$gapBud = $totMekBud - $totBelBud; // Excel E40: =E39-E35
						$gapSel = $gapBud - $gapSkpd; // Excel F40: =E40-D40
				@endphp
				<tr>
						<td colspan="3"{!! $wdSum('no', 'kode', 'ur') !!} style="{{ $totR }}">TOTAL BELANJA (MEKANISME)</td>
						<td{!! $wd('skpd') !!} style="{{ $totR }}">{!! $num($totMekSkpd) !!}</td>
						<td{!! $wd('bud') !!} style="{{ $totR }}">{!! $num($totMekBud) !!}</td>
						<td{!! $wd('sel') !!} style="{{ $totR }}{{ $eq0($selMek) ? '' : $red }}">
							{!! $num($selMek) !!}
						</td>
						<td{!! $wd('ket') !!} style="{{ $totC }}">{{ $ketPot($selMek) }}</td>
				</tr>
				<tr>
						<td colspan="3"{!! $wdSum('no', 'kode', 'ur') !!} style="{{ $totR }}">SELISIH (POTENSI SISA UP/GU/TU)</td>
						<td{!! $wd('skpd') !!} style="{{ $totR }}{{ $isNeg($gapSkpd) ? $red : '' }}">
								{!! $num($gapSkpd) !!}
						</td>
						<td{!! $wd('bud') !!} style="{{ $totR }}{{ $isNeg($gapBud) ? $red : '' }}">
										{!! $num($gapBud) !!}
						</td>
						<td{!! $wd('sel') !!} style="{{ $totR }}{{ $eq0($gapSel) ? '' : $red }}">
												{!! $num($gapSel) !!}
						</td>
						<td{!! $wd('ket') !!} style="{{ $totC }}">{{ $ketPot($gapSel) }}</td>
				</tr>
		</tbody>
</table>

{!! $spacer(8) !!}

{{-- ================= III. SALDO KAS ================= --}}
{{-- Judul dan tabel dalam SATU tabel nobr.
     Sebelumnya terpisah, sehingga header tabel tertinggal di halaman
     sebelumnya dan isinya melompat ke halaman berikutnya.
     Tabel ini pendek (hanya 6 baris), jadi aman dipaksa utuh. --}}
{{-- Judul dijadikan baris pertama TABEL ITU SENDIRI (tanpa border),
     bukan tabel terpisah dan bukan tabel bersarang. Tabel bersarang
     bikin TCPDF salah hitung tinggi; cara ini paling stabil. --}}
<table {!! $tbl !!} nobr="true">
		<tr>
				<td colspan="4" style="{{ $sec }}border:none;padding-bottom:4px;" width="100%">III. REKONSILIASI
						SALDO KAS DAN SISA UP/GU/TU</td>
		</tr>
		<tr>
				<td style="{{ $th }}" width="5%">No.</td>
				<td style="{{ $th }}" width="48%">Uraian Saldo Kas</td>
				<td style="{{ $th }}" width="23%">Jumlah (Rp)</td>
				<td style="{{ $th }}" width="24%">Keterangan</td>
		</tr>
		@php
				$saldo = [
				    ['Saldo Awal Bulan Kas di Bendahara Pengeluaran', $data->berita_acara_saldo_awal_bulan ?? 0, 'Kas Awal Bulan'],
				    ['Penerimaan SP2D (UP/GU/TU) Periode Ini', $data->berita_acara_penerimaan_sp2d ?? 0, 'Pencairan UP/GU/TU'],
				    ['Pengeluaran BKU (SPJ Belanja UP/GU/TU)', $data->berita_acara_pengeluaran_bku ?? 0, 'Realisasi UP/GU/TU'],
				    ['Pengembalian Sisa UP/GU/TU (STS/S3UP)', $data->berita_acara_pengembalian ?? 0, 'Penyetoran Sisa Kas'],
				];
				$saldoAkhir = 0;
		@endphp
		@foreach ($saldo as $i => $row)
				@php
						$saldoAkhir += (float) $row[1];
						$bg = $i % 2 ? "background-color:{$cZebra};" : '';
				@endphp
				<tr>
						<td style="{{ $tdC }}{{ $bg }}" width="5%">{{ $i + 1 }}</td>
						<td style="{{ $td }}{{ $bg }}" width="48%">{{ $row[0] }}</td>
						<td style="{{ $tdR }}{{ $bg }}{{ $isNeg($row[1]) ? $red : '' }}" width="23%">
								{!! $num($row[1]) !!}</td>
						<td style="{{ $tdC }}{{ $bg }}" width="24%">{{ $row[2] }}</td>
				</tr>
		@endforeach
		<tr>
				<td colspan="2" style="{{ $totR }}" width="53%">SALDO AKHIR KAS DI BENDAHARA PENGELUARAN</td>
				<td style="{{ $totR }}{{ $isNeg($saldoAkhir) ? $red : '' }}" width="23%">{!! $num($saldoAkhir) !!}
				</td>
				<td style="{{ $totC }}" width="24%">{{ $eq($saldoAkhir, $gapBud) ? 'Sesuai' : 'Nihil' }}</td>
		</tr>
</table>

{!! $spacer(8) !!}

{{-- ================= IV. CATATAN =================
     PERBAIKAN UTAMA:
     Judul + seluruh poin berada dalam SATU tabel bernomor manual dengan
     nobr="true". Sebelumnya judul dan isi ada di dua tabel terpisah,
     sehingga TCPDF bebas memotong di antaranya (judul tertinggal di
     halaman sebelumnya, poin melompat ke halaman berikutnya).
     Kolom nomor dinaikkan dari 5% ke 6% agar "1." dan "2." sejajar. --}}
@php
		$catatans = array_values(array_filter(array_map('trim', explode("\n", $data->berita_acara_kesimpulan ?? ''))));
		if (!count($catatans)) {
		    $catatans = [
		        'Data Penerimaan dan Pengeluaran antara BUD dan SKPD untuk periode ini dinyatakan TELAH SESUAI / COCOK.',
		        'Berita Acara ini dibuat dalam rangkap 2 (dua) sebagai bahan penyusunan Laporan Keuangan Pemerintah Daerah (LKPD).',
		    ];
		}
@endphp

<table border="0" cellpadding="2" cellspacing="0" nobr="true" width="100%">
		<tr>
				<td colspan="2" style="{{ $sec }}" width="100%">IV. CATATAN DAN KESIMPULAN</td>
		</tr>
		<tr>
				<td colspan="2" style="font-size:3pt;" width="100%">&nbsp;</td>
		</tr>
		@foreach ($catatans as $index => $catatan)
				<tr>
						<td align="right" style="font-size:8.5pt;vertical-align:top;" width="6%">{{ $index + 1 }}.</td>
						<td align="justify" style="font-size:8.5pt;line-height:140%;" width="94%">{{ $catatan }}</td>
				</tr>
		@endforeach
</table>

{{-- ================= TANDA TANGAN =================
     Dua blok, masing-masing nobr="true" agar nama & NIP tidak terpisah
     dari jabatannya saat berpindah halaman. --}}
{!! $spacer(14) !!}

<table border="0" cellpadding="2" cellspacing="0" nobr="true" width="100%">
		<tr>
				<td align="center" style="font-size:9pt;font-weight:bold;" width="46%">PIHAK KEDUA</td>
				<td width="8%">&nbsp;</td>
				<td align="center" style="font-size:9pt;font-weight:bold;" width="46%">PIHAK KESATU</td>
		</tr>
		<tr>
				<td align="center" style="font-size:8.5pt;" width="46%">Pejabat Penatausahaan Keuangan (PPK-SKPD)</td>
				<td width="8%">&nbsp;</td>
				<td align="center" style="font-size:8.5pt;" width="46%">{{ $data->berita_acara_jabatan_kepala_skpkd }}</td>
		</tr>
		<tr>
				<td colspan="3" style="font-size:26pt;" width="100%">&nbsp;</td>
		</tr>
		<tr>
				<td align="center" style="font-size:9pt;font-weight:bold;text-decoration:underline;" width="46%">
						{{ $data->berita_acara_nama_ppk ?? '[NAMA PPK SKPD]' }}</td>
				<td width="8%">&nbsp;</td>
				<td align="center" style="font-size:9pt;font-weight:bold;text-decoration:underline;" width="46%">
						{{ $data->berita_acara_nama_kepala_skpkd ?? 'Ichtiawan J. Aziz, S.E.I' }}</td>
		</tr>
		<tr>
				<td align="center" style="font-size:8.5pt;" width="46%">NIP.
						{{ $data->berita_acara_nip_ppk ?? '[-------------------]' }}</td>
				<td width="8%">&nbsp;</td>
				<td align="center" style="font-size:8.5pt;" width="46%">NIP.
						{{ $data->berita_acara_nip_kepala_skpkd ?? '198506162020121006' }}</td>
		</tr>
</table>

{!! $spacer(12) !!}

<table border="0" cellpadding="2" cellspacing="0" nobr="true" width="100%">
		<tr>
				<td align="center" style="font-size:9pt;font-weight:bold;" width="46%">MENGETAHUI / MENYETUJUI:</td>
				<td width="8%">&nbsp;</td>
				<td align="center" style="font-size:9pt;font-weight:bold;" width="46%">MENGETAHUI / MENYETUJUI:</td>
		</tr>
		<tr>
				<td align="center" style="font-size:8.5pt;" width="46%">Pengguna Anggaran</td>
				<td width="8%">&nbsp;</td>
				<td align="center" style="font-size:8.5pt;" width="46%">{{ $data->berita_acara_jabatan_mengetahui_skpkd }}
				</td>
		</tr>
		<tr>
				<td colspan="3" style="font-size:26pt;" width="100%">&nbsp;</td>
		</tr>
		<tr>
				<td align="center" style="font-size:9pt;font-weight:bold;text-decoration:underline;" width="46%">
						{{ $data->berita_acara_nama_pa ?? '[NAMA KEPALA SKPD]' }}</td>
				<td width="8%">&nbsp;</td>
				<td align="center" style="font-size:9pt;font-weight:bold;text-decoration:underline;" width="46%">
						{{ $data->berita_acara_nama_mengetahui_skpkd ?? 'M. Adnan, S.E., M.Si.' }}</td>
		</tr>
		<tr>
				<td align="center" style="font-size:8.5pt;" width="46%">NIP.
						{{ $data->berita_acara_nip_pa ?? '[-------------------]' }}</td>
				<td width="8%">&nbsp;</td>
				<td align="center" style="font-size:8.5pt;" width="46%">NIP.
						{{ $data->berita_acara_nip_mengetahui_skpkd ?? '197612262007011010' }}</td>
		</tr>
</table>
