@extends('layout.base_layout')

@section('content')
    <div class="page-head d-flex align-items-center gap-3 flex-wrap mb-4">
        <div>
            <h1>{{ $halaman_judul }}</h1>
            <p>{{ $halaman_deskripsi }}</p>
        </div>
        <div class="ms-auto d-flex gap-2">
            <a href="{{ route('berita_acara.view') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <form class="sheet" id="formBAR" method="POST" action="{{ route('berita_acara.simpan') }}" enctype="multipart/form-data">
        @csrf
        <!-- JUDUL -->
        <div class="doc-title">
            <h1>BERITA ACARA REKONSILIASI PENERIMAAN DAN PENGELUARAN</h1>
            <h2>ANTARA SKPKD DAN SKPD</h2>
            <h3>
                PERIODE <span id="lblPeriode">[BULAN/TRIWULAN]</span> TAHUN
                ANGGARAN <span id="lblTahun">[TAHUN]</span>
            </h3>
        </div>

        <!-- IDENTITAS DOKUMEN -->
        <div class="section-head">A. IDENTITAS DOKUMEN</div>
        <div class="row g-3">
            <div class="col-md-12">
                <label class="form-label">SKPD</label>
                <select class="form-select form-select-sm" id="skpd" name="data[skpd_id]">
                    <option value="" selected>-- Pilih SKPD --</option>
                    @foreach ($ref_skpd as $skpd)
                        <option value="{{ $skpd->skpd_id }}" onclick="selectedSKPD()"
                            {{ old('data.skpd_id') == $skpd->skpd_id ? 'selected' : '' }}>
                            {{ $skpd->skpd_nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Nomor BAR (SKPKD)</label>
                <input type="text" class="form-control form-control-sm" name="data[berita_acara_no_bud]"
                    value="{{ old('data.berita_acara_no_bud') }}" />
            </div>
            <div class="col-md-3">
                <label class="form-label">Nomor BAR (SKPD)</label>
                <input type="text" class="form-control form-control-sm" name="data[berita_acara_no_skpd]"
                    value="{{ old('data.berita_acara_no_skpd') }}" />
            </div>
            <div class="col-md-3">
                <label class="form-label">Periode Rekonsiliasi</label>
                <select class="form-select form-select-sm" id="periode" name="data[berita_acara_periode]">
                    <option value="" selected>-- Pilih Periode --</option>
                    <optgroup label="Bulanan">
                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                            <option value="{{ $bulan }}"
                                {{ old('data.berita_acara_periode') === $bulan ? 'selected' : '' }}>
                                {{ $bulan }}
                            </option>
                        @endforeach
                    </optgroup>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tahun Anggaran</label>
                <input type="number" class="form-control form-control-sm" id="tahun"
                    name="data[berita_acara_tahun_anggaran]"
                    value="{{ old('data.berita_acara_tahun_anggaran', date('Y')) }}" min="2020" max="2100" />
            </div>

            <div class="col-md-3">
                <label class="form-label">Tanggal Berita Acara</label>
                <input type="date" class="form-control form-control-sm" name="data[berita_acara_tanggal]"
                    value="{{ old('data.berita_acara_tanggal', date('Y-m-d')) }}" />
            </div>
            <div class="col-md-9">
                <label class="form-label">Tempat</label>
                <input type="text" class="form-control form-control-sm" name="data[berita_acara_tempat]"
                    value="{{ old('data.berita_acara_tempat', 'Kantor Badan Pengelolaan Keuangan dan Aset Daerah') }}" />
            </div>
            <div class="col-md-6">
                <label class="form-label">File</label>
                <input type="file" class="form-control form-control-sm" name="berita_acara_file" />
            </div>
        </div>

        <!-- I. PENERIMAAN -->
        <div class="section-head">
            I. REKONSILIASI PENERIMAAN (PENDAPATAN)
        </div>
        <p class="hint">
            Berdasarkan pencatatan pada Buku Kas Umum (BKU) Penerimaan SKPD
            dan Catatan Kas Daerah (BUD). Isi nominal tanpa titik — selisih
            dan status terhitung otomatis.
        </p>

        <table class="bar" id="tblPendapatan">
            <thead>
                <tr>
                    <th style="width: 38px">No.</th>
                    <th style="width: 110px">Kode Rekening</th>
                    <th>Uraian Pendapatan</th>
                    <th style="width: 140px">Catatan SKPD (Rp)</th>
                    <th style="width: 140px">Catatan BUD (Rp)</th>
                    <th style="width: 120px">Selisih (Rp)</th>
                    <th style="width: 100px">Keterangan</th>
                    <th style="width: 40px" class="no-print"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center no">1</td>
                    <td>
                        <select class="cell-text sel-ref" data-target="uraian"
                            name="rekening[0][rekening_id]" style="width: 250px;">
                            <option value="" data-uraian="">--Pilih Rekening--</option>
                            @foreach ($rekenings as $rekening)
                                <option value="{{ $rekening->rekening_id }}"
                                    data-uraian="{{ $rekening->rekening_uraian }}">
                                    {{ $rekening->rekening_kode }} - {{ $rekening->rekening_uraian }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="cell-text uraian" name="rekening[0][rekening_uraian]" />
                    </td>
                    <td>
                        <input class="cell-input skpd" type="text" inputmode="numeric"
                            name="rekening[0][skpd]" placeholder="0,00" />
                    </td>
                    <td>
                        <input class="cell-input bud" type="text" inputmode="numeric"
                            name="rekening[0][bud]" placeholder="0,00" />
                    </td>
                    <td>
                        <input class="cell-input num selisih" type="text" readonly
                            name="rekening[0][selisih]" placeholder="0,00" />
                    </td>
                    <td class="text-center ket"></td>
                    <td class="text-center row-tools no-print">
                        <button type="button" onclick="hapusBaris(this)">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="total">
                    <td colspan="3" class="text-end">TOTAL PENERIMAAN</td>
                    <td class="num" id="totPendSKPD">0,00</td>
                    <td class="num" id="totPendBUD">0,00</td>
                    <td class="num" id="totPendSelisih">0,00</td>
                    <td class="text-center" id="totPendKet"></td>
                    <td class="no-print"></td>
                </tr>
            </tfoot>
        </table>
        <button type="button" class="btn btn-sm btn-outline-primary mt-2 no-print"
            onclick="tambahBaris('tblPendapatan', 'rekening')">
            <i class="bi bi-plus-lg"></i> Tambah Baris Pendapatan
        </button>

        <!-- II. BELANJA -->
        <div class="section-head">
            II. REKONSILIASI PENGELUARAN (BELANJA)
        </div>
        <p class="hint">
            Berdasarkan penerbitan Surat Perintah Pencairan Dana (SP2D) oleh
            BUD dan Surat Pertanggungjawaban (SPJ) Pengeluaran oleh SKPD.
        </p>

        <div class="fw-semibold mb-1" style="font-size: 13px">
            II.A Menurut Jenis Belanja
        </div>
        <table class="bar" id="tblJenis">
            <thead>
                <tr>
                    <th style="width: 38px">No.</th>
                    <th style="width: 130px">Jenis Belanja</th>
                    <th>Uraian</th>
                    <th style="width: 140px">Catatan SKPD (Rp)</th>
                    <th style="width: 140px">Catatan BUD (Rp)</th>
                    <th style="width: 120px">Selisih (Rp)</th>
                    <th style="width: 100px">Keterangan</th>
                    <th style="width: 40px" class="no-print"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center no">1</td>
                    <td>
                        <select class="cell-text sel-ref" data-target="uraian"
                            name="belanja[0][belanja_id]" style="width: 250px;">
                            <option value="" data-uraian="">--Pilih Belanja--</option>
                            @foreach ($ref_belanja as $belanjaOption)
                                <option value="{{ $belanjaOption->belanja_id }}"
                                    data-uraian="{{ $belanjaOption->belanja_uraian }}">
                                    {{ $belanjaOption->belanja_nama }} - {{ $belanjaOption->belanja_uraian }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="cell-text uraian" name="belanja[0][belanja_uraian]" />
                    </td>
                    <td>
                        <input class="cell-input skpd" type="text" inputmode="numeric"
                            name="belanja[0][skpd]" placeholder="0,00" />
                    </td>
                    <td>
                        <input class="cell-input bud" type="text" inputmode="numeric"
                            name="belanja[0][bud]" placeholder="0,00" />
                    </td>
                    <td>
                        <input class="cell-input num selisih" type="text" readonly
                            name="belanja[0][selisih]" placeholder="0,00" />
                    </td>
                    <td class="text-center ket"></td>
                    <td class="text-center row-tools no-print">
                        <button type="button" onclick="hapusBaris(this)">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="total">
                    <td colspan="3" class="text-end">
                        TOTAL BELANJA (JENIS)
                    </td>
                    <td class="num" id="totJenisSKPD">0,00</td>
                    <td class="num" id="totJenisBUD">0,00</td>
                    <td class="num" id="totJenisSelisih">0,00</td>
                    <td class="text-center" id="totJenisKet"></td>
                    <td class="no-print"></td>
                </tr>
            </tfoot>
        </table>
        <button type="button" class="btn btn-sm btn-outline-primary mt-2 no-print"
            onclick="tambahBaris('tblJenis', 'belanja')">
            <i class="bi bi-plus-lg"></i> Tambah Baris Jenis Belanja
        </button>

        <div class="fw-semibold mb-1 mt-4" style="font-size: 13px">
            II.B Menurut Mekanisme Pencairan
        </div>
        <p class="hint">
            Nilai pengembalian ke kasda diisi negatif (contoh: -4479062).
        </p>
        <table class="bar" id="tblMekanisme">
            <thead>
                <tr>
                    <th style="width: 38px">No.</th>
                    <th style="width: 130px">Mekanisme</th>
                    <th>Uraian</th>
                    <th style="width: 140px">Catatan SKPD (Rp)</th>
                    <th style="width: 140px">Catatan BUD (Rp)</th>
                    <th style="width: 120px">Selisih (Rp)</th>
                    <th style="width: 100px">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center no">1</td>
                    <td>Mekanisme SP2D-LS</td>
                    <td>
                        <input class="cell-text" value="Langsung ke Pihak Ketiga / Gaji" readonly />
                    </td>
                    <td>
                        <input name="data[berita_acara_sp2dLS_skpd]" class="cell-input skpd" type="text"
                            inputmode="numeric" placeholder="0,00"
                            value="{{ old('data.berita_acara_sp2dLS_skpd') }}" />
                    </td>
                    <td>
                        <input name="data[berita_acara_sp2dLS_bud]" class="cell-input bud" type="text"
                            inputmode="numeric" placeholder="0,00"
                            value="{{ old('data.berita_acara_sp2dLS_bud') }}" />
                    </td>
                    <td class="num selisih"></td>
                    <input type="hidden" name="data[berita_acara_sp2dLS_selisih]" class="hid-selisih" />
                    <td class="text-center ket"></td>
                </tr>
                <tr>
                    <td class="text-center no">2</td>
                    <td>Mekanisme SP2D-UP/GU/TU</td>
                    <td>
                        <input class="cell-text" value="Uang Persediaan / Ganti Uang" readonly />
                    </td>
                    <td>
                        <input name="data[berita_acara_sp2dUP_skpd]" class="cell-input skpd" type="text"
                            inputmode="numeric" placeholder="0,00"
                            value="{{ old('data.berita_acara_sp2dUP_skpd') }}" />
                    </td>
                    <td>
                        <input name="data[berita_acara_sp2dUP_bud]" class="cell-input bud" type="text"
                            inputmode="numeric" placeholder="0,00"
                            value="{{ old('data.berita_acara_sp2dUP_bud') }}" />
                    </td>
                    <td class="num selisih"></td>
                    <input type="hidden" name="data[berita_acara_sp2dUP_selisih]" class="hid-selisih" />
                    <td class="text-center ket"></td>
                </tr>
                <tr>
                    <td class="text-center no">2</td>
                    <td>Mekanisme SPB/SP2BP</td>
                    <td>
                        <input class="cell-text" value="Pengesahan realisasi anggaran dana" readonly />
                    </td>
                    <td>
                        <input name="data[berita_acara_sp2BP_skpd]" class="cell-input skpd" type="text"
                            inputmode="numeric" placeholder="0,00"
                            value="{{ old('data.berita_acara_sp2BP_skpd') }}" />
                    </td>
                    <td>
                        <input name="data[berita_acara_sp2BP_bud]" class="cell-input bud" type="text"
                            inputmode="numeric" placeholder="0,00"
                            value="{{ old('data.berita_acara_sp2BP_bud') }}" />
                    </td>
                    <td class="num selisih"></td>
                    <input type="hidden" name="data[berita_acara_sp2BP_selisih]" class="hid-selisih" />
                    <td class="text-center ket"></td>
                </tr>
                <tr>
                    <td class="text-center no">3</td>
                    <td>STS</td>
                    <td>
                        <input name="data[berita_acara_sts_uraian]" class="cell-text"
                            value="Pengembalian ke Kasda (-)" readonly />
                    </td>
                    <td>
                        <input name="data[berita_acara_sts_skpd]" class="cell-input skpd" type="text"
                            inputmode="numeric" placeholder="-0,00"
                            value="{{ old('data.berita_acara_sts_skpd') }}" data-minus="1" />
                    </td>
                    <td>
                        <input name="data[berita_acara_sts_bud]" class="cell-input bud" type="text"
                            inputmode="numeric" placeholder="-0,00"
                            value="{{ old('data.berita_acara_sts_bud') }}" data-minus="1" />
                    </td>
                    <td class="num selisih"></td>
                    <input type="hidden" name="data[berita_acara_sts_selisih]" class="hid-selisih" />
                    <td class="text-center ket"></td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="total">
                    <td colspan="3" class="text-end">
                        TOTAL BELANJA (MEKANISME)
                    </td>
                    <td class="num" id="totMekSKPD">0,00</td>
                    <td class="num" id="totMekBUD">0,00</td>
                    <td class="num" id="totMekSelisih">0,00</td>
                    <td class="text-center" id="totMekKet"></td>
                </tr>
                <tr class="grand">
                    <td colspan="3" class="text-end">
                        SELISIH (POTENSI SISA UP/GU/TU)
                    </td>
                    <td class="num" id="gapSKPD">0,00</td>
                    <td class="num" id="gapBUD">0,00</td>
                    <td class="num" id="gapSelisih">0,00</td>
                    <td class="text-center" id="gapKet"></td>
                </tr>
            </tfoot>
        </table>

        <!-- III. SALDO KAS -->
        <div class="section-head">
            III. REKONSILIASI SALDO KAS DAN SISA UP/GU/TU
        </div>
        <table class="bar" id="tblSaldo">
            <thead>
                <tr>
                    <th style="width: 38px">No.</th>
                    <th>Uraian Saldo Kas</th>
                    <th style="width: 160px">Jumlah (Rp)</th>
                    <th style="width: 200px">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Saldo Awal Bulan Kas di Bendahara Pengeluaran</td>
                    <td>
                        <input class="cell-input saldo" type="text" inputmode="numeric" placeholder="0,00"
                            name="data[berita_acara_saldo_awal_bulan]"
                            value="{{ old('data.berita_acara_saldo_awal_bulan') }}" />
                    </td>
                    <td>Kas Awal Bulan</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Penerimaan SP2D (UP/GU/TU) Periode Ini</td>
                    <td>
                        <input class="cell-input saldo" type="text" inputmode="numeric" placeholder="0,00"
                            name="data[berita_acara_penerimaan_sp2d]"
                            value="{{ old('data.berita_acara_penerimaan_sp2d') }}" />
                    </td>
                    <td>Pencairan UP/GU/TU</td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>Pengeluaran BKU (SPJ Belanja UP/GU/TU)</td>
                    <td>
                        <input class="cell-input saldo" type="text" inputmode="numeric" placeholder="-0,00"
                            name="data[berita_acara_pengeluaran_bku]"
                            value="{{ old('data.berita_acara_pengeluaran_bku') }}" data-minus="1" />
                    </td>
                    <td>Realisasi UP/GU/TU</td>
                </tr>
                <tr>
                    <td class="text-center">4</td>
                    <td>Pengembalian Sisa UP/GU/TU (STS/S3UP)</td>
                    <td>
                        <input class="cell-input saldo" type="text" inputmode="numeric" placeholder="0,00"
                            name="data[berita_acara_pengembalian]"
                            value="{{ old('data.berita_acara_pengembalian') }}" />
                    </td>
                    <td>Penyetoran Sisa Kas</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="grand">
                    <td colspan="2" class="text-end">
                        SALDO AKHIR KAS DI BENDAHARA PENGELUARAN
                    </td>
                    <td class="num" id="saldoAkhir">0,00</td>
                    <td class="text-center" id="saldoKet"></td>
                </tr>
            </tfoot>
        </table>

        <!-- IV. CATATAN -->
        <div class="section-head">IV. CATATAN DAN KESIMPULAN</div>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Catatan Tambahan / Tindak Lanjut</label>
                <textarea class="form-control form-control-sm" name="data[berita_acara_kesimpulan]" rows="5">{{ old('data.berita_acara_kesimpulan', 'Data Penerimaan dan Pengeluaran antara BUD dan SKPD untuk periode ini dinyatakan TELAH SESUAI/COCOK.
Berita Acara ini dibuat dalam rangkap 2 (dua) sebagai bahan penyusunan Laporan Keuangan Pemerintah Daerah (LKPD).') }}</textarea>
            </div>
        </div>

        <!-- TANDA TANGAN -->
        <div class="section-head">V. PENANDATANGANAN</div>
        <div class="row mt-3">
            <div class="col-6 sign-box">
                <div class="fw-bold">PIHAK KEDUA</div>
                <div>Pejabat Penatausahaan Keuangan (PPK-SKPD)</div>
                <div class="sign-space"></div>
                <input type="text" class="form-control form-control-sm text-center fw-bold mb-1" name="data[berita_acara_nama_ppk]" id="berita_acara_nama_ppk"
                    placeholder="[NAMA PEJABAT/PPK SKPD]" value="{{ old('berita_acara_nama_ppk') }}" />
                <input type="text" class="form-control form-control-sm text-center" name="data[berita_acara_nip_ppk]" id="berita_acara_nip_ppk"
                    placeholder="NIP. ..." value="{{ old('berita_acara_nip_ppk') }}" />
            </div>
            <div class="col-6 sign-box">
                <div class="fw-bold">PIHAK KESATU</div>
                <input type="text" class="form-control form-control-sm text-center fw-bold mb-1" name="data[berita_acara_jabatan_kepala_skpkd]"
                    value="Kepala Sub Bidang Penerimaan dan Belanja"/>
                <div class="sign-space"></div>
                <input type="text" class="form-control form-control-sm text-center fw-bold mb-1" name="data[berita_acara_nama_kepala_skpkd]"
                    value="Ichtiawan J. Aziz, S.E.I"/>
                <input type="text" class="form-control form-control-sm text-center" name="data[berita_acara_nip_kepala_skpkd]"
                    value="198506162020121006"/>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-6 sign-box">
                <div class="fw-bold">MENGETAHUI / MENYETUJUI:</div>
                <div>Pengguna Anggaran</div>
                <div class="sign-space"></div>
                <input type="text" class="form-control form-control-sm text-center fw-bold mb-1" name="data[berita_acara_nama_pa]" id="berita_acara_nama_pa"
                    placeholder="[NAMA KEPALA SKPD]" value="{{ old('berita_acara_nama_pa') }}" />
                <input type="text" class="form-control form-control-sm text-center" name="data[berita_acara_nip_pa]" id="berita_acara_nip_pa"
                    placeholder="NIP. ..." value="{{ old('berita_acara_nip_pa') }}" />
            </div>
            <div class="col-6 sign-box">
                <div class="fw-bold">MENGETAHUI / MENYETUJUI:</div>
                <input type="text" class="form-control form-control-sm text-center fw-bold mb-1" name="data[berita_acara_jabatan_mengetahui_skpkd]"
                    value="Kepala Bidang Akuntansi"/>
                <div class="sign-space"></div>
                <input type="text" class="form-control form-control-sm text-center fw-bold mb-1" name="data[berita_acara_nama_mengetahui_skpkd]"
                    value="M. Adnan, S.E., M.Si."/>
                <input type="text" class="form-control form-control-sm text-center" name="data[berita_acara_nip_mengetahui_skpkd]"
                    value="197612262007011010"/>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4 no-print justify-content-end mt-5">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-download"></i> Simpan Data
            </button>
        </div>

        <div class="text-center mt-4"
            style="font-size: 11px; color: #777; border-top: 1px solid var(--bar-line); padding-top: 8px;">
            BAR Penerimaan dan Pengeluaran
            <span id="lblTahunFooter">{{ date('Y') }}</span>
        </div>
    </form>
@endsection

@push('style')
    <style>
        /* Input nominal disamakan dengan tampilan baris TOTAL */
        .cell-input.skpd,
        .cell-input.bud,
        .cell-input.saldo,
        .cell-input.selisih {
            text-align: right;
            font-variant-numeric: tabular-nums;
        }

        .cell-input.selisih {
            background: transparent;
            font-weight: 600;
        }

        .cell-input.neg,
        td.num.neg {
            color: #c1121f;
        }
    </style>
@endpush

@push('script')
    <script>
        const fmt = (n) =>
            (n < 0 ? "-" : "") +
            Math.abs(n).toLocaleString("id-ID", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });

        const parse = (v) => {
            let t = String(v ?? "").trim();
            if (t === "") return 0;

            const negatif = t.indexOf("-") !== -1;

            // buang semua kecuali digit, titik, koma
            t = t.replace(/[^\d.,]/g, "");

            if (t.indexOf(",") !== -1) {
                // ada koma -> koma adalah desimal, titik adalah ribuan
                t = t.replace(/\./g, "").replace(",", ".");
            } else {
                // tanpa koma -> titik dianggap pemisah ribuan
                t = t.replace(/\./g, "");
            }

            const n = parseFloat(t);
            if (isNaN(n)) return 0;
            return negatif ? -Math.abs(n) : n;
        };

        // nilai input dengan format ribuan
        function formatInput(el) {
            if (!el) return;
            if (String(el.value).trim() === "") return; // biarkan kosong -> placeholder tampil
            el.value = fmt(parse(el.value));
        }

        // saat ketik tampil nilai mentah
        function bukaFormatInput(el) {
            if (!el) return;
            const n = parse(el.value);
            el.value = n === 0 && String(el.value).trim() === "" ? "" : String(n);
        }

        // format semua input saat load
        function formatSemuaInput() {
            document
                .querySelectorAll(".cell-input.skpd, .cell-input.bud, .cell-input.saldo")
                .forEach(formatInput);
        }

        function setSel(el, val) {
            if (!el) return;
            el.textContent = fmt(val);
            el.classList.toggle("neg", val < 0);
        }

        function badge(cocok, textCocok = "Cocok", textTidak = "Tidak Cocok") {
            return `<span class="badge-st ${cocok ? "badge-cocok" : "badge-tidak"}">${cocok ? textCocok : textTidak}</span>`;
        }

        // isi uraian dari dropdown
        function isiUraian(sel) {
            const row = sel.closest("tr");
            if (!row) return;
            const opt = sel.options[sel.selectedIndex];
            const uraian = opt ? (opt.dataset.uraian || "") : "";
            const target = row.querySelector("input.uraian");
            if (target) target.value = uraian;
        }
        
        // hitung tabel
        function hitungTabel(id, pfx, opt = {}) {
            const arah = opt.arah || "bud-skpd";
            const ketTotal = opt.ketTotal || ["Sesuai", "Tidak Sesuai"];

            const tb = document.querySelector("#" + id + " tbody");
            if (!tb) return { ts: 0, tb: 0, selisih: 0 };

            let ts = 0,
                tbud = 0;

            [...tb.rows].forEach((r, i) => {
                const no = r.querySelector(".no");
                if (no) no.textContent = i + 1;

                const skpdEl = r.querySelector(".skpd");
                const budEl = r.querySelector(".bud");
                if (!skpdEl) return;

                const s = parse(skpdEl.value);
                const b = budEl ? parse(budEl.value) : 0;

                // arah pengurangan sesuai rumus Excel
                const d = arah === "skpd-bud" ? s - b : b - s;

                ts += s;
                tbud += b;

                const selEl = r.querySelector(".selisih");
                if (selEl) {
                    if (selEl.tagName === "INPUT") {
                        selEl.value = fmt(d);
                        selEl.classList.toggle("neg", d < 0);
                    } else {
                        setSel(selEl, d);
                    }
                }

                // sinkronkan hidden input (tabel Mekanisme) agar tersimpan ke DB
                const hidEl = r.querySelector(".hid-selisih");
                if (hidEl) hidEl.value = d;

                const ketEl = r.querySelector(".ket");
                if (ketEl) ketEl.innerHTML = badge(d === 0, "Cocok", "Tidak Cocok");
            });

            const totSelisih = arah === "skpd-bud" ? ts - tbud : tbud - ts;

            const elSKPD = document.getElementById(pfx + "SKPD");
            const elBUD = document.getElementById(pfx + "BUD");
            const elSelisih = document.getElementById(pfx + "Selisih");
            const elKet = document.getElementById(pfx + "Ket");

            if (elSKPD) elSKPD.textContent = fmt(ts);
            if (elBUD) elBUD.textContent = fmt(tbud);
            setSel(elSelisih, totSelisih);
            if (elKet) {
                elKet.innerHTML = badge(totSelisih === 0, ketTotal[0], ketTotal[1]);
            }

            return { ts, tb: tbud, selisih: totSelisih };
        }

        function hitungSemua() {
            // I. PENDAPATAN  -> Selisih = SKPD - BUD
            hitungTabel("tblPendapatan", "totPend", {
                arah: "skpd-bud",
                ketTotal: ["Sesuai", "Tidak Sesuai"],
            });

            // II.A JENIS BELANJA -> Selisih = BUD - SKPD
            const j = hitungTabel("tblJenis", "totJenis", {
                arah: "bud-skpd",
                ketTotal: ["Sesuai", "Tidak Sesuai"],
            });

            // II.B MEKANISME -> Selisih = BUD - SKPD, ket total "Sesuai"/"Potensi"
            const m = hitungTabel("tblMekanisme", "totMek", {
                arah: "bud-skpd",
                ketTotal: ["Sesuai", "Potensi"],
            });

            // SELISIH (POTENSI SISA UP/GU/TU) = Mekanisme - Jenis
            const gS = m.ts - j.ts;
            const gB = m.tb - j.tb;
            const gSel = gB - gS;

            setSel(document.getElementById("gapSKPD"), gS);
            setSel(document.getElementById("gapBUD"), gB);
            setSel(document.getElementById("gapSelisih"), gSel);

            const gapKet = document.getElementById("gapKet");
            if (gapKet) gapKet.innerHTML = badge(gSel === 0, "Sesuai", "Potensi");

            // III. SALDO KAS = SUM(4 baris)
            let sa = 0;
            document
                .querySelectorAll("#tblSaldo .saldo")
                .forEach((i) => (sa += parse(i.value)));
            setSel(document.getElementById("saldoAkhir"), sa);

            // Ket: IF(SaldoAkhir = gapBUD, "Sesuai", "Nihil")
            const saldoKet = document.getElementById("saldoKet");
            if (saldoKet) {
                saldoKet.innerHTML = badge(Math.abs(sa - gB) < 0.01, "Sesuai", "Nihil");
            }

            // Header dinamis
            const pEl = document.getElementById("periode");
            const tEl = document.getElementById("tahun");
            const p = pEl ? pEl.value : "";
            const t = tEl ? tEl.value : "";

            const lblPeriode = document.getElementById("lblPeriode");
            const lblTahun = document.getElementById("lblTahun");
            const lblTahunFooter = document.getElementById("lblTahunFooter");

            if (lblPeriode) lblPeriode.textContent = p || "[BULAN/TRIWULAN]";
            if (lblTahun) lblTahun.textContent = t || "[TAHUN]";
            if (lblTahunFooter) lblTahunFooter.textContent = t || "{{ date('Y') }}";
        }

        // tambah dan hapus baris
        function tambahBaris(id, indexPrefix = "rekening") {
            const tb = document.querySelector("#" + id + " tbody");
            if (!tb || tb.rows.length === 0) return;

            const newIndex = tb.rows.length;
            const nr = tb.rows[tb.rows.length - 1].cloneNode(true);

            const noCell = nr.querySelector(".no");
            if (noCell) noCell.textContent = newIndex + 1;

            nr.querySelectorAll("input, select").forEach((i) => {
                if (i.tagName === "SELECT") {
                    i.selectedIndex = 0;
                } else {
                    i.value = "";
                }

                const currentName = i.getAttribute("name");
                if (currentName) {
                    const newName = currentName.replace(
                        new RegExp(`${indexPrefix}\\[\\d+\\]`),
                        `${indexPrefix}[${newIndex}]`
                    );
                    i.setAttribute("name", newName);
                }
            });

            const ketCell = nr.querySelector(".ket");
            if (ketCell) ketCell.innerHTML = "";

            tb.appendChild(nr);

            bindAll();
            hitungSemua();
        }

        function hapusBaris(btn) {
            const tb = btn.closest("tbody");
            if (tb.rows.length <= 1) {
                alert("Minimal satu baris harus tersisa.");
                return;
            }
            btn.closest("tr").remove();
            bindAll();
            hitungSemua();
        }


        function bindAll() {
            // input angka & teks biasa
            document
                .querySelectorAll(".cell-input, .cell-text, #periode, #tahun")
                .forEach((el) => {
                    el.oninput = hitungSemua;
                    el.onchange = hitungSemua;
                });

            // input nominal SKPD / BUD / Saldo -> format ribuan saat blur
            document
                .querySelectorAll(".cell-input.skpd, .cell-input.bud, .cell-input.saldo")
                .forEach((el) => {
                    if (el.readOnly) return;

                    el.onfocus = function () {
                        bukaFormatInput(this);
                        this.select();
                    };

                    el.onblur = function () {
                        // input STS & Pengeluaran BKU wajib negatif
                        if (this.dataset.minus === "1") {
                            const n = parse(this.value);
                            if (n > 0) this.value = -n;
                        }
                        formatInput(this);
                        hitungSemua();
                    };
                });

            // dropdown referensi -> auto isi uraian
            document.querySelectorAll("select.sel-ref").forEach((sel) => {
                sel.onchange = function () {
                    isiUraian(this);
                    hitungSemua();
                };
            });
        }

        //bersihkan data sebelum submit
        function bersihkanSebelumSubmit() {
            document
                .querySelectorAll(
                    ".cell-input.skpd, .cell-input.bud, .cell-input.saldo, .cell-input.selisih"
                )
                .forEach((el) => {
                    el.value = String(parse(el.value));
                });
        }

        document.addEventListener("DOMContentLoaded", function () {
            bindAll();
            formatSemuaInput();
            hitungSemua();

            const form = document.getElementById("formBAR");
            if (form) form.addEventListener("submit", bersihkanSebelumSubmit);
        });

        const listSkpd = @json($ref_skpd);
        document.getElementById('skpd').addEventListener('change', function() {
            const selectedId = this.value;
        
            // Cari data spesifik berdasarkan id yang dipilih dari semua data
            const selectedData = listSkpd.find(item => item.skpd_id == selectedId);
        
            if (selectedData) {
                document.getElementById('berita_acara_nama_ppk').value = selectedData.skpd_nama_ppk ?? ''
                document.getElementById('berita_acara_nip_ppk').value = selectedData.skpd_nip_ppk ?? ''
                document.getElementById('berita_acara_nama_pa').value = selectedData.skpd_nama_pa ?? ''
                document.getElementById('berita_acara_nip_pa').value = selectedData.skpd_nip_pa ?? ''
            }
        });
    </script>
@endpush