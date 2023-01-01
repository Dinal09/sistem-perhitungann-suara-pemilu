<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pemilih;
use Illuminate\Http\Request;

class DataKunjunganController extends Controller
{
    public $title = 'Data Kunjungan';
    public $link = 'data-kunjungan';

    public function index()
    {
        $kecamatan = Kecamatan::with('desa.tps')->get();

        foreach ($kecamatan as $idx => $kec) {
            foreach ($kec->desa as $des) {
                $kunjungan = Pemilih::leftJoin('tps', 'pemilih.id_tps', '=', 'tps.id')
                    ->leftJoin('desa', 'tps.id_desa', '=', 'desa.id')
                    ->where([
                        'desa.id' => $des->id,
                        'pemilih.is_kunjungan' => 'sudah'
                    ])
                    ->count();
                $persen[$idx][$des->id]['kunjungan'] = $kunjungan;

                if ($kunjungan != 0 || !is_null($des->target_kunjungan)) {
                    $persen[$idx][$des->id]['persen'] = ($kunjungan / $des->target_kunjungan) * 100;
                } else {
                    $persen[$idx][$des->id]['persen'] = 0;
                }
            }
        }

        return view('pemilih.' . $this->link, [
            'title' => $this->title,
            'link' => $this->link,
            'kecamatan' => $kecamatan,
            'persen' => $persen,
            'explain' => 'Menu yang berisi data semua desa yang akan dikunjungi, Terdapat Juga Fitur Tambah, Update, Hapus dan Export Ke berbagai
                            tipe file yang diinginkan'
        ]);
    }

    public function getPenduduk(Request $request)
    {
        $id = $request->id;
        $data = Desa::select(['desa.target_kunjungan', 'desa.id'])->where('desa.id', $id)->first();

        if ($data) {
            return json_encode([
                'kode' => 200,
                'pesan' => 'Data Desa Berhasil Ditemukan...!!',
                'data' => $data
            ]);
        } else {
            return json_encode([
                'kode' => 400,
                'pesan' => 'Data Desa Tidak Ditemukan...!!',
            ]);
        }
    }

    public function simpanTarget(Request $request)
    {
        $data = $request->all();
        $id = $request->id;

        unset($data['_token']);
        unset($data['id']);
        $ubah = Desa::where('id', $id)->update($data);

        if ($ubah) {
            return json_encode([
                'kode' => 200,
                'pesan' => 'Data Target Kunjungan Berhasil Disimpan...!!',
                'target' => $data['target_kunjungan']
            ]);
        } else {
            return json_encode([
                'kode' => 400,
                'pesan' => 'Data Target Kunjungan Gagal Disimpan...!!',
            ]);
        }
    }
}