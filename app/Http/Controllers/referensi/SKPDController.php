<?php

namespace App\Http\Controllers\referensi;

use App\Http\Controllers\Controller;
use App\Models\ref_skpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SKPDController extends Controller
{
    public function View(Request $request)
    {
        Gate::authorize('isVerifikator');
        $load['halaman_judul'] = "Referensi SKPD";
        $load['halaman_deskripsi'] = "Data skpd yang dapat digunakan dalam aplikasi ini";
        $urutanData = $request->urutan_data ?? 'desc';
        $filter = [];

        $query = ref_skpd::orderBy('created_at', $urutanData);
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
        $load['skpds'] = $query->paginate(25);
        $load['filterData'] = $filter;

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
