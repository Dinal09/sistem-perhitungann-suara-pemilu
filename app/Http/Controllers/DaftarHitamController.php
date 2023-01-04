<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Pemilih;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarHitamController extends Controller
{
    public $title = 'Daftar Hitam';
    public $link = 'daftar-hitam';

    public function index()
    {
        $data = Pemilih::getDaftarHitam();
        $desa = Desa::get();
        return view('pemilih.' . $this->link, [
            'data' => $data,
            'desa' => $desa,
            'title' => $this->title,
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