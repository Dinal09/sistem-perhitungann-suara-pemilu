<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Pemilih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataUmumController extends Controller
{
    public $title = 'Data Umum';
    public $link = 'data-umum';

    public function index()
    {
        $data = Pemilih::with('tps.desa.kecamatan.dapil')->get();

        return view('pemilih.' . $this->link, [
            'data' => $data,
            'title' => $this->title,
            'link' => $this->link,
            'explain' => 'Menu yang berisi data semua pemilih yang memiliki hak suara, Terdapat Juga Fitur Tambah, Update, Hapus dan Export Ke berbagai
                            tipe file yang diinginkan'
        ]);
    }

    public function getById(Request $request)
    {
        $id = $request->id;
        $data = Pemilih::find($id);

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
        $data = Pemilih::find($id);

        if ($data) {
            return json_encode([
                'kode' => 200,
                'pesan' => 'Data ' . $this->title . ' Berhasil Ditemukan...!!',
                'data' => $data,
                'foto' => asset('storage/data-aplikasi/foto-pemilih/' . $data->foto)
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
            'no_nik' => 'required|unique:pemilih',
            'no_kk' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048',
            'foto_ktp' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048',
            'foto_kk' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors()->first());
        }

        $simpanFoto = $request->file('foto')->store('/public/data-aplikasi/foto-pemilih');
        $simpanFotoKtp = $request->file('foto_ktp')->store('/public/data-aplikasi/foto-ktp');
        $simpanFotoKK = $request->file('foto_kk')->store('/public/data-aplikasi/foto-kk');

        if ($simpanFoto && $simpanFotoKtp && $simpanFotoKK) {
            $data = $request->all();

            $linkFoto = explode('/', $simpanFoto);
            $linkFotoKtp = explode('/', $simpanFotoKtp);
            $linkFotoKK = explode('/', $simpanFotoKK);

            $data['foto'] = $linkFoto[3];
            $data['foto_ktp'] = $linkFotoKtp[3];
            $data['foto_kk'] = $linkFotoKK[3];
            unset($data['_token']);

            // return json_encode($data);
            Pemilih::create($data);

            return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan...!!');
        } else {
            return redirect()->back()->with('error', $this->title . ' Gagal Disimpan');
        }
    }

    public function update(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'no_nik' => 'required|unique:pemilih',
            'no_kk' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => 'image|mimes:jpg,png,jpeg,svg|max:2048',
            'foto_ktp' => 'image|mimes:jpg,png,jpeg,svg|max:2048',
            'foto_kk' => 'image|mimes:jpg,png,jpeg,svg|max:2048',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors()->first());
        }

        $data = $request->all();

        $id = $request->id;
        if (isset($request->foto)) {
            $simpanFoto = $request->file('foto')->store('/public/data-aplikasi/foto-pemilih');
            $linkFoto = explode('/', $simpanFoto);
            $data['foto'] = $linkFoto[3];
        }
        if (isset($request->foto_ktp)) {
            $simpanFotoKtp = $request->file('foto_ktp')->store('/public/data-aplikasi/foto-ktp');
            $linkFotoKtp = explode('/', $simpanFotoKtp);
            $data['foto_ktp'] = $linkFotoKtp[3];
        }
        if (isset($request->foto_kk)) {
            $simpanFotoKK = $request->file('foto_kk')->store('/public/data-aplikasi/foto-kk');
            $linkFotoKK = explode('/', $simpanFotoKK);
            $data['foto'] = $linkFotoKK[3];
        }

        unset($data['_token']);
        unset($data['id']);
        Pemilih::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', ' Berhasil Diubah...!!');
    }

    public function delete($id)
    {
        Pemilih::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus...!!');
    }
}