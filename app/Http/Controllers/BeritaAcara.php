<?php

namespace App\Http\Controllers;

use App\Models\berita_acara;
use App\Models\berita_acara_belanja;
use App\Models\berita_acara_pendapatan;
use App\Models\ref_belanja;
use App\Models\ref_rekening;
use Illuminate\Http\Request;

class BeritaAcara extends Controller
{
    public function view()
    {
        $load['halaman_judul'] = "Berita Acara";
        $load['halaman_deskripsi'] = "Data berita acara yang dapat digunakan dalam aplikasi ini";
        $load['datas'] = berita_acara::orderBy('created_at', 'desc')->get(); // Replace with actual data loading logic
        return view('berita_acara.berita_acara',  $load);
    }

    public function detail($id)
    {
        $load['halaman_judul'] = "Detail Berita Acara";
        $load['halaman_deskripsi'] = "Detail berita acara";
        $load['berita_acara_id'] = $id;
        $load['data'] = berita_acara::findOrFail($id);
        $load['data_pendapatan'] = berita_acara_pendapatan::where('berita_acara_id', $id)->get();
        $load['data_belanja'] = berita_acara_belanja::where('berita_acara_id', $id)->get();
       
        return view('berita_acara.detail',  $load);
    }

    public function new()
    {
        $load['halaman_judul'] = "Berita Acara Baru";
        $load['halaman_deskripsi'] = "Form untuk membuat berita acara baru";
        $load['rekenings'] = ref_rekening::orderBy('rekening_kode', 'asc')->get();
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
       
        return view('berita_acara.edit',  $load);
    }

    public function simpan(Request $request)
    {
        $berita_acara_id = $request->input('berita_acara_id');
        $datas = $request->input('data');
        $rekening = $request->input('rekening');
        $belanja = $request->input('belanja');

        $dataPost = [];
        foreach ($datas as $key => $value) {
            if ($value){
                $dataPost[$key] = $value;
            }
        }

       if(!$berita_acara_id) {
            $berita_acara = berita_acara::create($dataPost);
        } else {
            $data = berita_acara::find($berita_acara_id);
            if ($data) {
               $berita_acara = $data->update($dataPost);
            } else {
                return redirect()->back()->with('error', 'Berita Acara tidak ditemukan.');
            }
        }

       $rekeningPost = [];
       if ($berita_acara && is_array($rekening)) {
            foreach ($rekening as $item) {
            $rekeningPost[] = [
                'berita_acara_id' => $berita_acara_id ?? $berita_acara->berita_acara_id,
                'rekening_id' => $item['rekening_id'],
                'rekening_kode' => ref_rekening::where('rekening_id', $item['rekening_id'])->value('rekening_kode'),
                'rekening_uraian' => $item['rekening_uraian'],
                'skpd' => $item['skpd'],
                'bud' => $item['bud'],
                'selisih' => $item['selisih'],
                'keterangan' => $item['keterangan'],
            ];
        }
            berita_acara_pendapatan::upsert($rekeningPost, ['berita_acara_id', 'rekening_uraian']); // Uncomment and replace with actual model
        }

        $belanjaPost = [];
        if ($berita_acara && $belanja) {
            foreach ($belanja as $item) {
                $belanjaPost[] = [
                    'berita_acara_id' => $berita_acara_id ?? $berita_acara->berita_acara_id,
                    'belanja_id' => $item['belanja_id'],
                    'belanja_nama' => ref_belanja::where('belanja_id', $item['belanja_id'])->value('belanja_nama'),
                    'belanja_uraian' => $item['belanja_uraian'],
                    'skpd' => $item['skpd'],
                    'bud' => $item['bud'],
                    'selisih' => $item['selisih'],
                    'keterangan' => $item['keterangan'],
                ];
            }
            berita_acara_belanja::upsert($belanjaPost, ['berita_acara_id', 'belanja_uraian']); // Uncomment and replace with actual model
        }

        return redirect()->route('berita_acara.view')->with('success', 'Berita Acara berhasil disimpan.');
    }
}
