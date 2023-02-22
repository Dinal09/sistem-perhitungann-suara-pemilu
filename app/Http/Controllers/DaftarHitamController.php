<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pemilih;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarHitamController extends Controller
{
    public $title = 'Daftar Hitam';
    public $link = 'daftar-hitam';

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
                ])
                ->whereNotIn('is_daftar_hitam', ['iya'])
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
            'explain' => 'Menu yang berisi data pemilih yang dikategorikan sebagai daftar hitam, Terdapat Juga Fitur Tambah, Update dan Hapus'
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
            ])
            ->whereNotIn('is_daftar_hitam', ['iya'])
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
        $data = [
            'is_daftar_hitam' => 'iya',
            'is_keluarga' => 'tidak',
            'is_simpatisan' => 'tidak',
            'is_pengkhianat' => 'tidak',
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
            'is_daftar_hitam' => 'tidak',
            'keluarga_tgl' => date('Y-m-d H:i:s'),
            'keluarga_by' => Auth::user()->id
        ];
        Pemilih::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus!!');
    }
}