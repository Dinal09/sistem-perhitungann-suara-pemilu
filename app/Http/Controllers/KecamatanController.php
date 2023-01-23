<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Dapil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KecamatanController extends Controller
{
    public $title = 'Kecamatan';
    public $link = 'kecamatan';

    public function index($id)
    {
        if ($id == 'all') {
            $data = Kecamatan::select(['kecamatan.id', 'kecamatan.nama', 'kecamatan.created_at', 'dapil.nama AS dapil_nama'])
                ->leftJoin('dapil', 'dapil.id', '=', 'kecamatan.id_dapil')->orderBy('nama')->get();
        } else {
            $data = Kecamatan::select(['kecamatan.id', 'kecamatan.nama', 'kecamatan.created_at', 'dapil.nama AS dapil_nama'])
                ->leftJoin('dapil', 'dapil.id', '=', 'kecamatan.id_dapil')->orderBy('nama')->where(['id_dapil' => $id])->get();
        }
        $dapil = Dapil::get();
        return view('master.' . $this->link, [
            'data' => $data,
            'dapil' => $dapil,

            'title' => $this->title,
            'link' => $this->link,
            'filter_id' => $id,
            'explain' => 'Menu yang berisi data ' . $this->link . ', Terdapat Juga Fitur Tambah, Update dan Hapus'
        ]);
    }

    public function getById(Request $request)
    {
        $id = $request->id;
        $data = Kecamatan::select(['kecamatan.id', 'kecamatan.nama', 'kecamatan.created_at', 'dapil.nama AS dapil_nama', 'dapil.id AS dapil_id'])
            ->leftJoin('dapil', 'dapil.id', '=', 'kecamatan.id_dapil')->where('kecamatan.id', $id)->first();

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
                    'id_dapil' => $data['id_dapil'],
                    'nama' => $e,
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }

            Kecamatan::insert($insertData);
        } else {
            unset($data['_token']);
            Kecamatan::create($data);
        }

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan...!!');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        Kecamatan::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Diedit...!!');
    }

    public function delete($id)
    {
        Kecamatan::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus...!!');
    }
}