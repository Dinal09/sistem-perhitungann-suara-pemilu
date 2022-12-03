<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $data = Users::get();
        return view('master.users', [
            'data' => $data,
            'title' => 'Pengguna',
            'explain' => 'Menu yang berisi data pengguna yang dapat meng-akses aplikasi '.env('APP_NAME').', Terdapat Juga Fitur Tambah, Update, Hapus dan Export Ke berbagai
                            tipe file yang diinginkan'
        ]);
    }
}
