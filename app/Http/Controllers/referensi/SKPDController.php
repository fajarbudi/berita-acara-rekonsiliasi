<?php

namespace App\Http\Controllers\referensi;

use App\Http\Controllers\Controller;
use App\Models\ref_skpd;
use Illuminate\Http\Request;

class SKPDController extends Controller
{
    public function View()
    {
        $load['halaman_judul'] = "Referensi SKPD";
        $load['halaman_deskripsi'] = "Data skpd yang dapat digunakan dalam aplikasi ini";
        $load['skpds'] = ref_skpd::orderBy('created_at', 'desc')->get();

        return view('referensi.skpd',  $load);
    }

    public function simpan(Request $request)
    {

        $posData = $request->only([        'skpd_nama',
        'skpd_singkatan',
        'skpd_nama_ppk',
        'skpd_nip_ppk',
        'skpd_nama_pa',
        'skpd_nip_pa']);

        if ($request->has('skpd_id') && !empty($request->input('skpd_id'))) {
            $data = ref_skpd::find($request->input('skpd_id'));
            if ($data) {
                $data->update($posData);
                return redirect()->back()->with('success', 'skpd berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'skpd tidak ditemukan.');
            }
        }

        ref_skpd::create($posData);

        return redirect()->back()->with('success', 'skpd berhasil ditambahkan.');
    }

    public function delete(Request $request)
    {
        $data = ref_skpd::find($request->input('hapusTarget'));
        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'skpd berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'skpd tidak ditemukan.');
        }
    }
}
