<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Dapil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesaController extends Controller
{
    public $title = 'Desa';
    public $link = 'desa';

    public function index($id)
    {
        if ($id == 'all') {
            $data = Desa::with('kecamatan.dapil')->orderBy('nama')->get();
        } else {
            $data = Desa::with('kecamatan.dapil')->orderBy('nama')->where(['id_kecamatan' => $id])->get();
        }
        $kecamatan = Dapil::with('kecamatan')->get();

        return view('master.' . $this->link, [
            'data' => $data,
            'kecamatan' => $kecamatan,
            'title' => $this->title,
            'link' => $this->link,
            'filter_id' => $id,
            'explain' => 'Menu yang berisi data ' . $this->link . ', Terdapat Juga Fitur Tambah, Update dan Hapus'
        ]);
    }

    public function getById(Request $request)
    {
        $id = $request->id;
        $data = Desa::select(['desa.*', 'kecamatan.nama AS kecamatan_nama', 'kecamatan.id AS kecamatan_id'])
            ->leftJoin('kecamatan', 'kecamatan.id', '=', 'desa.id_kecamatan')->where('desa.id', $id)->first();

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

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors()->first());
        }

        $data = $request->all();
        if (strpos($data['nama'], ",") !== false) {
            $exp = explode(', ', $data['nama']);

            foreach ($exp as $e) {
                $insertData[] = [
                    'id_kecamatan' => $data['id_kecamatan'],
                    'nama' => $e,
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }

            Desa::insert($insertData);
        } else {
            unset($data['_token']);
            Desa::create($data);
        }

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan...!!');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        Desa::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Diedit...!!');
    }

    public function delete($id)
    {
        Desa::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus...!!');
    }
}