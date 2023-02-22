<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pemilih;
use App\Models\Tps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataUmumController extends Controller
{
    public $title = 'Data Umum';
    public $link = 'data-umum';

    public function index($id)
    {
        if ($id == 'all') {
            $data = Pemilih::with('desa', 'tps', 'suaraAbu')->get();
            $dataDesa = null;
            $tps = array();
        } else {
            $data = Pemilih::with('desa', 'tps', 'suaraAbu')->where(['pemilih.id_desa' => $id])->get();
            $dataDesa = Desa::find(['id' => $id])->toArray();
            $tps = Tps::where(['id_desa' => $id])->get();
        }

        $selectDesa = Kecamatan::with('desa')->get();

        return view('pemilih.' . $this->link, [
            'data' => $data,
            'title' => $this->title . (isset($dataDesa[0]) ? ' Desa ' . $dataDesa[0]['nama'] : ''),
            'link' => $this->link,
            'tps' => $tps,
            'selectDesa' => $selectDesa,
            'dataDesa' => $dataDesa,
            'filter_id' => $id,
            'explain' => 'Menu yang berisi data semua pemilih yang memiliki hak suara, Terdapat Juga Fitur Tambah, Update, Hapus dan Export Ke berbagai
                            tipe file yang diinginkan'
        ]);
    }

    public function getById(Request $request)
    {
        $id = $request->id;
        $data = Pemilih::with('tps.desa.kecamatan.dapil')->find($id);

        if ($data) {
            return json_encode([
                'kode' => 200,
                'pesan' => 'Data ' . $this->title . ' Berhasil Ditemukan...!!',
                'data' => $data
            ]);
        } else {
            return json_encode([
                'kode' => 400,
                'pesan' => 'Data ' . $this->title . ' Tidak Ditemukan...!!',
            ]);
        }
    }


    public function getDataById(Request $request)
    {
        $id = $request->id;
        $data = Pemilih::with('tps.desa.kecamatan.dapil')->find($id);

        if ($data) {
            return json_encode([
                'kode' => 200,
                'pesan' => 'Data ' . $this->title . ' Berhasil Ditemukan...!!',
                'data' => $data,
                'foto' => asset('storage/data-aplikasi/foto-pemilih/' . $data->foto)
            ]);
        } else {
            return json_encode([
                'kode' => 400,
                'pesan' => 'Data ' . $this->title . ' Tidak Ditemukan...!!',
            ]);
        }
    }

    public function getFotoById(Request $request)
    {
        $id = $request->id;
        $data = Pemilih::with('tps.desa.kecamatan.dapil')->find($id);

        if ($request->jenis == 'ktp') {
            $foto = asset('storage/data-aplikasi/foto-ktp/' . $data->foto_ktp);
        } else if ($request->jenis == 'kk') {
            $foto = asset('storage/data-aplikasi/foto-kk/' . $data->foto_kk);
        }

        if ($data) {
            return json_encode([
                'kode' => 200,
                'pesan' => 'Data ' . $this->title . ' Berhasil Ditemukan...!!',
                'foto' => $foto
            ]);
        } else {
            return json_encode([
                'kode' => 400,
                'pesan' => 'Data ' . $this->title . ' Tidak Ditemukan...!!',
            ]);
        }
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => 'image|mimes:jpg,png,jpeg,svg|max:2048',
            'foto_ktp' => 'image|mimes:jpg,png,jpeg,svg|max:2048',
            'foto_kk' => 'image|mimes:jpg,png,jpeg,svg|max:2048',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors()->first());
        }

        $data = $request->all();
        if (isset($data['foto'])) {
            $simpanFoto = $request->file('foto')->store('/public/data-aplikasi/foto-pemilih');
            $linkFoto = explode('/', $simpanFoto);
            $data['foto'] = $linkFoto[3];

            if (!$simpanFoto) {
                return redirect()->back()->with('error', $this->title . ' Gagal Disimpan');
            }
        }
        if (isset($data['foto_ktp'])) {
            $simpanFotoKtp = $request->file('foto_ktp')->store('/public/data-aplikasi/foto-ktp');
            $linkFotoKtp = explode('/', $simpanFotoKtp);
            $data['foto_ktp'] = $linkFotoKtp[3];

            if (!$simpanFotoKtp) {
                return redirect()->back()->with('error', $this->title . ' Gagal Disimpan');
            }
        }
        if (isset($data['foto_kk'])) {
            $simpanFotoKK = $request->file('foto_kk')->store('/public/data-aplikasi/foto-kk');
            $linkFotoKK = explode('/', $simpanFotoKK);
            $data['foto_kk'] = $linkFotoKK[3];

            if (!$simpanFotoKK) {
                return redirect()->back()->with('error', $this->title . ' Gagal Disimpan');
            }
        }
        if (isset($data['is_kunjungan'])) {
            $data['is_kunjungan'] = 'sudah';
        }
        unset($data['_token']);

        Pemilih::create($data);

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Ditambahkan...!!');
    }

    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'no_nik' => 'unique:pemilih',
            'foto' => 'image|mimes:jpg,png,jpeg,svg|max:2048',
            'foto_ktp' => 'image|mimes:jpg,png,jpeg,svg|max:2048',
            'foto_kk' => 'image|mimes:jpg,png,jpeg,svg|max:2048',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors()->first());
        }

        $data = $request->all();

        $id = $request->id;
        if (isset($request->foto)) {
            $simpanFoto = $request->file('foto')->store('/public/data-aplikasi/foto-pemilih');
            $linkFoto = explode('/', $simpanFoto);
            $data['foto'] = $linkFoto[3];
        }
        if (isset($request->foto_ktp)) {
            $simpanFotoKtp = $request->file('foto_ktp')->store('/public/data-aplikasi/foto-ktp');
            $linkFotoKtp = explode('/', $simpanFotoKtp);
            $data['foto_ktp'] = $linkFotoKtp[3];
        }
        if (isset($request->foto_kk)) {
            $simpanFotoKK = $request->file('foto_kk')->store('/public/data-aplikasi/foto-kk');
            $linkFotoKK = explode('/', $simpanFotoKK);
            $data['foto'] = $linkFotoKK[3];
        }
        if (isset($request->id_tps)) {
            $cek = Pemilih::find($request->id)->get()->toArray();

            if (!is_null($cek[0]['id_tps'])) {
                $desa1 = Tps::select(['tps.id_desa', 'desa.jumlah_penduduk'])->leftJoin('desa', 'tps.id_desa', '=', 'desa.id')
                    ->where('tps.id', $cek[0]['id_tps'])->get()->toArray();
                $ubahJumlah = ['jumlah_penduduk' => ($desa1[0]['jumlah_penduduk'] - 1)];
                Desa::where('id', $desa1[0]['id_desa'])->update($ubahJumlah);
            }
            $desa2 = Tps::select(['tps.id_desa', 'desa.jumlah_penduduk'])->leftJoin('desa', 'tps.id_desa', '=', 'desa.id')
                ->where('tps.id', $request->id_tps)->get()->toArray();
            $ubahJumlah = ['jumlah_penduduk' => ($desa2[0]['jumlah_penduduk'] + 1)];
            Desa::where('id', $desa2[0]['id_desa'])->update($ubahJumlah);
        }
        if (isset($data['is_kunjungan'])) {
            $data['is_kunjungan'] = 'sudah';
        }

        unset($data['_token']);
        unset($data['id']);
        Pemilih::where('id', $id)->update($data);

        return redirect()->back()->with('sukses', ' Berhasil Diubah...!!');
    }

    public function delete($id)
    {
        Pemilih::where('id', $id)->delete();

        return redirect()->back()->with('sukses', $this->title . ' Berhasil Dihapus...!!');
    }
}