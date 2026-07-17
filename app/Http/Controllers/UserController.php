<?php

namespace App\Http\Controllers;

use App\Models\ref_skpd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function View()
    {
        $load['halaman_judul'] = "Referensi User ";
        $load['halaman_deskripsi'] = "Data user yang dapat mengakses aplikasi ini";
        $load['users'] = User::orderBy('created_at', 'desc')->get();
        $load['ref_skpd'] = ref_skpd::get();

        return view('referensi.users',  $load);
    }

    public function simpan(Request $request)
    {

        $posData = [];

        foreach($request->all() as $key => $val){
            if($val){
                $posData[$key] = $val;
            }
        }


        if($request->has('password') && !empty($request->input('password'))) {
            $posData['password'] = Hash::make($request->input('password'));
        }

        if($request->has('id') && !empty($request->input('id'))) {
            $user = User::find($request->input('id'));
            if ($user) {
                $user->update($posData);
                return redirect()->back()->with('success', 'User berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'User tidak ditemukan.');
            }
        }

        User::create($posData);

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }

    public function delete(Request $request)
    {
        $user = User::find($request->input('hapusTarget'));
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
    }
}
