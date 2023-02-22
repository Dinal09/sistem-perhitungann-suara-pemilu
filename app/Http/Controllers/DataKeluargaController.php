<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pemilih;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataKeluargaController extends Controller
{
    public $title = 'Data Keluarga';
    public $link = 'data-keluarga';

    public function index($id)
    {
        $pemilih = array();
        if ($id == 'all') {
            $data = Pemilih::select(['pemilih.id', 'pemilih.nama', 'pemilih.no_nik', 'pemilih.alamat', 'pemilih.no_hp', 'jenis_keluarga.deskripsi'])
                ->join('type_pemilih', 'type_pemilih.id_pemilih', '=', 'pemilih.id')
                ->join('jenis_keluarga', 'jenis_keluarga.id', '=', 'type_pemilih.id_keluarga')
                ->whereNotNull('type_pemilih.id_keluarga')
                ->get()->toArray();
            $dataDesa = null;
            $pemilih = array();
        } else {
            $data = Pemilih::select(['pemilih.id', 'pemilih.nama', 'pemilih.no_nik', 'pemilih.alamat', 'pemilih.no_hp', 'jenis_keluarga.deskripsi'])
                ->join('type_pemilih', 'type_pemilih.id_pemilih', '=', 'pemilih.id')
                ->join('jenis_keluarga', 'jenis_keluarga.id', '=', 'type_pemilih.id_keluarga')
                ->whereNotNull('type_pemilih.id_keluarga')
                ->where(['pemilih.id_desa' => $id])
                ->get()->toArray();
            $dataDesa = Desa::find(['id' => $id])->toArray();
            $pemilih = array();
        }
        $selectDesa = Kecamatan::with('desa')->get();
        return view('pemilih.' . $this->link, [
            'data' => $data,
            'pemilih' => $pemilih,
            'title' => $this->title . (isset($dataDesa[0]) ? ' Desa ' . $dataDesa[0]['nama'] : ''),
            'link' => $this->link,
            'selectDesa' => $selectDesa,
            'filter_id' => $id,
            'explain' => 'Menu yang berisi data pemilih yang dikategorikan sebagai keluarga, Terdapat Juga Fitur Tambah, Update dan Hapus'
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id_pemilih;
        $jenis = $request->id_jenis;
        $data = [
            'is_keluarga' => $jenis,
            'is_simpatisan' => 'tidak',
            'is_pengkhianat' => 'tidak',
            'is_daftar_hitam' => 'tidak',
            'id_suara_abu' => null,
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
            'is_keluarga' => 'tidak',
            'keluarga_tgl' => date('Y-m-d H:i:s'),
            'keluarga_by' => Auth::user()->id
        ];
        Pemilih::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus!!');
    }
}
