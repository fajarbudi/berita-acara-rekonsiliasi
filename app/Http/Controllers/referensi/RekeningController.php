<?php

namespace App\Http\Controllers\referensi;

use App\Http\Controllers\Controller;
use App\Models\ref_rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RekeningController extends Controller
{
    public function View(Request $request)
    {
        Gate::authorize('isVerifikator');
        $load['halaman_judul'] = "Referensi Rekening";
        $load['halaman_deskripsi'] = "Data rekening yang dapat digunakan dalam aplikasi ini";
        $urutanData = $request->urutan_data ?? 'desc';
        $filter = [];

        $query = ref_rekening::orderBy('created_at', $urutanData);
        foreach($request->all() as $key => $val){
            if($val){
                $filter[$key] = $val;
            }
        }

        if($filter){
            foreach($filter as $key => $val){
                if($key != 'urutan_data' && $key != 'user_role'){
                    $query->where($key, 'like', '%' . $val . '%');
                }

                // if($key == 'skpd_id' || $key == 'user_role'){
                //     $query->where($key, $val);
                // }
            }
        }
        $load['rekenings'] = $query->paginate(25);
        $load['filterData'] = $filter;

        return view('referensi.rekening',  $load);
    }

    public function simpan(Request $request)
    {

        $posData = $request->only([ 'rekening_nama', 'rekening_kode', 'rekening_uraian']);

        if($request->has('rekening_id') && !empty($request->input('rekening_id'))) {
            $data = ref_rekening::find($request->input('rekening_id'));
            if ($data) {
                $data->update($posData);
                return redirect()->back()->with('success', 'Rekening berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'Rekening tidak ditemukan.');
            }
        }

        ref_rekening::create($posData);

        return redirect()->back()->with('success', 'Rekening berhasil ditambahkan.');
    }

    public function delete(Request $request)
    {
        $data = ref_rekening::find($request->input('hapusTarget'));
        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'Rekening berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Rekening tidak ditemukan.');
        }
    }
}
