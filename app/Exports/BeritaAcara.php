<?php

namespace App\Exports;

use App\Models\berita_acara;
use App\Models\berita_acara_belanja;
use App\Models\berita_acara_mekanisme;
use App\Models\berita_acara_pendapatan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

/**
 * Export Berita Acara Rekonsiliasi ke Excel.
 *
 * Isi lembar dibangun dari Blade berita_acara.excel, sedangkan
 * pengaturan halaman diterapkan lewat AfterSheet — hal yang tidak
 * bisa diatur dari HTML.
 *
 * Pemakaian di controller:
 *   $export = new BeritaAcara($id);
 *   return Excel::download($export, $export->namaBerkas());
 */
class BeritaAcara implements FromView, WithTitle, WithEvents, WithColumnWidths
{
    /** @var int */
    protected $id;

    /** @var \App\Models\berita_acara|null */
    protected $data;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function title(): string
    {
        return 'BAR Penerimaan & Pengeluaran';
    }

    /** Lebar kolom persis dari berkas asli */
    public function columnWidths(): array
    {
        return [
            'A' => 5.0,
            'B' => 13.453125,
            'C' => 24.0,
            'D' => 17.0,
            'E' => 17.0,
            'F' => 14.453125,
            'G' => 11.54296875,
        ];
    }

    public function view(): View
    {
        return view('berita_acara.export.cetak', [
            'data'            => $this->data(),
            'data_pendapatan' => berita_acara_pendapatan::where('berita_acara_id', $this->id)->get(),
            'data_belanja'    => berita_acara_belanja::where('berita_acara_id', $this->id)->get(),
            'data_mekanisme'  => berita_acara_mekanisme::where('berita_acara_id', $this->id)->get(),
            'terbilang'       => $this->terbilangTanggal($this->data()->berita_acara_tanggal ?? null),
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->getPageSetup()
                    ->setOrientation(PageSetup::ORIENTATION_PORTRAIT)
                    ->setPaperSize(PageSetup::PAPERSIZE_A4)
                    ->setFitToWidth(1)
                    ->setFitToHeight(0);

                $sheet->getPageMargins()
                    ->setTop(0.5)->setBottom(0.5)->setLeft(0.5)->setRight(0.5);

                $sheet->getHeaderFooter()->setOddFooter(
                    '&LBAR Penerimaan dan Pengeluaran '
                    . $this->data()->berita_acara_tahun_anggaran
                    . '&RHalaman &P dari &N'
                );

                // Judul diulang di setiap halaman cetak
                $sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 3);
                $sheet->setSelectedCell('A1');
            },
        ];
    }

    /** Nama berkas unduhan */
    public function namaBerkas(): string
    {
        $d     = $this->data();
        $nomor = str_replace('/', '-', $d->berita_acara_no_bud ?: 'DRAFT');

        return 'BAR_' . $nomor
            . '_' . $d->berita_acara_periode
            . '_' . $d->berita_acara_tahun_anggaran
            . '.xlsx';
    }

    /** Header dibaca beberapa kali, jadi hasilnya disimpan */
    protected function data()
    {
        if ($this->data === null) {
            $this->data = berita_acara::findOrFail($this->id);
        }

        return $this->data;
    }

    /* ==================================================================
     |  TERBILANG
     * ================================================================== */

    protected static $HARI = [
        'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
    ];

    protected static $BULAN = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];

    protected static $ANGKA = [
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

    /**
     * Menghasilkan komponen terbilang untuk paragraf pembuka.
     * Contoh: hari Jumat, tanggal Lima, bulan Juni, tahun Dua Ribu Dua Puluh Enam
     */
    protected function terbilangTanggal($tanggal): array
    {
        if (!$tanggal) {
            return [
                'hari'    => '[Nama Hari]',
                'tanggal' => '[Tanggal]',
                'bulan'   => '[Bulan]',
                'tahun'   => '[Tahun]',
            ];
        }

        $tgl = \Carbon\Carbon::parse($tanggal);
        $thn = $tgl->year;

        // 2026 menjadi "Dua Ribu Dua Puluh Enam"
        $ribuan = intdiv($thn, 1000);
        $sisa   = $thn % 1000;
        $tahun  = (self::$ANGKA[$ribuan] ?? $ribuan) . ' Ribu';

        if ($sisa > 0) {
            $puluhan = $sisa % 100;
            $tahun .= ' ' . (self::$ANGKA[$puluhan] ?? $puluhan);
        }

        $hari = $tgl->format('l');

        return [
            'hari'    => self::$HARI[$hari] ?? '',
            'tanggal' => self::$ANGKA[$tgl->day] ?? $tgl->day,
            'bulan'   => self::$BULAN[$tgl->month],
            'tahun'   => $tahun,
        ];
    }
}