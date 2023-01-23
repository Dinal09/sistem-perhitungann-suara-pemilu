<?php

namespace App\Http\Controllers;

use App\Models\Tps;
use App\Models\Dapil;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TpsController extends Controller
{
    public $title = 'Tps';
    public $link = 'tps';

    public function index($id)
    {
        if ($id == 'all') {
            $data = Tps::select(['tps.*', 'desa.nama AS desa_nama'])
                ->leftJoin('desa', 'desa.id', '=', 'tps.id_desa')->orderBy('nama')->get();
        } else {
            $data = Tps::select(['tps.*', 'desa.nama AS desa_nama'])
                ->leftJoin('desa', 'desa.id', '=', 'tps.id_desa')->where(['id_desa' => $id])->orderBy('nama')->get();
        }

        $desa = Kecamatan::with('desa')->get();

        return view('master.' . $this->link, [
            'data' => $data,
            'desa' => $desa,
            'title' => $this->title,
            'link' => $this->link,
            'filter_id' => $id,
            'explain' => 'Menu yang berisi data ' . $this->link . ', Terdapat Juga Fitur Tambah, Update dan Hapus'
        ]);
    }

    public function getById(Request $request)
    {
        $id = $request->id;
        $data = Tps::select(['tps.*', 'desa.nama AS desa_nama', 'desa.id AS desa_id'])
            ->leftJoin('desa', 'desa.id', '=', 'tps.id_desa')->where('tps.id', $id)->first();

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
            'id_desa' => 'required'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors()->first());
        }
        $data = $request->all();
        unset($data['_token']);
        Tps::create($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan...!!');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        Tps::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Diedit...!!');
    }

    public function delete($id)
    {
        Tps::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus...!!');
    }
}