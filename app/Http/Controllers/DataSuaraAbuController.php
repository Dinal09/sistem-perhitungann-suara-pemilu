<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Pemilih;
use App\Models\SuaraAbu;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataSuaraAbuController extends Controller
{

    public $title = 'Data Suara Abu-abu';
    public $link = 'data-suara-abu';

    public function index()
    {
        $data = Pemilih::getSuaraAbu();
        $desa = Desa::get();
        $jenis = SuaraAbu::get();
        return view('pemilih.' . $this->link, [
            'data' => $data,
            'desa' => $desa,
            'jenis' => $jenis,
            'title' => $this->title,
            'link' => $this->link,
            'explain' => 'Menu yang berisi data pemilih yang dikategorikan sebagai suara abu-abu, Terdapat Juga Fitur Tambah, Update dan Hapus'
        ]);
    }

    public function getPemilihByDesa(Request $request)
    {
        $id = $request->idDesa;
        $data = Pemilih::select(['pemilih.*', 'suara_abu.deskripsi'])
            ->leftJoin('tps', 'pemilih.id_tps', '=', 'tps.id')
            ->leftJoin('suara_abu', 'pemilih.id_suara_abu', '=', 'suara_abu.id')
            ->where([
                'tps.id_desa' => $id,
                'id_suara_abu' => null
            ])
            ->get()->toArray();

        $option = '<option>--- Pilih Pemilih ---</option>';
        if (count($data) == 0) {
            return json_encode([
                'kode' => 400,
                'pesan' => 'Belum Terdapat Pemilih Pada Desa Tersebut',
                'option' => $option
            ]);
        }

        foreach ($data as $d) {
            $tgl = date('m.d.y', strtotime($d['tanggal_lahir']));
            $lahir = DateTime::createFromFormat('m.d.y', $tgl);
            $sekarang = DateTime::createFromFormat('m.d.y', date('m.d.y'));
            $umur = $sekarang->diff($lahir);

            if ($d['is_keluarga'] == 'iya') {
                $status = 'Keluarga';
            } elseif ($d['is_simpatisan'] == 'iya') {
                $status = 'Simpatisan';
            } elseif ($d['is_pengkhianat'] == 'iya') {
                $status = 'Pengkhianat';
            } elseif ($d['is_daftar_hitam'] == 'iya') {
                $status = 'Daftar Hitam';
            } elseif ($d['id_suara_abu'] != null) {
                $status = $d['deskripsi'];
            } else {
                $status = '-';
            }

            $option .= '<option value=' . $d['id'] . '> ' . $d['nama'] . ' | ' . $d['no_nik'] . '
                | ' . $umur->y . ' Tahun ' . $umur->m . ' Bulan | ' . $status . ' </option>';
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