<?php

namespace App\Http\Controllers;

use App\Exports\BeritaAcara as ExportsBeritaAcara;
use App\Models\berita_acara;
use App\Models\berita_acara_belanja;
use App\Models\berita_acara_mekanisme;
use App\Models\berita_acara_pendapatan;
use App\Models\berita_acara_saldo_kas;
use App\Models\ref_belanja;
use App\Models\ref_mekanisme;
use App\Models\ref_rekening;
use App\Models\ref_skpd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BeritaAcara extends Controller
{
    public function view()
    {
        $load['halaman_judul'] = "Berita Acara";
        $load['halaman_deskripsi'] = "Data berita acara yang dapat digunakan dalam aplikasi ini";
        $load['datas'] = berita_acara::orderBy('created_at', 'desc')->get();
        return view('berita_acara.berita_acara',  $load);
    }

    public function detail($id)
    {
        $data = berita_acara::findOrFail($id);

        $load['halaman_judul'] = "Detail Berita Acara";
        $load['halaman_deskripsi'] = "Detail berita acara";
        $load['berita_acara_id'] = $id;
        $load['data'] = $data;
        $load['data_pendapatan'] = berita_acara_pendapatan::where('berita_acara_id', $id)->get();
        $load['data_belanja'] = berita_acara_belanja::where('berita_acara_id', $id)->get();
        $load['data_mekanisme'] = berita_acara_mekanisme::where('berita_acara_id', $id)->get();
        // $load['data_saldo'] = berita_acara_saldo_kas::where('berita_acara_id', $id)
        //     ->orderBy('urutan')
        //     ->get();

        // Dipakai paragraf pembuka: "Pada hari ini, Jumat tanggal Lima bulan Juni ..."
        $load['terbilang'] = $this->terbilangTanggal($data->berita_acara_tanggal);

        return view('berita_acara.detail',  $load);
    }

    public function new()
    {
        $load['halaman_judul'] = "Berita Acara Baru";
        $load['halaman_deskripsi'] = "Form untuk membuat berita acara baru";
        $load['rekenings'] = ref_rekening::orderBy('rekening_kode', 'asc')->get();
        $load['ref_belanja'] = ref_belanja::orderBy('belanja_nama', 'asc')->get();
        $load['ref_mekanisme'] = ref_mekanisme::orderBy('mekanisme_nama', 'asc')->get();
        $load['ref_skpd'] = ref_skpd::get();

        return view('berita_acara.new',  $load);
    }

    public function edit($id)
    {
        $load['halaman_judul'] = "Edit Berita Acara";
        $load['halaman_deskripsi'] = "Form untuk mengedit berita acara";
        $load['berita_acara_id'] = $id;
        $load['data'] = berita_acara::findOrFail($id);
        $load['rekenings'] = ref_rekening::orderBy('rekening_kode', 'asc')->get();
        $load['ref_belanja'] = ref_belanja::orderBy('belanja_nama', 'asc')->get();
        $load['data_pendapatan'] = berita_acara_pendapatan::where('berita_acara_id', $id)->get();
        $load['data_belanja'] = berita_acara_belanja::where('berita_acara_id', $id)->get();
        $load['ref_mekanisme'] = ref_mekanisme::orderBy('mekanisme_nama', 'asc')->get();
        $load['data_mekanisme'] = berita_acara_mekanisme::where('berita_acara_id', $id)->get();
        $load['ref_skpd'] = ref_skpd::get();
        // $load['data_saldo'] = berita_acara_saldo_kas::where('berita_acara_id', $id)
        //     ->orderBy('urutan')
        //     ->get();

        return view('berita_acara.edit',  $load);
    }

    public function simpan(Request $request)
    {
        $berita_acara_id = $request->input('berita_acara_id');
        $datas = $request->input('data');
        $rekening = $request->input('rekening');
        $belanja = $request->input('belanja');
        $mekanisme = $request->input('mekanisme');
        $skpd = ref_skpd::findOrFail($datas['skpd_id'] ?? '');

        $dataPost = [];
        foreach ($datas as $key => $value) {
            if ($value) {
                $dataPost[$key] = $value;
            }
        }
        $dataPost['berita_acara_nama_ppk'] = $skpd->skpd_nama_ppk;
        $dataPost['berita_acara_nip_ppk'] = $skpd->skpd_nip_ppk;
        $dataPost['berita_acara_nama_pa'] = $skpd->skpd_nama_pa;
        $dataPost['berita_acara_nip_pa'] = $skpd->skpd_nip_pa;

        // Seluruh penyimpanan dibungkus transaksi. Bila salah satu rincian
        // gagal, header tidak ikut tersimpan setengah jalan.
        DB::beginTransaction();

        try {
            if (!$berita_acara_id) {
                $berita_acara = berita_acara::create($dataPost);
                $berita_acara_id = $berita_acara->berita_acara_id;
            } else {
                $data = berita_acara::find($berita_acara_id);

                if (!$data) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Berita Acara tidak ditemukan.');
                }

                $data->update($dataPost);
                $berita_acara = $data;
            }

            $this->simpanPendapatan($berita_acara_id, $rekening);
            $this->simpanBelanja($berita_acara_id, $belanja);
            $this->simpanMekanisme($berita_acara_id, $mekanisme);
            // $this->simpanSaldoKas($berita_acara_id, $saldo);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }

        return redirect()->route('berita_acara.detail', $berita_acara_id)
            ->with('success', 'Berita Acara berhasil disimpan.');
    }

    // Simpan Pendapatan
    private function simpanPendapatan($berita_acara_id, $rekening)
    {
        berita_acara_pendapatan::where('berita_acara_id', $berita_acara_id)->delete();

        if (!is_array($rekening)) {
            return;
        }

        // Ambil seluruh kode rekening sekali jalan, bukan query di dalam perulangan
        $kodeRekening = ref_rekening::whereIn('rekening_id', array_column($rekening, 'rekening_id'))
            ->pluck('rekening_kode', 'rekening_id');

        $post = [];
        foreach ($rekening as $urutan => $item) {
            if (empty($item['rekening_uraian'])) {
                continue;
            }

            $skpd = $this->angka($item['skpd'] ?? 0);
            $bud  = $this->angka($item['bud'] ?? 0);

            // Penerimaan memakai rumus SKPD dikurangi BUD
            $selisih = $skpd - $bud;

            $post[] = [
                'berita_acara_id' => $berita_acara_id,
                'rekening_id'     => $item['rekening_id'],
                'rekening_kode'   => $kodeRekening[$item['rekening_id']] ?? null,
                'rekening_uraian' => $item['rekening_uraian'],
                'skpd'            => $skpd,
                'bud'             => $bud,
                'selisih'         => $selisih,
                'keterangan'      => $this->cocok($selisih),
            ];
        }

        if ($post) {
            berita_acara_pendapatan::insert($post);
        }
    }

    //Simpan Belanja
    private function simpanBelanja($berita_acara_id, $belanja)
    {
        berita_acara_belanja::where('berita_acara_id', $berita_acara_id)->delete();

        if (!is_array($belanja)) {
            return;
        }

        $namaBelanja = ref_belanja::whereIn('belanja_id', array_column($belanja, 'belanja_id'))
            ->pluck('belanja_nama', 'belanja_id');

        $post = [];
        foreach ($belanja as $urutan => $item) {
            if (empty($item['belanja_uraian'])) {
                continue;
            }

            $skpd = $this->angka($item['skpd'] ?? 0);
            $bud  = $this->angka($item['bud'] ?? 0);

            // Belanja memakai rumus BUD dikurangi SKPD, kebalikan dari penerimaan
            $selisih = $bud - $skpd;

            $post[] = [
                'berita_acara_id' => $berita_acara_id,
                'belanja_id'      => $item['belanja_id'],
                'belanja_nama'    => $namaBelanja[$item['belanja_id']] ?? null,
                'belanja_uraian'  => $item['belanja_uraian'],
                'skpd'            => $skpd,
                'bud'             => $bud,
                'selisih'         => $selisih,
                'keterangan'      => $this->cocok($selisih),
            ];
        }

        if ($post) {
            berita_acara_belanja::insert($post);
        }
    }

    // Simpan Mekanisme
    private function simpanMekanisme($berita_acara_id, $mekanisme)
    {
        berita_acara_mekanisme::where('berita_acara_id', $berita_acara_id)->delete();

        if (!is_array($mekanisme)) {
            return;
        }

        $namaMekanisme = ref_mekanisme::whereIn('mekanisme_id', array_column($mekanisme, 'mekanisme_id'))
            ->pluck('mekanisme_nama', 'mekanisme_id');

        $post = [];
        foreach ($mekanisme as $urutan => $item) {
            if (empty($item['mekanisme_uraian'])) {
                continue;
            }

            $skpd = $this->angka($item['skpd'] ?? 0);
            $bud  = $this->angka($item['bud'] ?? 0);
            $selisih = $bud - $skpd;

            $post[] = [
                'berita_acara_id'  => $berita_acara_id,
                'mekanisme_id'     => $item['mekanisme_id'],
                'mekanisme_nama'   => $namaMekanisme[$item['mekanisme_id']] ?? null,
                'mekanisme_uraian' => $item['mekanisme_uraian'],
                'skpd'             => $skpd,
                'bud'              => $bud,
                'selisih'          => $selisih,
                'keterangan'       => $this->cocok($selisih),
            ];
        }

        if ($post) {
            berita_acara_mekanisme::insert($post);
        }
    }

    // private function simpanSaldoKas($berita_acara_id, $saldo)
    // {
    //     berita_acara_saldo_kas::where('berita_acara_id', $berita_acara_id)->delete();

    //     if (!is_array($saldo)) {
    //         return;
    //     }

    //     $post = [];
    //     foreach ($saldo as $urutan => $item) {
    //         if (empty($item['uraian'])) {
    //             continue;
    //         }

    //         $post[] = [
    //             'berita_acara_id' => $berita_acara_id,
    //             'urutan'          => $urutan + 1,
    //             'uraian'          => $item['uraian'],
    //             'jumlah'          => $this->angka($item['jumlah'] ?? 0),
    //             'keterangan'      => $item['keterangan'] ?? null,
    //             'created_at'      => now(),
    //             'updated_at'      => now(),
    //         ];
    //     }

    //     if ($post) {
    //         berita_acara_saldo_kas::insert($post);
    //     }
    // }

    //hapus berita acara
    public function hapus($id)
    {
        $data = berita_acara::find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Berita Acara tidak ditemukan.');
        }

        DB::beginTransaction();

        try {
            berita_acara_pendapatan::where('berita_acara_id', $id)->delete();
            berita_acara_belanja::where('berita_acara_id', $id)->delete();
            berita_acara_mekanisme::where('berita_acara_id', $id)->delete();
            // berita_acara_saldo_kas::where('berita_acara_id', $id)->delete();
            $data->delete();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }

        return redirect()->route('berita_acara.view')->with('success', 'Berita Acara berhasil dihapus.');
    }

    public function excel($id)
    {
        $export = new ExportsBeritaAcara($id);
        return Excel::download($export, $export->namaBerkas());
    }


    
    private function angka($nilai): float
    {
        if (is_numeric($nilai)) {
            return (float) $nilai;
        }

        $bersih = str_replace(['.', ' '], '', (string) $nilai);
        $bersih = str_replace(',', '.', $bersih);

        return (float) $bersih;
    }


    //menentukan selisih skpd dan bud
    private function cocok(float $selisih): string
    {
        return abs($selisih) < 0.001 ? 'Cocok' : 'Tidak Cocok';
    }

    private const HARI = [
        'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
    ];

    private const BULAN = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];

    private const ANGKA = [
        1 => 'Satu', 2 => 'Dua', 3 => 'Tiga', 4 => 'Empat', 5 => 'Lima',
        6 => 'Enam', 7 => 'Tujuh', 8 => 'Delapan', 9 => 'Sembilan', 10 => 'Sepuluh',
        11 => 'Sebelas', 12 => 'Dua Belas', 13 => 'Tiga Belas', 14 => 'Empat Belas',
        15 => 'Lima Belas', 16 => 'Enam Belas', 17 => 'Tujuh Belas', 18 => 'Delapan Belas',
        19 => 'Sembilan Belas', 20 => 'Dua Puluh', 21 => 'Dua Puluh Satu',
        22 => 'Dua Puluh Dua', 23 => 'Dua Puluh Tiga', 24 => 'Dua Puluh Empat',
        25 => 'Dua Puluh Lima', 26 => 'Dua Puluh Enam', 27 => 'Dua Puluh Tujuh',
        28 => 'Dua Puluh Delapan', 29 => 'Dua Puluh Sembilan', 30 => 'Tiga Puluh',
        31 => 'Tiga Puluh Satu',
    ];


    // fungsi terbilang tanggal
    private function terbilangTanggal($tanggal): array
    {
        if (!$tanggal) {
            return [
                'hari' => '[Nama Hari]',
                'tanggal' => '[Tanggal]',
                'bulan' => '[Bulan]',
                'tahun' => '[Tahun]',
            ];
        }

        $tgl = \Carbon\Carbon::parse($tanggal);
        $thn = $tgl->year;

        // 2026 menjadi "Dua Ribu Dua Puluh Enam"
        $ribuan  = intdiv($thn, 1000);
        $sisa    = $thn % 1000;
        $terbilangTahun = (self::ANGKA[$ribuan] ?? $ribuan) . ' Ribu';

        if ($sisa > 0) {
            $puluhan = $sisa % 100;
            $terbilangTahun .= ' ' . (self::ANGKA[$puluhan] ?? $puluhan);
        }

        return [
            'hari'    => self::HARI[$tgl->format('l')] ?? '',
            'tanggal' => self::ANGKA[$tgl->day] ?? $tgl->day,
            'bulan'   => self::BULAN[$tgl->month],
            'tahun'   => $terbilangTahun,
        ];
    }
}