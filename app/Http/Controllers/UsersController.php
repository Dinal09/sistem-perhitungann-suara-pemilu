<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public $title = 'Pengguna';
    public $link = 'pengguna';

    public function index()
    {
        $data = Users::get();
        return view('master.' . $this->link, [
            'data' => $data,
            'title' => $this->title,
            'link' => $this->link,
            'explain' => 'Menu yang berisi data pengguna yang dapat meng-akses aplikasi ' . env('APP_NAME') . ', Terdapat Juga Fitur Tambah, Update, Hapus dan Export Ke berbagai
                            tipe file yang diinginkan'
        ]);
    }

    public function getById(Request $request)
    {
        $id = $request->id;
        $data = Users::find($id);

        if ($data) {
            return json_encode([
                'kode' => 200,
                'pesan' => 'Data ' . $this->title . ' Berhasil Ditemukan...!!',
                'data' => $data
            ]);
        } else {
            return json_encode([
                'kode' => 400,
                'pesan' => 'Data ' . $this->title . ' Tidak Ditemukan...!!',
            ]);
        }
    }


    public function getFotoById(Request $request)
    {
        $id = $request->id;
        $data = Users::find($id);

        if ($data) {
            return json_encode([
                'kode' => 200,
                'pesan' => 'Data ' . $this->title . ' Berhasil Ditemukan...!!',
                'data' => $data,
                'foto' => asset('storage/data-aplikasi/foto-user/' . $data->foto)
            ]);
        } else {
            return json_encode([
                'kode' => 400,
                'pesan' => 'Data ' . $this->title . ' Tidak Ditemukan...!!',
            ]);
        }
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors()->first());
        }

        $simpan = $request->file('foto')->store('/public/data-aplikasi/foto-user');

        if ($simpan) {
            $linkFoto = explode('/', $simpan);
            $data = $request->all();

            $data['foto'] = $linkFoto[3];
            $data['password'] = Hash::make($request->password);
            unset($data['_token']);
            Users::create($data);

            return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan...!!');
        } else {
            return redirect()->back()->with('error', $this->title . ' Gagal Disimpan');
        }
    }

    public function update(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'username' => 'unique:users',
            'foto' => 'image|mimes:jpg,png,jpeg,svg|max:2048',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors()->first());
        }

        $data = $request->all();

        $id = $request->id;
        if (isset($request->password)) {
            $data['password'] = Hash::make($request->password);
            $notif = 'Berhasil Mengubah Foto Pengguna';
        } elseif (isset($request->foto)) {
            $simpan = $request->file('foto')->store('/public/data-aplikasi/foto-user');
            $linkFoto = explode('/', $simpan);

            $data['foto'] = $linkFoto[3];
            $notif = 'Berhasil Mengubah Password Pengguna';
        } else {
            $notif = 'Berhasil Mengubah Data Pengguna';
        }

        unset($data['_token']);
        unset($data['id']);
        Users::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', $notif);
    }

    public function delete($id)
    {
        Users::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus...!!');
    }
}