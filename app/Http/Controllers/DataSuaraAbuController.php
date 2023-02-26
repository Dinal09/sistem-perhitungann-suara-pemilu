<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pemilih;
use App\Models\SuaraAbu;
use App\Models\TypePemilih;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataSuaraAbuController extends Controller
{

    public $title = 'Data Suara Abu-abu';
    public $link = 'data-suara-abu';

    public function index($id, $jenis)
    {
        $pemilih = array();
        if ($id == 'all') {
            $data = Pemilih::getAllSuaraAbu($jenis);
            $dataDesa = null;
        } else {
            $data = Pemilih::getSuaraAbuByDesa($id, $jenis);
            $dataDesa = Desa::find(['id' => $id])->toArray();
            $pemilih = Pemilih::getPemilihExpeptSuaraAbuByDesa($id);
        }
        // dd($pemilih);
        $selectDesa = Kecamatan::with('desa')->get();
        $suaraAbu = SuaraAbu::get()->toArray();
        $params = [
            'id' => $id,
            'jenis' => $jenis
        ];

        return view('pemilih.' . $this->link, [
            'title' => $this->title . (isset($dataDesa[0]) ? ' Desa ' . $dataDesa[0]['nama'] : ''),
            'explain' => 'Menu yang berisi data pemilih yang dikategorikan sebagai suara abu-abu, Terdapat Juga Fitur Tambah, Update dan Hapus',
            'link' => $this->link,
            'selectDesa' => $selectDesa,
            'params' => $params,
            'data' => $data,
            'pemilih' => $pemilih,
            'suaraAbu' => $suaraAbu
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id_pemilih;
        $jenis = $request->id_jenis;

        TypePemilih::insert([
            'id_pemilih' => $id,
            'id_pemilih_jenis' => 5,
            'id_suara_abu' => $jenis
        ]);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan!!');
    }

    public function delete($id)
    {
        TypePemilih::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus!!');
    }
}
