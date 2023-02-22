<?php

namespace App\Http\Controllers;

use App\Models\Dapil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DapilController extends Controller
{
    public $title = 'Dapil';
    public $link = 'dapil';

    public function index()
    {
        $data = Dapil::select(['id', 'nama'])->with(['kabupaten' => function ($q) {
            $q->select(['id_dapil', 'nama']);
        }])->get()->toArray();

        // dd($data);

        return view('master.' . $this->link, [
            'data' => $data,
            'title' => $this->title,
            'link' => $this->link,
            'explain' => 'Menu yang berisi data daerah pilih, Terdapat Juga Fitur Tambah, Update dan Hapus'
        ]);
    }

    public function getById(Request $request)
    {
        $id = $request->id;
        $data = Dapil::find($id);

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
        unset($data['_token']);
        Dapil::create($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan...!!');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        Dapil::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Diedit...!!');
    }

    public function delete($id)
    {
        Dapil::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus...!!');
    }
}
