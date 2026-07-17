<?php

namespace App\Http\Controllers\referensi;

use App\Http\Controllers\Controller;
use App\Models\ref_mekanisme;
use Illuminate\Http\Request;

class MekanismeController extends Controller
{
    public function View()
    {
        $load['halaman_judul'] = "Referensi Mekanisme";
        $load['halaman_deskripsi'] = "Data mekanisme yang dapat digunakan dalam aplikasi ini";
        $load['mekanismes'] = ref_mekanisme::orderBy('created_at', 'desc')->get();

        return view('referensi.mekanisme',  $load);
    }

    public function simpan(Request $request)
    {

        $posData = $request->only([ 'mekanisme_nama']);

        if($request->has('mekanisme_id') && !empty($request->input('mekanisme_id'))) {
            $data = ref_mekanisme::find($request->input('mekanisme_id'));
            if ($data) {
                $data->update($posData);
                return redirect()->back()->with('success', 'Mekanisme berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'Mekanisme tidak ditemukan.');
            }
        }

        ref_mekanisme::create($posData);

        return redirect()->back()->with('success', 'Mekanisme berhasil ditambahkan.');
    }

    public function delete(Request $request)
    {
        $data = ref_mekanisme::find($request->input('hapusTarget'));
        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'Mekanisme berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Mekanisme tidak ditemukan.');
        }
    }
}
