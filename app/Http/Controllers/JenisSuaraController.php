<?php

namespace App\Http\Controllers;

use App\Models\JenisSuara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisSuaraController extends Controller
{
    public $title = 'Jenis Suara';
    public $link = 'jenis-suara';

    public function index()
    {
        $data = JenisSuara::get();
        return view('master.'.$this->link, [
            'data' => $data,
            'title' => $this->title,
            'link' => $this->link,
            'explain' => 'Menu yang berisi data jenis suara pada perhitungan suara, Terdapat Juga Fitur Tambah, Update dan Hapus'
        ]);
    }

    public function getById(Request $request){
        $id = $request->id;
        $data = JenisSuara::find($id);

        if($data){
            return json_encode([
                'kode' => 200,
                'pesan' => 'Data '.$this->title.' Berhasil Ditemukan...!!',
                'data' => $data
            ]);
        }else{
            return json_encode([
                'kode' => 400,
                'pesan' => 'Data '.$this->title.' Tidak Ditemukan...!!',
            ]);
        }
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'deskripsi' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors()->first());
        }
        $data = $request->all();
        unset($data['_token']);
        JenisSuara::create($data);

        return redirect()->back()->with('sukses', $this->title.' Berhasil Ditambahkan...!!');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        JenisSuara::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', $this->title.' Berhasil Diedit...!!');
    }

    public function delete($id)
    {
        JenisSuara::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title.' Berhasil Dihapus...!!');
    }
}
