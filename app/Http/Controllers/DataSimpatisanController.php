<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pemilih;
use App\Models\TypePemilih;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataSimpatisanController extends Controller
{
    public $title = 'Data Simpatisan';
    public $link = 'data-simpatisan';

    public function index($id)
    {
        $pemilih = array();
        if ($id == 'all') {
            $data = Pemilih::getAllSimpatisan();
            $dataDesa = null;
        } else {
            $data = Pemilih::getSimpatisanByDesa($id);
            $dataDesa = Desa::find(['id' => $id])->toArray();
            $pemilih = Pemilih::getPemilihExpeptSimpatisanByDesa($id);
        }
        // dd($pemilih);
        $selectDesa = Kecamatan::with('desa')->get();

        return view('pemilih.' . $this->link, [
            'title' => $this->title . (isset($dataDesa[0]) ? ' Desa ' . $dataDesa[0]['nama'] : ''),
            'explain' => 'Menu yang berisi data pemilih yang dikategorikan sebagai simpatisan, Terdapat Juga Fitur Tambah, Update dan Hapus',
            'link' => $this->link,
            'selectDesa' => $selectDesa,
            'filter_id' => $id,
            'data' => $data,
            'pemilih' => $pemilih,
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id_pemilih;

        TypePemilih::insert([
            'id_pemilih' => $id,
            'id_pemilih_jenis' => 4,
        ]);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan!!');
    }

    public function delete($id)
    {
        TypePemilih::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus!!');
    }
}
