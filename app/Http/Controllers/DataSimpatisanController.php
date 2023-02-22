<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pemilih;
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
            $data = Pemilih::getSimpatisan();
            $dataDesa = null;
            $pemilih = array();
        } else {
            $data = Pemilih::getSimpatisan($id);
            $dataDesa = Desa::find(['id' => $id])->toArray();
            $pemilihData = Pemilih::select(['pemilih.*', 'suara_abu.deskripsi'])
                ->leftJoin('suara_abu', 'pemilih.id_suara_abu', '=', 'suara_abu.id')
                ->where([
                    'pemilih.id_desa' => $id,
                ])
                ->whereNotIn('is_simpatisan', ['iya'])
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
        return view('pemilih.' . $this->link, [
            'data' => $data,
            'pemilih' => $pemilih,
            'selectDesa' => $selectDesa,
            'filter_id' => $id,
            'title' => $this->title . (isset($dataDesa[0]) ? ' Desa ' . $dataDesa[0]['nama'] : ''),
            'link' => $this->link,
            'explain' => 'Menu yang berisi data pemilih yang dikategorikan sebagai simpatisan, Terdapat Juga Fitur Tambah, Update dan Hapus'
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id_pemilih;
        $data = [
            'is_simpatisan' => 'iya',
            'is_keluarga' => 'tidak',
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
            'is_simpatisan' => 'tidak',
            'keluarga_tgl' => date('Y-m-d H:i:s'),
            'keluarga_by' => Auth::user()->id
        ];
        Pemilih::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus!!');
    }
}