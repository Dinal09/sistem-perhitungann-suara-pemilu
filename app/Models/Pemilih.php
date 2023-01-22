<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilih extends Model
{
    use HasFactory;
    protected $table = 'pemilih';
    protected $fillable = [
        'id_tps',
        'id_suara_abu',

        'nama',
        'no_kk',
        'no_nik',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'foto_ktp',
        'foto_kk',
        'foto',

        'is_kunjungan',
        'is_keluarga',
        'is_simpatisan',
        'is_pengkhianat',
        'is_daftar_hitam',

        'created_at',
        'updated_at',
        'created_by',

        'suara_abu_by',
        'kunjungan_by',
        'keluarga_by',
        'simpatisan_by',
        'pengkhianat_by',
        'daftar_hitam_by',

        'suara_abu_tgl',
        'kunjungan_tgl',
        'keluarga_tgl',
        'simpatisan_tgl',
        'pengkhianat_tgl',
        'daftar_hitam_tgl',
    ];
    public $timestamp = TRUE;

    private $jenisData = ['is_simpatisan', 'pengkhianat', 'is_daftar_hitam'];

    public function tps()
    {
        return $this->belongsTo(Tps::class, 'id_tps', 'id');
    }
    public function suaraAbu()
    {
        return $this->hasOne(SuaraAbu::class, 'id', 'id_suara_abu');
    }

    public static function getKeluarga()
    {
        return Pemilih::where(function ($query) {
            $query->where(['is_keluarga' => 'keluarga-mendukung'])
                ->orWhere(['is_keluarga' => 'keluarga-tidak']);
        })->get();
    }

    public static function getSimpatisan()
    {
        return Pemilih::where(['is_simpatisan' => 'iya'])->get();
    }

    public static function getPengkhianat()
    {
        return Pemilih::where(['is_pengkhianat' => 'iya'])->get();
    }

    public static function getDaftarHitam()
    {
        return Pemilih::where(['is_daftar_hitam' => 'iya'])->get();
    }

    public static function getSuaraAbu()
    {
        return Pemilih::select(['pemilih.*', 'suara_abu.deskripsi'])
            ->join('suara_abu', 'pemilih.id_suara_abu', '=', 'suara_abu.id')->get();
    }

    public static function getTotalDataUmum()
    {
        return Pemilih::count();
    }

    public static function getTotalKeluarga()
    {
        return Pemilih::where(function ($query) {
            $query->where(['is_keluarga' => 'keluarga-mendukung'])
                ->orWhere(['is_keluarga' => 'keluarga-tidak']);
        })->count();
    }

    public static function getTotalSimpatisan()
    {
        return Pemilih::where(['is_simpatisan' => 'iya'])->count();
    }

    public static function getTotalPengkhianat()
    {
        return Pemilih::where(['is_pengkhianat' => 'iya'])->count();
    }

    public static function getTotalDaftarHitam()
    {
        return Pemilih::where(['is_daftar_hitam' => 'iya'])->count();
    }

    public static function getTotalSuaraAbu()
    {
        return Pemilih::select(['pemilih.*', 'suara_abu.deskripsi'])
            ->join('suara_abu', 'pemilih.id_suara_abu', '=', 'suara_abu.id')->count();
    }

    public function getChartDataByDesa($idDesa)
    {
        $hasil = array();
        foreach ($this->jenisData as $j) {
            $hasil = Pemilih::where([
                $j => 'iya',
                'tps.id_desa' => $idDesa
            ])->join('tps', 'pemilih.id_tps', '=', 'tps.id')->count();
        }
    }
}