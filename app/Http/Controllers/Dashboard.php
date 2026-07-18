<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function view()
    {
        $load['halaman_judul'] = "Dashboard";
        $load['halaman_deskripsi'] = "menampilkan data dalam aplikasi ini";

        return view('dashboard',  $load);
    }
}
