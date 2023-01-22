<?php

namespace App\Http\Controllers;

use App\Models\Dapil;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pemilih;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $jenisData = ['is_simpatisan', 'pengkhianat', 'is_daftar_hitam'];
    public function index()
    {
        $data['total']['data-umum'] = Pemilih::getTotalDataUmum();
        $data['total']['keluarga'] = Pemilih::getTotalKeluarga();
        $data['total']['simpatisan'] = Pemilih::getTotalSimpatisan();
        $data['total']['pengkhianat'] = Pemilih::getTotalPengkhianat();
        $data['total']['daftar-hitam'] = Pemilih::getTotalDaftarHitam();
        $data['total']['abu-abu'] = Pemilih::getTotalSuaraAbu();


        return view('dashboard.index', [
            'data' => $data,
            'title' => 'Dashboard'
        ]);
    }

    public function index2()
    {
        $data['total']['data-umum'] = Pemilih::getTotalDataUmum();
        $data['total']['keluarga'] = Pemilih::getTotalKeluarga();
        $data['total']['simpatisan'] = Pemilih::getTotalSimpatisan();
        $data['total']['pengkhianat'] = Pemilih::getTotalPengkhianat();
        $data['total']['daftar-hitam'] = Pemilih::getTotalDaftarHitam();
        $data['total']['abu-abu'] = Pemilih::getTotalSuaraAbu();

        $dapil = Dapil::with('kecamatan')->get();
        $kecamatan = Dapil::with('kecamatan')->get();

        return view('dashboard.index2', [
            'data' => $data,
            'title' => 'Dashboard',
            'dapil' => $dapil,
            'kecamatan' => $kecamatan
        ]);
    }

    public function barChartData($dapil)
    {
        $hasil = array();
        $dapilNama = Dapil::select(['nama'])->where(['id' => $dapil])->get()->toArray();
        $camat = Kecamatan::select(['id', 'nama'])->where(['id_dapil' => $dapil])->get()->toArray();

        $idxA = 0;
        $idxB = 1;
        foreach ($camat as $cam) {
            $jmlSimpatisan = Pemilih::join('tps', 'pemilih.id_tps', '=', 'tps.id')
                ->join('desa', 'tps.id_desa', '=', 'desa.id')
                ->where(['id_kecamatan' => $cam['id'], 'is_simpatisan' => 'iya'])->count();

            $jmlPengkhianat = Pemilih::join('tps', 'pemilih.id_tps', '=', 'tps.id')
                ->join('desa', 'tps.id_desa', '=', 'desa.id')
                ->where(['id_kecamatan' => $cam['id'], 'is_pengkhianat' => 'iya'])->count();

            $jmlDaftarHitam = Pemilih::join('tps', 'pemilih.id_tps', '=', 'tps.id')
                ->join('desa', 'tps.id_desa', '=', 'desa.id')
                ->where(['id_kecamatan' => $cam['id'], 'is_daftar_hitam' => 'iya'])->count();

            $hasil[$idxA][] = [
                'y' => $cam['nama'],
                'a' => $jmlSimpatisan,
                'b' => $jmlPengkhianat,
                'c' => $jmlDaftarHitam
            ];

            $idxB++;
            if ($idxB == 8) {
                $idxA++;
                $idxB = 1;
            }
        }

        return json_encode([
            'kode' => 200,
            'pesan' => 'Data Berhasil Didapatkan',
            'data' => $hasil,
            'nama' => $dapilNama[0]['nama']
        ]);
    }

    public function dataKunjunganPerKecamatan($id)
    {
        $hasil = array();
        $kecNama = Kecamatan::select(['nama'])->where(['id' => $id])->get()->toArray();

        $totalPemilih = Desa::where(['id_kecamatan' => $id])->sum('jumlah_penduduk');
        $totalTarget = Desa::where(['id_kecamatan' => $id])->sum('target_kunjungan');
        $totalKunjungan = Pemilih::join('tps', 'pemilih.id_tps', '=', 'tps.id')
            ->join('desa', 'tps.id_desa', '=', 'desa.id')
            ->where(['id_kecamatan' => $id, 'is_kunjungan' => 'sudah'])->count();

        $totalBelumKunjungan = $totalTarget - $totalKunjungan;

        $hasil['donut'] = [
            ['label' => 'Sudah Dikunjungi', 'value' => $totalKunjungan],
            ['label' => 'Belum Dikunjungi', 'value' => $totalBelumKunjungan]
        ];

        $desa = Desa::select(['id', 'nama', 'target_kunjungan'])->where(['id_kecamatan' => $id])->get()->toArray();

        foreach ($desa as $des) {
            $kunjungan = Pemilih::join('tps', 'pemilih.id_tps', '=', 'tps.id')
                ->where(['id_desa' => $des['id'], 'is_kunjungan' => 'sudah'])->count();

            $hasil['stacked'][] = [
                'y' => $des['nama'],
                'a' => $kunjungan,
                'b' => $des['target_kunjungan'] - $kunjungan
            ];
        }

        return json_encode([
            'kode' => 200,
            'pesan' => 'Data Berhasil Didapatkan',
            'data' => $hasil,
            'nama' => $kecNama[0]['nama'],
            'total_target' => $totalTarget,
            'total_pemilih' => $totalPemilih
        ]);
    }
}