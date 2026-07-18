<?php

namespace App\Http\Controllers\referensi;

use App\Http\Controllers\Controller;
use App\Models\ref_belanja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BelanjaController extends Controller
{
    public function View()
    {
        Gate::authorize('isVerifikator');
        $load['halaman_judul'] = "Referensi Belanja";
        $load['halaman_deskripsi'] = "Data belanja yang dapat digunakan dalam aplikasi ini";
        $load['belanjas'] = ref_belanja::orderBy('created_at', 'desc')->paginate(25);

        return view('referensi.belanja',  $load);
    }

    public function simpan(Request $request)
    {

        $posData = $request->only([ 'belanja_nama', 'belanja_kode', 'belanja_uraian']);

        if($request->has('belanja_id') && !empty($request->input('belanja_id'))) {
            $data = ref_belanja::find($request->input('belanja_id'));
            if ($data) {
                $data->update($posData);
                return redirect()->back()->with('success', 'Belanja berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'Belanja tidak ditemukan.');
            }
        }

        ref_belanja::create($posData);

        return redirect()->back()->with('success', 'Belanja berhasil ditambahkan.');
    }

    public function delete(Request $request)
    {
        $data = ref_belanja::find($request->input('hapusTarget'));
        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'Belanja berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Belanja tidak ditemukan.');
        }
    }
}
