<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Partai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CalonController extends Controller
{
    public $title = 'Calon';
    public $link = 'calon';

    public function index($id)
    {
        if ($id == 'all') {
            $data = Calon::select(['calon.id', 'calon.nama', 'partai.deskripsi AS partai_nama'])
                ->leftJoin('partai', 'partai.id', '=', 'calon.id_partai')
                ->orderBy('calon.nama')
                ->get()->toArray();
        } else {
            $data = Calon::select(['calon.id', 'calon.nama', 'partai.deskripsi AS partai_nama'])
                ->leftJoin('partai', 'partai.id', '=', 'calon.id_partai')
                ->where(['calon.id_partai' => $id])
                ->orderBy('calon.nama')
                ->get()->toArray();
        }
        // dd($data);
        $partai = Partai::get()->toArray();
        return view('master.' . $this->link, [
            'data' => $data,
            'partai' => $partai,

            'title' => $this->title,
            'link' => $this->link,
            'filter_id' => $id,
            'explain' => 'Menu yang berisi data ' . $this->link . ', Terdapat Juga Fitur Tambah, Update dan Hapus'
        ]);
    }

    public function getById(Request $request)
    {
        $id = $request->id;
        $data = DB::table('calon AS k')
            ->select(['k.id', 'k.nama', 'k.created_at', 'd.deskripsi AS partai_nama', 'd.id AS partai_id'])
            ->leftJoin('partai AS d', 'd.id', '=', 'k.id_partai')
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
        // dd($data);

        if (strpos($data['nama'], "|") !== false) {
            $exp = explode(' | ', $data['nama']);

            foreach ($exp as $e) {
                $insertData[] = [
                    'id_partai' => (int)$data['id_partai'],
                    'nama' => $e,
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }

            Calon::insert($insertData);
        } else {
            unset($data['_token']);
            Calon::create($data);
        }

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan...!!');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        Calon::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Diedit...!!');
    }

    public function delete($id)
    {
        Calon::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus...!!');
    }
}
