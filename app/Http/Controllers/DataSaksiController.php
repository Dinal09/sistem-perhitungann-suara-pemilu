<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\JenisSaksi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Pemilih;
use App\Models\Tps;
use App\Models\TypePemilih;
use Illuminate\Http\Request;

class DataSaksiController extends Controller
{
    public $title = 'Data Saksi';
    public $link = 'data-saksi';

    public function kabupaten($id, $jenis)
    {
        $pemilih = array();
        $tingkat = 'kabupaten';
        if ($id == 'all') {
            $data = Pemilih::getAllSaksi($tingkat, $jenis);
        } else {
            $data = Pemilih::getSaksiByTingkat($id, $tingkat, $jenis);
            $dataKabupaten = Kabupaten::find(['id' => $id])->toArray();
            $pemilih = Pemilih::getPemilihForSaksiByTingkat($id, $tingkat);
        }
        // dd($pemilih);
        $kabupaten = Kabupaten::get();
        $saksi = JenisSaksi::get()->toArray();
        $params = [
            'id' => $id,
            'jenis' => $jenis
        ];

        return view('pemilih.' . $this->link, [
            'title' => $this->title . (isset($dataKabupaten[0]) ? ' Tingkat Kabupaten ' . $dataKabupaten[0]['nama'] : ''),
            'explain' => 'Menu yang berisi data pemilih yang dikategorikan sebagai Saksi, Terdapat Juga Fitur Tambah, Update dan Hapus',
            'link' => $this->link,
            'dataFilter' => $kabupaten,
            'params' => $params,
            'data' => $data,
            'pemilih' => $pemilih,
            'saksi' => $saksi,
            'tingkat' => $tingkat
        ]);
    }

    public function kecamatan($id, $jenis)
    {
        $pemilih = array();
        $tingkat = 'kecamatan';
        if ($id == 'all') {
            $data = Pemilih::getAllSaksi($tingkat, $jenis);
        } else {
            $data = Pemilih::getSaksiByTingkat($id, $tingkat, $jenis);
            $dataKecamatan = Kecamatan::find(['id' => $id])->toArray();
            $pemilih = Pemilih::getPemilihForSaksiByTingkat($id, $tingkat);
        }
        // dd($pemilih);
        $kecamatan = Kecamatan::get();
        $saksi = JenisSaksi::get()->toArray();
        $params = [
            'id' => $id,
            'jenis' => $jenis
        ];

        return view('pemilih.' . $this->link, [
            'title' => $this->title . (isset($dataKecamatan[0]) ? ' Tingkat Kecamatan ' . $dataKecamatan[0]['nama'] : ''),
            'explain' => 'Menu yang berisi data pemilih yang dikategorikan sebagai Saksi, Terdapat Juga Fitur Tambah, Update dan Hapus',
            'link' => $this->link,
            'dataFilter' => $kecamatan,
            'params' => $params,
            'data' => $data,
            'pemilih' => $pemilih,
            'saksi' => $saksi,
            'tingkat' => $tingkat
        ]);
    }

    public function desa($id, $jenis)
    {
        $pemilih = array();
        $tingkat = 'desa';
        if ($id == 'all') {
            $data = Pemilih::getAllSaksi($tingkat, $jenis);
        } else {
            $data = Pemilih::getSaksiByTingkat($id, $tingkat, $jenis);
            $dataDesa = Desa::find(['id' => $id])->toArray();
            $pemilih = Pemilih::getPemilihForSaksiByTingkat($id, $tingkat);
        }
        // dd($pemilih);
        $desa = Desa::get();
        $saksi = JenisSaksi::get()->toArray();
        $params = [
            'id' => $id,
            'jenis' => $jenis
        ];

        return view('pemilih.' . $this->link, [
            'title' => $this->title . (isset($dataDesa[0]) ? ' Tingkat Desa ' . $dataDesa[0]['nama'] : ''),
            'explain' => 'Menu yang berisi data pemilih yang dikategorikan sebagai Saksi, Terdapat Juga Fitur Tambah, Update dan Hapus',
            'link' => $this->link,
            'dataFilter' => $desa,
            'params' => $params,
            'data' => $data,
            'pemilih' => $pemilih,
            'saksi' => $saksi,
            'tingkat' => $tingkat
        ]);
    }

    public function tps($id, $jenis)
    {
        $pemilih = array();
        $tingkat = 'tps';
        if ($id == 'all') {
            $data = Pemilih::getAllSaksi($tingkat, $jenis);
        } else {
            $data = Pemilih::getSaksiByTingkat($id, $tingkat, $jenis);
            $dataTps = Tps::with('desa')->where(['tps.id' => $id])->get()->toArray();
            $pemilih = Pemilih::getPemilihForSaksiByTingkat($id, $tingkat);
        }
        $desa = desa::with('tps')->get();
        $saksi = JenisSaksi::get()->toArray();
        $params = [
            'id' => $id,
            'jenis' => $jenis
        ];

        return view('pemilih.' . $this->link, [
            'title' => $this->title . (isset($dataTps[0]) ? ' Tingkat Tps, Desa ' . $dataTps[0]['desa']['nama'] . ' (' . $dataTps[0]['nama'] . ')' : ''),
            'explain' => 'Menu yang berisi data pemilih yang dikategorikan sebagai Saksi, Terdapat Juga Fitur Tambah, Update dan Hapus',
            'link' => $this->link,
            'dataFilter' => $desa,
            'params' => $params,
            'data' => $data,
            'pemilih' => $pemilih,
            'saksi' => $saksi,
            'tingkat' => $tingkat
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id_pemilih;
        $jenis = $request->id_jenis;
        $id_tingkat = $request->id_tingkat;
        $tingkat = $request->tingkat;

        $data = [
            'id_pemilih' => $id,
            'id_pemilih_jenis' => 7,
            'id_saksi' => $jenis,
        ];
        switch ($tingkat) {
            case 'kabupaten':
                $data['id_kabupaten'] = $id_tingkat;
                break;
            case 'kecamatan':
                $data['id_kecamatan'] = $id_tingkat;
                break;
            case 'desa':
                $data['id_desa'] = $id_tingkat;
                break;
            case 'tps':
                $data['id_tps'] = $id_tingkat;
                break;
        }

        TypePemilih::insert($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan!!');
    }

    public function delete($id)
    {
        TypePemilih::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus!!');
    }
}
