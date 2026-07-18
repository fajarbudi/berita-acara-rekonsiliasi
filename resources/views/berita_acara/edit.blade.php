@extends('layout.base_layout')

@section('content')
    <div class="page-head d-flex align-items-center gap-3 flex-wrap mb-4">
        <div>
            <h1>{{ $halaman_judul }}</h1>
            <p>{{ $halaman_deskripsi }}</p>
        </div>
        <div class="ms-auto d-flex gap-2">
            <a href="{{ route('berita_acara.view') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <form class="sheet" id="formBAR" method="POST" action="{{ route('berita_acara.simpan') }}">
        @csrf
        <input type="hidden" name="berita_acara_id" value="{{ $berita_acara_id }}" />
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
                <select class="form-select form-select-sm" id="periode" name="data[skpd_id]">
                    <option value="" selected>-- Pilih SKPD --</option>
                    @foreach ($ref_skpd as $skpd)
                        <option value="{{$skpd->skpd_id}}" {{$skpd->skpd_id == $data->skpd_id ? 'selected' : ''}}>{{$skpd->skpd_nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Nomor BAR (BUD)</label>
                <input type="text" class="form-control form-control-sm" name="data[berita_acara_no_bud]"
                    placeholder="900/____/BPKAD/2026" value="{{ $data->berita_acara_no_bud }}" />
            </div>
            <div class="col-md-3">
                <label class="form-label">Nomor BAR (SKPD)</label>
                <input type="text" class="form-control form-control-sm" name="data[berita_acara_no_skpd]"
                    placeholder="900/____/SKPD/2026" value="{{ $data->berita_acara_no_skpd }}" />
            </div>
            <div class="col-md-3">
                <label class="form-label">Periode Rekonsiliasi</label>
                <select class="form-select form-select-sm" id="periode" name="data[berita_acara_periode]">
                    <option value="" selected>-- Pilih Periode --</option>
                    <optgroup label="Bulanan">
                        <option {{ $data->berita_acara_periode === 'Januari' ? 'selected' : '' }}>Januari</option>
                        <option {{ $data->berita_acara_periode === 'Februari' ? 'selected' : '' }}>Februari</option>
                        <option {{ $data->berita_acara_periode === 'Maret' ? 'selected' : '' }}>Maret</option>
                        <option {{ $data->berita_acara_periode === 'April' ? 'selected' : '' }}>April</option>
                        <option {{ $data->berita_acara_periode === 'Mei' ? 'selected' : '' }}>Mei</option>
                        <option {{ $data->berita_acara_periode === 'Juni' ? 'selected' : '' }}>Juni</option>
                        <option {{ $data->berita_acara_periode === 'Juli' ? 'selected' : '' }}>Juli</option>
                        <option {{ $data->berita_acara_periode === 'Agustus' ? 'selected' : '' }}>Agustus</option>
                        <option {{ $data->berita_acara_periode === 'September' ? 'selected' : '' }}>September</option>
                        <option {{ $data->berita_acara_periode === 'Oktober' ? 'selected' : '' }}>Oktober</option>
                        <option {{ $data->berita_acara_periode === 'November' ? 'selected' : '' }}>November</option>
                        <option {{ $data->berita_acara_periode === 'Desember' ? 'selected' : '' }}>Desember</option>
                    </optgroup>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tahun Anggaran</label>
                <input type="number" class="form-control form-control-sm" id="tahun"
                    name="data[berita_acara_tahun_anggaran]" value="{{ $data->berita_acara_tahun_anggaran ?? 2026 }}"
                    min="2020" max="2100" />
            </div>

            <div class="col-md-3">
                <label class="form-label">Hari</label>
                <select class="form-select form-select-sm" name="data[berita_acara_hari]"
                    value="{{ $data->berita_acara_hari }}">
                    <option value="">-- Pilih Hari --</option>
                    <option {{ $data->berita_acara_hari === 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option {{ $data->berita_acara_hari === 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option {{ $data->berita_acara_hari === 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option {{ $data->berita_acara_hari === 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option {{ $data->berita_acara_hari === 'Jumat' ? 'selected' : '' }}>Jumat</option>
                    <option {{ $data->berita_acara_hari === 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tanggal Berita Acara</label>
                <input type="date" class="form-control form-control-sm" name="data[berita_acara_tanggal]"
                    value="{{ $data->berita_acara_tanggal }}" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Tempat</label>
                <input type="text" class="form-control form-control-sm" name="data[berita_acara_tempat]"
                    value="{{ $data->berita_acara_tempat ?? 'Kantor Badan Pengelolaan Keuangan dan Aset Daerah' }}" />
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
                @foreach ($data_pendapatan as $index => $pendapatan)
                    <tr>
                        <td class="text-center no">{{ $index + 1 }}</td>
                        <td>
                            <select class="cell-text" name="rekening[{{ $index }}][rekening_id]">
                                <option selected>--Pilih Rekening--</option>
                                @foreach ($rekenings as $rekening)
                                    <option value="{{ $rekening->rekening_id }}"
                                        {{ $pendapatan->rekening_id == $rekening->rekening_id ? 'selected' : '' }}>
                                        {{ $rekening->rekening_kode }}
                                    </option>
                                @endforeach
                            </select>

                        <td>
                            <input class="cell-text" name="rekening[{{ $index }}][rekening_uraian]"
                                value="{{ $pendapatan->rekening_uraian }}" />
                        </td>
                        <td>
                            <input class="cell-input skpd" type="text" inputmode="numeric"
                                name="rekening[{{ $index }}][skpd]"
                                value="{{ number_format($pendapatan->skpd, 0, ',', '') }}" />
                        </td>
                        <td>
                            <input class="cell-input bud" type="text" inputmode="numeric"
                                name="rekening[{{ $index }}][bud]"
                                value="{{ number_format($pendapatan->bud, 0, ',', '') }}" />
                        </td>
                        <td>
                            <input class="cell-input num selisih" type="text"
                                name="rekening[{{ $index }}][selisih]"
                                value="{{ number_format($pendapatan->selisih, 0, ',', '') }}" />
                        </td>
                        <td class="text-center ket"></td>
                        <td class="text-center row-tools no-print">
                            <button type="button" onclick="hapusBaris(this)">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach

                @if (!$data_pendapatan || $data_pendapatan->isEmpty())
                    <tr>
                        <td class="text-center no">1</td>
                        <td>
                            <select class="cell-text" name="rekening[0][rekening_id]">
                                <option selected>--Pilih Rekening--</option>
                                @foreach ($rekenings as $rekening)
                                    <option value="{{ $rekening->rekening_id }}">{{ $rekening->rekening_kode }}</option>
                                @endforeach
                            </select>

                        <td>
                            <input class="cell-text" name="rekening[0][rekening_uraian]" />
                        </td>
                        <td>
                            <input class="cell-input skpd" type="text" inputmode="numeric"
                                name="rekening[0][skpd]" />
                        </td>
                        <td>
                            <input class="cell-input bud" type="text" inputmode="numeric" name="rekening[0][bud]" />
                        </td>
                        <td>
                            <input class="cell-input num selisih" type="text" name="rekening[0][selisih]" />
                        </td>
                        <td class="text-center ket">
                        </td>
                        <td class="text-center row-tools no-print">
                            <button type="button" onclick="hapusBaris(this)">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </td>
                    </tr>
                @endif
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
            onclick="tambahBaris('tblPendapatan')">
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
                @foreach ($data_belanja as $index => $belanja)
                    <tr>
                        <td class="text-center no">1</td>
                        <td>
                            <select class="cell-text" name="belanja[{{ $index }}][belanja_id]">
                                <option selected>Belanja Operasi</option>
                                @foreach ($ref_belanja as $belanjaOption)
                                    <option value="{{ $belanjaOption->belanja_id }}"
                                        {{ $belanja->belanja_id == $belanjaOption->belanja_id ? 'selected' : '' }}>
                                        {{ $belanjaOption->belanja_nama }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="cell-text" value="{{ $belanja->belanja_uraian }}"
                                name="belanja[{{ $index }}][belanja_uraian]" />
                        </td>
                        <td>
                            <input class="cell-input skpd" type="text" inputmode="numeric"
                                value="{{ $belanja->skpd }}" name="belanja[{{ $index }}][skpd]" />
                        </td>
                        <td>
                            <input class="cell-input bud" type="text" inputmode="numeric"
                                value="{{ $belanja->bud }}" name="belanja[{{ $index }}][bud]" />
                        </td>
                        <td class="num selisih"><input class="cell-input num selisih" type="text"
                                name="belanja[{{ $index }}][selisih]" value="{{ $belanja->selisih }}" /></td>
                        <td class="text-center ket"></td>
                        <td class="text-center row-tools no-print">
                            <button type="button" onclick="hapusBaris(this)">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach

                @if (!$data_belanja || $data_belanja->isEmpty())
                    <tr>
                        <td class="text-center no">1</td>
                        <td>
                            <select class="cell-text" name="belanja[0][belanja_id]">
                                <option selected>--Pilih Belanja--</option>
                                @foreach ($ref_belanja as $belanja)
                                    <option value="{{ $belanja->belanja_id }}">{{ $belanja->belanja_nama }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <input class="cell-text" name="belanja[0][belanja_uraian]" />
                        </td>
                        <td>
                            <input class="cell-input skpd" type="text" inputmode="numeric" name="belanja[0][skpd]" />
                        </td>
                        <td>
                            <input class="cell-input bud" type="text" inputmode="numeric" name="belanja[0][bud]" />
                        </td>
                        <td>
                            <input class="cell-input num selisih" type="text" name="belanja[0][selisih]" />
                        </td>
                        <td class="text-center ket">
                        </td>
                        <td class="text-center row-tools no-print">
                            <button type="button" onclick="hapusBaris(this)">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </td>
                    </tr>
                @endif
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
                        <td>
                            Mekanisme SP2D-LS
                        </td>
                        <td>
                            <input
                                class="cell-text"
                                value="Langsung ke Pihak Ketiga / Gaji"
                                readonly
                            />
                        </td>
                        <td>
                            <input
                                name="data[berita_acara_sp2dLS_skpd]"
                                class="cell-input skpd"
                                type="text"
                                inputmode="numeric"
                                placeholder="14107456768"
                                value="{{$data->berita_acara_sp2dLS_skpd}}"
                            />
                        </td>
                        <td>
                            <input
                                name="data[berita_acara_sp2dLS_bud]"
                                class="cell-input bud"
                                type="text"
                                inputmode="numeric"
                                placeholder="14107456768"
                                value="{{$data->berita_acara_sp2dLS_bud}}"
                            />
                        </td>
                        <td class="num selisih">                    {{$data->berita_acara_sp2dLS_selisih}}
                        </td>
                        <td class="text-center ket">{{$data->berita_acara_sp2dLS_ket}}</td>
                    </tr>
                    <tr>
                        <td class="text-center no">2</td>
                        <td>
                            Mekanisme SP2D-UP/GU/TU
                        </td>
                        <td>
                            <input
                                class="cell-text"
                                value="Uang Persediaan / Ganti Uang"
                                readonly
                            />
                        </td>
                        <td>
                            <input
                                name="data[berita_acara_sp2dUP_skpd]"
                                class="cell-input skpd"
                                type="text"
                                inputmode="numeric"
                                placeholder="1372444318"
                                value="{{$data->berita_acara_sp2dUP_skpd}}"
                            />
                        </td>
                        <td>
                            <input
                                name="data[berita_acara_sp2dUP_bud]"
                                class="cell-input bud"
                                type="text"
                                inputmode="numeric"
                                placeholder="1607284318"
                                value="{{$data->berita_acara_sp2dUP_bud}}"
                            />
                        </td>
                        <td class="num selisih">{{$data->berita_acara_sp2dUP_selisih}}</td>
                        <td class="text-center ket">{{$data->berita_acara_sp2dUP_keterangan}}</td>
                    </tr>
                    <tr>
                        <td class="text-center no">3</td>
                        <td>
                            STS
                        </td>
                        <td>
                            <input
                                name="data[berita_acara_sts_uraian]"
                                class="cell-text"
                                value="Pengembalian ke Kasda (-)"
                                readonly
                            />
                        </td>
                        <td>
                            <input
                                name="data[berita_acara_sts_skpd]"
                                class="cell-input skpd"
                                type="text"
                                inputmode="numeric"
                                placeholder="-4479062"
                                value="{{$data->berita_acara_sts_skpd}}"
                                onkeyup="ubahKeMinus(this)"
                            />
                        </td>
                        <td>
                            <input
                                name="data[berita_acara_sts_bud]"
                                class="cell-input bud"
                                type="text"
                                inputmode="numeric"
                                placeholder="-4479062"
                                value="{{$data->berita_acara_sts_bud}}"
                                onkeyup="ubahKeMinus(this)"
                               
                            />
                        </td>
                        <td class="num selisih">{{$data->berita_acara_sts_selisih}}</td>
                        <td class="text-center ket">{{$data->berita_acara_sts_keterangan}}</td>
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
                        <input class="cell-input saldo" type="text" inputmode="numeric" placeholder="234840000" name="data[berita_acara_saldo_awal_bulan]" value="{{$data->berita_acara_saldo_awal_bulan}}"/>
                    </td>
                    <td>Kas Awal Bulan</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Penerimaan SP2D (UP/GU/TU) Periode Ini</td>
                    <td>
                        <input class="cell-input saldo" type="text" inputmode="numeric" name="data[berita_acara_penerimaan_sp2d]" value="{{$data->berita_acara_penerimaan_sp2d}}"/>
                    </td>
                    <td>Pencairan UP/GU/TU</td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>Pengeluaran BKU (SPJ Belanja UP/GU/TU)</td>
                    <td>
                        <input class="cell-input saldo" type="text" inputmode="numeric" name="data[berita_acara_pengeluaran_bku]" value="{{$data->berita_acara_pengeluaran_bku}}"/>
                    </td>
                    <td>Realisasi UP/GU/TU</td>
                </tr>
                <tr>
                    <td class="text-center">4</td>
                    <td>Pengembalian Sisa UP/GU/TU (STS/S3UP)</td>
                    <td>
                        <input class="cell-input saldo" type="text" inputmode="numeric" name="data[berita_acara_pengembalian]" value="{{$data->berita_acara_pengembalian}}"/>
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
                <textarea class="form-control form-control-sm" name="data[berita_acara_kesimpulan]" rows="5"
                    placeholder="Contoh: Terdapat selisih UP/GU/TU sebesar Rp234.840.000,00 yang merupakan sisa uang persediaan di bendahara pengeluaran dan akan disetorkan paling lambat ..."></textarea>
            </div>
        </div>

        <!-- TANDA TANGAN -->
        <div class="section-head">V. PENANDATANGANAN</div>
        <div class="row mt-3">
            <div class="col-6 sign-box">
                <div class="fw-bold">PIHAK KEDUA</div>
                <div>Pejabat Penatausahaan Keuangan (PPK-SKPD)</div>
                <div class="sign-space"></div>
                <input type="text" class="form-control form-control-sm text-center fw-bold mb-1" name="ttd_nama_p2"
                    placeholder="[NAMA PEJABAT/PPK SKPD]" value="{{$data->berita_acara_nama_ppk}}" readonly/>
                <input type="text" class="form-control form-control-sm text-center" name="ttd_nip_p2"
                    placeholder="NIP. ..." 
                    value="NIP. {{$data->berita_acara_nip_ppk}}" readonly/>
            </div>
            <div class="col-6 sign-box">
                <div class="fw-bold">PIHAK KESATU</div>
                <div>Kepala Sub Bidang Penerimaan dan Belanja</div>
                <div class="sign-space"></div>
                <input type="text" class="form-control form-control-sm text-center fw-bold mb-1" name="ttd_nama_p1"
                    value="Ichtiawan J. Aziz, S.E.I" readonly/>
                <input type="text" class="form-control form-control-sm text-center" name="ttd_nip_p1"
                    value="NIP. 198506162020121006" readonly/>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-6 sign-box">
                <div class="fw-bold">MENGETAHUI / MENYETUJUI:</div>
                <div>Pengguna Anggaran</div>
                <div class="sign-space"></div>
                <input type="text" class="form-control form-control-sm text-center fw-bold mb-1" name="ttd_nama_pa"
                    placeholder="[NAMA KEPALA SKPD]" value="{{$data->berita_acara_nama_pa}}" readonly/>
                <input type="text" class="form-control form-control-sm text-center" name="ttd_nip_pa"
                    placeholder="NIP. ..." value="NIP. {{$data->berita_acara_nip_pa}}" readonly/>
            </div>
            <div class="col-6 sign-box">
                <div class="fw-bold">MENGETAHUI / MENYETUJUI:</div>
                <div>Kepala Bidang Akuntansi</div>
                <div class="sign-space"></div>
                <input type="text" class="form-control form-control-sm text-center fw-bold mb-1" name="ttd_nama_ka"
                    value="M. Adnan, S.E., M.Si." />
                <input type="text" class="form-control form-control-sm text-center" name="ttd_nip_ka"
                    value="NIP. 197612262007011010" />
            </div>
        </div>

        <div class="d-flex gap-2 mt-4 no-print justify-content-end mt-5">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-download"></i> Simpan Data
            </button>
            <button type="reset" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-arrow-counterclockwise"></i> Reset Form
            </button>
        </div>

        <div class="text-center mt-4"
            style="
                    font-size: 11px;
                    color: #777;
                    border-top: 1px solid var(--bar-line);
                    padding-top: 8px;
                ">
            BAR Penerimaan dan Pengeluaran
            <span id="lblTahunFooter">2026</span>
        </div>
    </form>
@endsection

@push('script')
    <script>
        const ubahKeMinus = (element) =>{
            let nilai = parseFloat(element.value)

            if(nilai > 0){
                element.value = -nilai
            }

            if(nilai == 0 ){
                element.value = 0
            }
        }

        const fmt = (n) =>
            (n < 0 ? "-" : "") +
            Math.abs(n).toLocaleString("id-ID", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
        const parse = (v) => {
            const n = parseFloat(String(v).replace(/[^\d.-]/g, ""));
            return isNaN(n) ? 0 : n;
        };

        function setSel(td, val) {
            td.textContent = fmt(val);
            td.classList.toggle("neg", val < 0);
        }

        function badge(
            cocok,
            textCocok = "Cocok",
            textTidak = "Tidak Cocok",
        ) {
            return `<span class="badge-st ${cocok ? "badge-cocok" : "badge-tidak"}">${cocok ? textCocok : textTidak}</span>`;
        }

        function hitungTabel(id, pfx) {
            const tb = document.querySelector("#" + id + " tbody");
            let ts = 0,
                tb2 = 0;
            [...tb.rows].forEach((r, i) => {
                const no = r.querySelector(".no");
                if (no) no.textContent = i + 1;
                const s = parse(r.querySelector(".skpd").value);
                const b = parse(r.querySelector(".bud").value);
                const d = b - s;
                ts += s;
                tb2 += b;
                // setSel(r.querySelector(".selisih"), d);
                r.querySelector(".selisih").value = d;
                r.querySelector(".ket").innerHTML = badge(d === 0);
                // r.querySelector(".ketInput")?.value = d === 0 ? "Cocok" : "Tidak Cocok";
            });
            document.getElementById(pfx + "SKPD").textContent = fmt(ts);
            document.getElementById(pfx + "BUD").textContent = fmt(tb2);
            setSel(document.getElementById(pfx + "Selisih"), tb2 - ts);
            document.getElementById(pfx + "Ket").innerHTML = badge(
                tb2 - ts === 0,
                "Sesuai",
                "Tidak Sesuai",
            );
            return {
                ts,
                tb: tb2
            };
        }

        function hitungSemua() {
            hitungTabel("tblPendapatan", "totPend");
            const j = hitungTabel("tblJenis", "totJenis");
            const m = hitungTabel("tblMekanisme", "totMek");

            // Selisih potensi sisa UP/GU/TU = mekanisme - jenis
            const gS = m.ts - j.ts,
                gB = m.tb - j.tb;
            setSel(document.getElementById("gapSKPD"), gS);
            setSel(document.getElementById("gapBUD"), gB);
            setSel(document.getElementById("gapSelisih"), gB - gS);
            document.getElementById("gapKet").innerHTML =
                gB - gS === 0 ?
                badge(true, "Sesuai") :
                `<span class="badge-st badge-tidak">Potensi</span>`;

            // Saldo kas
            let sa = 0;
            document
                .querySelectorAll("#tblSaldo .saldo")
                .forEach((i) => (sa += parse(i.value)));
            setSel(document.getElementById("saldoAkhir"), sa);
            document.getElementById("saldoKet").innerHTML =
                Math.abs(sa - (gB - gS)) < 0.01 ?
                badge(true, "Sesuai") :
                badge(false, "Periksa Kembali");

            // Header dinamis
            const p = document.getElementById("periode").value;
            const t = document.getElementById("tahun").value;
            document.getElementById("lblPeriode").textContent =
                p || "[BULAN/TRIWULAN]";
            document.getElementById("lblTahun").textContent =
                t || "[TAHUN]";
            document.getElementById("lblTahunFooter").textContent =
                t || "2026";
        }

        function tambahBaris(id, indexPrefix = "rekening") {
            const tb = document.querySelector("#" + id + " tbody");

            // 1. Hitung jumlah baris yang sudah ada untuk menentukan indeks baru
            const newIndex = tb.rows.length;

            // 2. Clone baris terakhir
            const nr = tb.rows[tb.rows.length - 1].cloneNode(true);

            // 3. Update nomor urut di kolom pertama (jika ada class 'no')
            const noCell = nr.querySelector(".no");
            if (noCell) {
                noCell.textContent = newIndex + 1;
            }

            // 4. Loop semua input di baris baru untuk reset value & update indeks name
            nr.querySelectorAll("input, select").forEach((i) => {
                // Reset value
                i.value = i.classList.contains("cell-input") ? "0" : "";

                // Update atribut name menggunakan regex untuk mengganti angka di dalam [x] pertama
                const currentName = i.getAttribute("name");
                if (currentName) {
                    // Regex ini mencari pola [angka] pertama dan menggantinya dengan [index_baru]
                    const newName = currentName.replace(new RegExp(`${indexPrefix}\\[\\d+\\]`),
                        `${indexPrefix}[${newIndex}]`);
                    i.setAttribute("name", newName);
                }
            });

            // 5. Tambahkan baris baru ke dalam tabel
            tb.appendChild(nr);

            // 6. Jalankan kembali fungsi kalkulasi dan binding kamu
            if (typeof bindAll === "function") bindAll();
            if (typeof hitungSemua === "function") hitungSemua();
        }

        function hapusBaris(btn) {
            const tb = btn.closest("tbody");
            if (tb.rows.length <= 1) {
                alert("Minimal satu baris harus tersisa.");
                return;
            }
            btn.closest("tr").remove();
            hitungSemua();
        }

        function bindAll() {
            document
                .querySelectorAll(".cell-input,.cell-text,#periode,#tahun")
                .forEach((el) => {
                    el.oninput = hitungSemua;
                    el.onchange = hitungSemua;
                });
        }

        function ambil(id) {
            return [
                ...document.querySelectorAll("#" + id + " tbody tr"),
            ].map((r) => {
                const c = [...r.querySelectorAll(".cell-text")].map(
                    (i) => i.value,
                );
                return {
                    kolom1: c[0] || "",
                    uraian: c[1] || "",
                    skpd: parse(r.querySelector(".skpd").value),
                    bud: parse(r.querySelector(".bud").value),
                };
            });
        }

        bindAll();
        hitungSemua();
    </script>
@endpush
