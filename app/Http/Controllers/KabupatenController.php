<?php

namespace App\Http\Controllers;

use App\Models\Dapil;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KabupatenController extends Controller
{
    public $title = 'Kabupaten';
    public $link = 'kabupaten';

    public function index($id)
    {
        if ($id == 'all') {
            $data = Kabupaten::select(['kabupaten.id', 'kabupaten.nama', 'dapil.nama AS dapil_nama'])
                ->leftJoin('dapil', 'dapil.id', '=', 'kabupaten.id_dapil')
                ->with(['kecamatan' => function ($q) {
                    $q->select(['id_kabupaten', 'nama']);
                }])
                ->orderBy('kabupaten.nama')
                ->get()->toArray();
        } else {
            $data = Kabupaten::select(['kabupaten.id', 'kabupaten.nama', 'dapil.nama AS dapil_nama'])
                ->leftJoin('dapil', 'dapil.id', '=', 'kabupaten.id_dapil')
                ->with(['kecamatan' => function ($q) {
                    $q->select(['id_kabupaten', 'nama']);
                }])
                ->where(['kabupaten.id_dapil' => $id])
                ->orderBy('kabupaten.nama')
                ->get()->toArray();
        }
        // dd($data);
        $dapil = Dapil::get()->toArray();
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
        $data = DB::table('kabupaten AS k')
            ->select(['k.id', 'k.nama', 'k.created_at', 'd.nama AS dapil_nama', 'd.id AS dapil_id'])
            ->leftJoin('dapil AS d', 'd.id', '=', 'k.id_dapil')
            ->where('k.id', $id)->first();

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

            Kabupaten::insert($insertData);
        } else {
            unset($data['_token']);
            Kabupaten::create($data);
        }

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan...!!');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        Kabupaten::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Diedit...!!');
    }

    public function delete($id)
    {
        Kabupaten::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus...!!');
    }
}
