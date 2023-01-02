<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Pemilih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataKeluargaController extends Controller
{
    public $title = 'Data Keluarga';
    public $link = 'data-keluarga';

    public function index()
    {
        $data = Pemilih::getKeluarga();
        $desa = Desa::get();
        return view('pemilih.' . $this->link, [
            'data' => $data,
            'desa' => $desa,
            'title' => $this->title,
            'link' => $this->link,
            'explain' => 'Menu yang berisi data pemilih yang dikategorikan sebagai keluarga, Terdapat Juga Fitur Tambah, Update dan Hapus'
        ]);
    }

    public function getPemilihByDesa(Request $request)
    {
        $id = $request->idDesa;
        $data = Pemilih::select(['pemilih.*'])
            ->leftJoin('tps', 'pemilih.id_tps', '=', 'tps.id')
            ->where([
                'tps.id_desa' => $id,
                'pemilih.is_keluarga' => null
            ])->get()->toArray();

        if (count($data) == 0) {
            return json_encode([
                'kode' => 400,
                'pesan' => 'Belum Terdapat Pemilih Pada Desa Tersebut'
            ]);
        }

        $option = '<option>--- Pilih Pemilih ---</option>';
        foreach ($data as $d) {
            $option .= '<option value=' . $d['id'] . '> ' . $d['nama'] . ' </option>';
        }

        return json_encode([
            'kode' => 200,
            'pesan' => 'Pemilih Berhasil Didapatkan',
            'option' => $option
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id_pemilih;
        $jenis = $request->id_jenis;
        $data = [
            'is_keluarga' => $jenis,
            'keluarga_tgl' => date('Y-m-d H:i:s'),
            'keluarga_by' => Auth::user()->id
        ];
        Pemilih::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan!!');
    }

    public function delete($id)
    {
        $id = $id;
        $data = [
            'is_keluarga' => null,
            'keluarga_tgl' => date('Y-m-d H:i:s'),
            'keluarga_by' => Auth::user()->id
        ];
        Pemilih::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus!!');
    }
}