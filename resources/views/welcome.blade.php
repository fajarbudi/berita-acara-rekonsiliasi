@extends('layout.base_layout')

@section('content')
           <div class="toolbar no-print">
            <span class="title"
                ><i class="bi bi-file-earmark-text"></i> Form Berita Acara
                Rekonsiliasi PB BUD–SKPD</span
            >
            <button class="btn btn-sm btn-light" onclick="hitungSemua()">
                <i class="bi bi-calculator"></i> Hitung Ulang
            </button>
            <button class="btn btn-sm btn-warning" onclick="window.print()">
                <i class="bi bi-printer"></i> Cetak / PDF
            </button>
        </div>

        <form class="sheet" id="formBAR">
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
                <div class="col-md-3">
                    <label class="form-label">Nomor BAR (BUD)</label>
                    <input
                        type="text"
                        class="form-control form-control-sm"
                        name="no_bar_bud"
                        placeholder="900/____/BPKAD/2026"
                    />
                </div>
                <div class="col-md-3">
                    <label class="form-label">Nomor BAR (SKPD)</label>
                    <input
                        type="text"
                        class="form-control form-control-sm"
                        name="no_bar_skpd"
                        placeholder="900/____/SKPD/2026"
                    />
                </div>
                <div class="col-md-3">
                    <label class="form-label">Periode Rekonsiliasi</label>
                    <select
                        class="form-select form-select-sm"
                        id="periode"
                        name="periode"
                    >
                        <option value="" selected>-- Pilih Periode --</option>
                        <optgroup label="Bulanan">
                            <option>Januari</option>
                            <option>Februari</option>
                            <option>Maret</option>
                            <option>April</option>
                            <option>Mei</option>
                            <option>Juni</option>
                            <option>Juli</option>
                            <option>Agustus</option>
                            <option>September</option>
                            <option>Oktober</option>
                            <option>November</option>
                            <option>Desember</option>
                        </optgroup>
                        <optgroup label="Triwulan">
                            <option>Triwulan I</option>
                            <option>Triwulan II</option>
                            <option>Triwulan III</option>
                            <option>Triwulan IV</option>
                        </optgroup>
                        <option>Semester I</option>
                        <option>Semester II</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tahun Anggaran</label>
                    <input
                        type="number"
                        class="form-control form-control-sm"
                        id="tahun"
                        name="tahun"
                        value="2026"
                        min="2020"
                        max="2100"
                    />
                </div>

                <div class="col-md-3">
                    <label class="form-label">Hari</label>
                    <select class="form-select form-select-sm" name="hari">
                        <option value="">-- Pilih Hari --</option>
                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                        <option>Sabtu</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Berita Acara</label>
                    <input
                        type="date"
                        class="form-control form-control-sm"
                        name="tgl_bar"
                    />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tempat</label>
                    <input
                        type="text"
                        class="form-control form-control-sm"
                        name="tempat"
                        value="Kantor Badan Pengelolaan Keuangan dan Aset Daerah"
                    />
                </div>
            </div>

            <!-- PIHAK -->
            <div class="section-head">B. PARA PIHAK</div>

            <div class="border rounded p-3 mb-3" style="background: #f8f9fc">
                <div
                    class="fw-bold text-uppercase mb-2"
                    style="color: var(--bar-navy)"
                >
                    1. Pihak Kesatu (SKPKD / BUD)
                </div>
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label">Nama Pejabat SKPKD</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            name="nama_p1"
                            placeholder="Nama lengkap dan gelar"
                        />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">NIP</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            name="nip_p1"
                            placeholder="18 digit"
                        />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jabatan</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            name="jab_p1"
                            value="Kepala Sub Bidang Penerimaan dan Belanja"
                        />
                    </div>
                    <div class="col-12">
                        <label class="form-label"
                            >Bertindak untuk dan atas nama</label
                        >
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            name="instansi_p1"
                            value="BPKAD selaku SKPKD Pemerintah Kabupaten Kutai Timur"
                        />
                    </div>
                </div>
            </div>

            <div class="border rounded p-3" style="background: #f8f9fc">
                <div
                    class="fw-bold text-uppercase mb-2"
                    style="color: var(--bar-navy)"
                >
                    2. Pihak Kedua (SKPD)
                </div>
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label">Nama Pejabat SKPD</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            name="nama_p2"
                            placeholder="Nama lengkap dan gelar"
                        />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">NIP</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            name="nip_p2"
                            placeholder="18 digit"
                        />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jabatan</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            name="jab_p2"
                            value="Pejabat Penatausahaan Keuangan (PPK-SKPD)"
                        />
                    </div>
                    <div class="col-12">
                        <label class="form-label">Nama SKPD</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            name="nama_skpd"
                            placeholder="Contoh: Dinas Pendidikan Kabupaten Kutai Timur"
                        />
                    </div>
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
                        <td><input class="cell-text" value="4.1.01" /></td>
                        <td>
                            <input class="cell-text" value="Pajak Daerah" />
                        </td>
                        <td>
                            <input
                                class="cell-input skpd"
                                type="text"
                                inputmode="numeric"
                                value="10000000"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input bud"
                                type="text"
                                inputmode="numeric"
                                value="10000000"
                            />
                        </td>
                        <td class="num selisih">0,00</td>
                        <td class="text-center ket"></td>
                        <td class="text-center row-tools no-print">
                            <button type="button" onclick="hapusBaris(this)">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center no">2</td>
                        <td><input class="cell-text" value="4.1.02" /></td>
                        <td>
                            <input class="cell-text" value="Retribusi Daerah" />
                        </td>
                        <td>
                            <input
                                class="cell-input skpd"
                                type="text"
                                inputmode="numeric"
                                value="20302000"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input bud"
                                type="text"
                                inputmode="numeric"
                                value="20302000"
                            />
                        </td>
                        <td class="num selisih">0,00</td>
                        <td class="text-center ket"></td>
                        <td class="text-center row-tools no-print">
                            <button type="button" onclick="hapusBaris(this)">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center no">3</td>
                        <td><input class="cell-text" value="4.1.03" /></td>
                        <td>
                            <input
                                class="cell-text"
                                value="Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input skpd"
                                type="text"
                                inputmode="numeric"
                                value="500000"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input bud"
                                type="text"
                                inputmode="numeric"
                                value="500000"
                            />
                        </td>
                        <td class="num selisih">0,00</td>
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
            <button
                type="button"
                class="btn btn-sm btn-outline-primary mt-2 no-print"
                onclick="tambahBaris('tblPendapatan')"
            >
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
                        <th style="width: 130px">Jenis / Mekanisme Belanja</th>
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
                            <select class="cell-text">
                                <option selected>Belanja Operasi</option>
                                <option>Belanja Modal</option>
                                <option>Belanja Tidak Terduga</option>
                                <option>Belanja Transfer</option>
                            </select>
                        </td>
                        <td>
                            <input class="cell-text" value="Belanja Pegawai" />
                        </td>
                        <td>
                            <input
                                class="cell-input skpd"
                                type="text"
                                inputmode="numeric"
                                value="14102977706"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input bud"
                                type="text"
                                inputmode="numeric"
                                value="14102977706"
                            />
                        </td>
                        <td class="num selisih">0,00</td>
                        <td class="text-center ket"></td>
                        <td class="text-center row-tools no-print">
                            <button type="button" onclick="hapusBaris(this)">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center no">2</td>
                        <td>
                            <select class="cell-text">
                                <option selected>Belanja Operasi</option>
                                <option>Belanja Modal</option>
                                <option>Belanja Tidak Terduga</option>
                                <option>Belanja Transfer</option>
                            </select>
                        </td>
                        <td>
                            <input
                                class="cell-text"
                                value="Belanja Barang dan Jasa"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input skpd"
                                type="text"
                                inputmode="numeric"
                                value="1372444318"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input bud"
                                type="text"
                                inputmode="numeric"
                                value="1372444318"
                            />
                        </td>
                        <td class="num selisih">0,00</td>
                        <td class="text-center ket"></td>
                        <td class="text-center row-tools no-print">
                            <button type="button" onclick="hapusBaris(this)">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center no">3</td>
                        <td>
                            <select class="cell-text">
                                <option selected>Belanja Operasi</option>
                                <option>Belanja Modal</option>
                                <option>Belanja Tidak Terduga</option>
                                <option>Belanja Transfer</option>
                            </select>
                        </td>
                        <td>
                            <input class="cell-text" value="Belanja Hibah" />
                        </td>
                        <td>
                            <input
                                class="cell-input skpd"
                                type="text"
                                inputmode="numeric"
                                value="0"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input bud"
                                type="text"
                                inputmode="numeric"
                                value="0"
                            />
                        </td>
                        <td class="num selisih">0,00</td>
                        <td class="text-center ket"></td>
                        <td class="text-center row-tools no-print">
                            <button type="button" onclick="hapusBaris(this)">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center no">4</td>
                        <td>
                            <select class="cell-text">
                                <option>Belanja Operasi</option>
                                <option selected>Belanja Modal</option>
                                <option>Belanja Tidak Terduga</option>
                                <option>Belanja Transfer</option>
                            </select>
                        </td>
                        <td>
                            <input
                                class="cell-text"
                                value="Belanja Modal Peralatan dan Mesin"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input skpd"
                                type="text"
                                inputmode="numeric"
                                value="0"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input bud"
                                type="text"
                                inputmode="numeric"
                                value="0"
                            />
                        </td>
                        <td class="num selisih">0,00</td>
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
            <button
                type="button"
                class="btn btn-sm btn-outline-primary mt-2 no-print"
                onclick="tambahBaris('tblJenis')"
            >
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
                        <th style="width: 40px" class="no-print"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center no">1</td>
                        <td>
                            <select class="cell-text">
                                <option selected>Mekanisme SP2D-LS</option>
                                <option>Mekanisme SP2D-UP/GU/TU</option>
                                <option>STS</option>
                            </select>
                        </td>
                        <td>
                            <input
                                class="cell-text"
                                value="Langsung ke Pihak Ketiga / Gaji"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input skpd"
                                type="text"
                                inputmode="numeric"
                                value="14107456768"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input bud"
                                type="text"
                                inputmode="numeric"
                                value="14107456768"
                            />
                        </td>
                        <td class="num selisih">0,00</td>
                        <td class="text-center ket"></td>
                        <td class="text-center row-tools no-print">
                            <button type="button" onclick="hapusBaris(this)">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center no">2</td>
                        <td>
                            <select class="cell-text">
                                <option>Mekanisme SP2D-LS</option>
                                <option selected>
                                    Mekanisme SP2D-UP/GU/TU
                                </option>
                                <option>STS</option>
                            </select>
                        </td>
                        <td>
                            <input
                                class="cell-text"
                                value="Uang Persediaan / Ganti Uang"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input skpd"
                                type="text"
                                inputmode="numeric"
                                value="1372444318"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input bud"
                                type="text"
                                inputmode="numeric"
                                value="1607284318"
                            />
                        </td>
                        <td class="num selisih">0,00</td>
                        <td class="text-center ket"></td>
                        <td class="text-center row-tools no-print">
                            <button type="button" onclick="hapusBaris(this)">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center no">3</td>
                        <td>
                            <select class="cell-text">
                                <option>Mekanisme SP2D-LS</option>
                                <option>Mekanisme SP2D-UP/GU/TU</option>
                                <option selected>STS</option>
                            </select>
                        </td>
                        <td>
                            <input
                                class="cell-text"
                                value="Pengembalian ke Kasda (-)"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input skpd"
                                type="text"
                                inputmode="numeric"
                                value="-4479062"
                            />
                        </td>
                        <td>
                            <input
                                class="cell-input bud"
                                type="text"
                                inputmode="numeric"
                                value="-4479062"
                            />
                        </td>
                        <td class="num selisih">0,00</td>
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
                            TOTAL BELANJA (MEKANISME)
                        </td>
                        <td class="num" id="totMekSKPD">0,00</td>
                        <td class="num" id="totMekBUD">0,00</td>
                        <td class="num" id="totMekSelisih">0,00</td>
                        <td class="text-center" id="totMekKet"></td>
                        <td class="no-print"></td>
                    </tr>
                    <tr class="grand">
                        <td colspan="3" class="text-end">
                            SELISIH (POTENSI SISA UP/GU/TU)
                        </td>
                        <td class="num" id="gapSKPD">0,00</td>
                        <td class="num" id="gapBUD">0,00</td>
                        <td class="num" id="gapSelisih">0,00</td>
                        <td class="text-center" id="gapKet"></td>
                        <td class="no-print"></td>
                    </tr>
                </tfoot>
            </table>
            <button
                type="button"
                class="btn btn-sm btn-outline-primary mt-2 no-print"
                onclick="tambahBaris('tblMekanisme')"
            >
                <i class="bi bi-plus-lg"></i> Tambah Baris Mekanisme
            </button>

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
                            <input
                                class="cell-input saldo"
                                type="text"
                                inputmode="numeric"
                                value="234840000"
                            />
                        </td>
                        <td>Kas Awal Bulan</td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Penerimaan SP2D (UP/GU/TU) Periode Ini</td>
                        <td>
                            <input
                                class="cell-input saldo"
                                type="text"
                                inputmode="numeric"
                                value="224026427"
                            />
                        </td>
                        <td>Pencairan UP/GU/TU</td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Pengeluaran BKU (SPJ Belanja UP/GU/TU)</td>
                        <td>
                            <input
                                class="cell-input saldo"
                                type="text"
                                inputmode="numeric"
                                value="-224026427"
                            />
                        </td>
                        <td>Realisasi UP/GU/TU</td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td>Pengembalian Sisa UP/GU/TU (STS/S3UP)</td>
                        <td>
                            <input
                                class="cell-input saldo"
                                type="text"
                                inputmode="numeric"
                                value="0"
                            />
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
                <div class="col-md-4">
                    <label class="form-label">Status Kesimpulan</label>
                    <select
                        class="form-select form-select-sm"
                        name="status_simpul"
                    >
                        <option selected>TELAH SESUAI / COCOK</option>
                        <option>SESUAI DENGAN CATATAN</option>
                        <option>TIDAK SESUAI — PERLU TINDAK LANJUT</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Dibuat Rangkap</label>
                    <input
                        type="number"
                        class="form-control form-control-sm"
                        name="rangkap"
                        value="2"
                        min="1"
                    />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Peruntukan</label>
                    <input
                        type="text"
                        class="form-control form-control-sm"
                        name="peruntukan"
                        value="Bahan penyusunan Laporan Keuangan Pemerintah Daerah (LKPD)"
                    />
                </div>
                <div class="col-12">
                    <label class="form-label"
                        >Catatan Tambahan / Tindak Lanjut</label
                    >
                    <textarea
                        class="form-control form-control-sm"
                        name="catatan"
                        rows="3"
                        placeholder="Contoh: Terdapat selisih UP/GU/TU sebesar Rp234.840.000,00 yang merupakan sisa uang persediaan di bendahara pengeluaran dan akan disetorkan paling lambat ..."
                    ></textarea>
                </div>
            </div>

            <!-- TANDA TANGAN -->
            <div class="section-head">V. PENANDATANGANAN</div>
            <div class="row mt-3">
                <div class="col-6 sign-box">
                    <div class="fw-bold">PIHAK KEDUA</div>
                    <div>Pejabat Penatausahaan Keuangan (PPK-SKPD)</div>
                    <div class="sign-space"></div>
                    <input
                        type="text"
                        class="form-control form-control-sm text-center fw-bold mb-1"
                        name="ttd_nama_p2"
                        placeholder="[NAMA PEJABAT/PPK SKPD]"
                    />
                    <input
                        type="text"
                        class="form-control form-control-sm text-center"
                        name="ttd_nip_p2"
                        placeholder="NIP. ..."
                    />
                </div>
                <div class="col-6 sign-box">
                    <div class="fw-bold">PIHAK KESATU</div>
                    <div>Kepala Sub Bidang Penerimaan dan Belanja</div>
                    <div class="sign-space"></div>
                    <input
                        type="text"
                        class="form-control form-control-sm text-center fw-bold mb-1"
                        name="ttd_nama_p1"
                        value="Ichtiawan J. Aziz, S.E.I"
                    />
                    <input
                        type="text"
                        class="form-control form-control-sm text-center"
                        name="ttd_nip_p1"
                        value="NIP. 198506162020121006"
                    />
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-6 sign-box">
                    <div class="fw-bold">MENGETAHUI / MENYETUJUI:</div>
                    <div>Pengguna Anggaran</div>
                    <div class="sign-space"></div>
                    <input
                        type="text"
                        class="form-control form-control-sm text-center fw-bold mb-1"
                        name="ttd_nama_pa"
                        placeholder="[NAMA KEPALA SKPD]"
                    />
                    <input
                        type="text"
                        class="form-control form-control-sm text-center"
                        name="ttd_nip_pa"
                        placeholder="NIP. ..."
                    />
                </div>
                <div class="col-6 sign-box">
                    <div class="fw-bold">MENGETAHUI / MENYETUJUI:</div>
                    <div>Kepala Bidang Akuntansi</div>
                    <div class="sign-space"></div>
                    <input
                        type="text"
                        class="form-control form-control-sm text-center fw-bold mb-1"
                        name="ttd_nama_ka"
                        value="M. Adnan, S.E., M.Si."
                    />
                    <input
                        type="text"
                        class="form-control form-control-sm text-center"
                        name="ttd_nip_ka"
                        value="NIP. 197612262007011010"
                    />
                </div>
            </div>

            <div class="d-flex gap-2 mt-4 no-print">
                <button
                    type="button"
                    class="btn btn-primary btn-sm"
                    onclick="simpanJSON()"
                >
                    <i class="bi bi-download"></i> Simpan Data (JSON)
                </button>
                <button
                    type="button"
                    class="btn btn-outline-secondary btn-sm"
                    onclick="window.print()"
                >
                    <i class="bi bi-printer"></i> Cetak / PDF
                </button>
                <button type="reset" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset Form
                </button>
            </div>

            <div
                class="text-center mt-4"
                style="
                    font-size: 11px;
                    color: #777;
                    border-top: 1px solid var(--bar-line);
                    padding-top: 8px;
                "
            >
                BAR Penerimaan dan Pengeluaran
                <span id="lblTahunFooter">2026</span>
            </div>
        </form>
@endsection
