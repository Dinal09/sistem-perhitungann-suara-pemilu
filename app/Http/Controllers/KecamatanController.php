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
            $data = Kecamatan::select(['kecamatan.id', 'kecamatan.nama', 'kecamatan.created_at', 'kabupaten.nama AS kabupaten_nama'])
                ->leftJoin('kabupaten', 'kabupaten.id', '=', 'kecamatan.id_kabupaten')
                ->with(['desa' => function ($q) {
                    $q->select(['id_kecamatan', 'nama']);
                }])
                ->orderBy('kecamatan.nama')->get()->toArray();
        } else {
            $data = Kecamatan::select(['kecamatan.id', 'kecamatan.nama', 'kecamatan.created_at', 'kabupaten.nama AS kabupaten_nama'])
                ->leftJoin('kabupaten', 'kabupaten.id', '=', 'kecamatan.id_kabupaten')
                ->with(['desa' => function ($q) {
                    $q->select(['id_kecamatan', 'nama']);
                }])
                ->where(['kecamatan.id_kabupaten' => $id])->orderBy('kecamatan.nama')->get()->toArray();
        }
        $kabupaten = Dapil::with('kabupaten')->get();
        return view('master.' . $this->link, [
            'data' => $data,
            'kabupaten' => $kabupaten,

            'title' => $this->title,
            'link' => $this->link,
            'filter_id' => $id,
            'explain' => 'Menu yang berisi data ' . $this->link . ', Terdapat Juga Fitur Tambah, Update dan Hapus'
        ]);
    }

    public function getById(Request $request)
    {
        $id = $request->id;
        $data = Kecamatan::select(['kecamatan.id', 'kecamatan.nama', 'kecamatan.created_at', 'kabupaten.nama AS kabupaten_nama', 'kabupaten.id AS kabupaten_id'])
            ->leftJoin('kabupaten', 'kabupaten.id', '=', 'kecamatan.id_kabupaten')->where('kecamatan.id', $id)->first();

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
                    'id_kabupaten' => $data['id_kabupaten'],
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
