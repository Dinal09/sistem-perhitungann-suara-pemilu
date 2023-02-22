<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pemilih;
use App\Models\SuaraAbu;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataSuaraAbuController extends Controller
{

    public $title = 'Data Suara Abu-abu';
    public $link = 'data-suara-abu';

    public function index($id)
    {
        $pemilih = array();
        if ($id == 'all') {
            $data = Pemilih::getPengkhianat();
            $dataDesa = null;
            $pemilih = array();
        } else {
            $data = Pemilih::getPengkhianat($id);
            $dataDesa = Desa::find(['id' => $id])->toArray();
            $pemilihData = Pemilih::select(['pemilih.*', 'suara_abu.deskripsi'])
                ->leftJoin('suara_abu', 'pemilih.id_suara_abu', '=', 'suara_abu.id')
                ->where([
                    'pemilih.id_desa' => $id,
                    'id_suara_abu' => null
                ])
                ->get()->toArray();

            foreach ($pemilihData as $idx => $pem) {
                if ($pem['is_keluarga'] != 'tidak') {
                    $status = 'Keluarga';
                } elseif ($pem['is_simpatisan'] == 'iya') {
                    $status = 'Simpatisan';
                } elseif ($pem['is_pengkhianat'] == 'iya') {
                    $status = 'Pengkhianat';
                } elseif ($pem['is_daftar_hitam'] == 'iya') {
                    $status = 'Daftar Hitam';
                } elseif ($pem['id_suara_abu'] != null) {
                    $status = 'Suara Abu-abu ';
                } else {
                    $status = '';
                }
                $pemilih[$idx]['id'] = $pem['id'];
                $pemilih[$idx]['nama'] = $pem['nama'] . ' | ' . $status;
            }
        }
        $selectDesa = Kecamatan::with('desa')->get();
        $jenis = SuaraAbu::get();
        return view('pemilih.' . $this->link, [
            'data' => $data,
            'pemilih' => $pemilih,
            'selectDesa' => $selectDesa,
            'filter_id' => $id,
            'jenis' => $jenis,
            'title' => $this->title . (isset($dataDesa[0]) ? ' Desa ' . $dataDesa[0]['nama'] : ''),
            'link' => $this->link,
            'explain' => 'Menu yang berisi data pemilih yang dikategorikan sebagai suara abu-abu, Terdapat Juga Fitur Tambah, Update dan Hapus'
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id_pemilih;
        $jenis = $request->id_jenis;
        $data = [
            'is_keluarga' => 'tidak',
            'is_simpatisan' => 'tidak',
            'is_pengkhianat' => 'tidak',
            'is_daftar_hitam' => 'tidak',
            'id_suara_abu' => $jenis,
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