<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\JenisKeluarga;
use App\Models\Kecamatan;
use App\Models\Pemilih;
use App\Models\TypePemilih;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataKeluargaController extends Controller
{
    public $title = 'Data Keluarga';
    public $link = 'data-keluarga';

    public function index($id, $jenis)
    {
        $pemilih = array();
        if ($id == 'all') {
            $data = Pemilih::getAllKeluarga($jenis);
            $dataDesa = null;
        } else {
            $data = Pemilih::getKeluargaByDesa($id, $jenis);
            $dataDesa = Desa::find(['id' => $id])->toArray();
            $pemilih = Pemilih::getPemilihExpeptKeluargaByDesa($id);
        }
        // dd($pemilih);
        $selectDesa = Kecamatan::with('desa')->get();
        $jenisKeluarga = JenisKeluarga::get()->toArray();
        $params = [
            'id' => $id,
            'jenis' => $jenis
        ];

        return view('pemilih.' . $this->link, [
            'title' => $this->title . (isset($dataDesa[0]) ? ' Desa ' . $dataDesa[0]['nama'] : ''),
            'explain' => 'Menu yang berisi data pemilih yang dikategorikan sebagai keluarga, Terdapat Juga Fitur Tambah, Update dan Hapus',
            'link' => $this->link,
            'selectDesa' => $selectDesa,
            'params' => $params,
            'data' => $data,
            'pemilih' => $pemilih,
            'jenisKeluarga' => $jenisKeluarga
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id_pemilih;
        $jenis = $request->id_jenis;

        TypePemilih::insert([
            'id_pemilih' => $id,
            'id_pemilih_jenis' => 3,
            'id_keluarga' => $jenis
        ]);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan!!');
    }

    public function delete($id)
    {
        TypePemilih::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus!!');
    }
}
