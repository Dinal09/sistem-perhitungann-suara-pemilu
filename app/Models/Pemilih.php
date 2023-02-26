<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pemilih extends Model
{
    use HasFactory;
    protected $table = 'pemilih';
    protected $fillable = [
        'id_tps',
        'id_suara_abu',
        'id_desa',

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

        'created_at',
        'updated_at',
        'created_by',

        'kunjungan_by',
        'kunjungan_tgl',
    ];
    public $timestamp = TRUE;

    public function tps()
    {
        return $this->belongsTo(Tps::class, 'id_tps', 'id');
    }
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id');
    }
    public function typePemilih()
    {
        return $this->hasMany(typePemilih::class, 'id_pemilih', 'id');
    }

    public static function getAllKeluarga($jenis)
    {
        $query = self::select(['pemilih.id', 'pemilih.nama', 'pemilih.no_nik', 'pemilih.alamat', 'pemilih.no_hp', 'jenis_keluarga.deskripsi', 'type_pemilih.id AS type_id'])
            ->join('type_pemilih', 'type_pemilih.id_pemilih', '=', 'pemilih.id')
            ->join('jenis_keluarga', 'jenis_keluarga.id', '=', 'type_pemilih.id_keluarga')
            ->whereNotNull('type_pemilih.id_keluarga');

        if ($jenis != 'all') {
            $query->where(['type_pemilih.id_keluarga' => $jenis]);
        }
        return $query->get()->toArray();
    }
    public static function getKeluargaByDesa($idDesa, $jenis)
    {
        $query = self::select(['pemilih.id', 'pemilih.nama', 'pemilih.no_nik', 'pemilih.alamat', 'pemilih.no_hp', 'jenis_keluarga.deskripsi', 'type_pemilih.id AS type_id'])
            ->join('type_pemilih', 'type_pemilih.id_pemilih', '=', 'pemilih.id')
            ->join('jenis_keluarga', 'jenis_keluarga.id', '=', 'type_pemilih.id_keluarga')
            ->whereNotNull('type_pemilih.id_keluarga')
            ->where(['pemilih.id_desa' => $idDesa]);

        if ($jenis != 'all') {
            $query->where(['type_pemilih.id_keluarga' => $jenis]);
        }
        return $query->get()->toArray();
    }
    public static function getPemilihExpeptKeluargaByDesa($idDesa)
    {
        return self::select(['pemilih.id', 'pemilih.nama AS pemilih_nama'])
            ->with(['typePemilih' => function ($q) {
                $q->select(['id_pemilih', 'id_pemilih_jenis', 'id_keluarga'])->with(['jenisPemilih' => function ($q) {
                    $q->select(['id_jenis', 'deskripsi']);
                }]);
            }])
            ->where(function ($q) {
                $q->doesntHave('typePemilih');
                $q->orWhere(function ($q) {
                    $q->whereHas('typePemilih', function ($q) {
                        $q->whereNull('id_keluarga');
                    });
                });
            })
            ->where(['pemilih.id_desa' => $idDesa])
            ->orderBy('pemilih.nama')
            ->get()->toArray();
    }

    public static function getAllSimpatisan()
    {
        return self::select(['pemilih.id', 'pemilih.nama', 'pemilih.no_nik', 'pemilih.alamat', 'pemilih.no_hp', 'type_pemilih.id AS type_id'])
            ->join('type_pemilih', 'type_pemilih.id_pemilih', '=', 'pemilih.id')
            ->where(['type_pemilih.id_pemilih_jenis' => 4])
            ->get()->toArray();
    }
    public static function getSimpatisanByDesa($idDesa)
    {
        return self::select(['pemilih.id', 'pemilih.nama', 'pemilih.no_nik', 'pemilih.alamat', 'pemilih.no_hp', 'type_pemilih.id AS type_id'])
            ->join('type_pemilih', 'type_pemilih.id_pemilih', '=', 'pemilih.id')
            ->where(['type_pemilih.id_pemilih_jenis' => 4])
            ->where(['pemilih.id_desa' => $idDesa])
            ->get()->toArray();
    }
    public static function getPemilihExpeptSimpatisanByDesa($idDesa)
    {
        return self::select(['pemilih.id', 'pemilih.nama AS pemilih_nama'])
            ->with(['typePemilih' => function ($q) {
                $q->select(['id_pemilih', 'id_pemilih_jenis', 'id_keluarga'])->with(['jenisPemilih' => function ($q) {
                    $q->select(['id_jenis', 'deskripsi']);
                }]);
            }])
            ->where(function ($q) {
                $q->doesntHave('typePemilih');
                $q->orWhere(function ($q) {
                    $q->whereHas('typePemilih', function ($q) {
                        $q->where('type_pemilih.id_pemilih_jenis', '!=', 4);
                    });
                });
            })
            ->where(['pemilih.id_desa' => $idDesa])
            ->orderBy('pemilih.nama')
            ->get()->toArray();
    }

    public static function getAllSuaraAbu($jenis)
    {
        $query = self::select(['pemilih.id', 'pemilih.nama', 'pemilih.no_nik', 'pemilih.alamat', 'pemilih.no_hp', 'suara_abu.deskripsi', 'type_pemilih.id AS type_id'])
            ->join('type_pemilih', 'type_pemilih.id_pemilih', '=', 'pemilih.id')
            ->join('suara_abu', 'suara_abu.id', '=', 'type_pemilih.id_suara_abu')
            ->where(['type_pemilih.id_pemilih_jenis' => 5]);

        if ($jenis != 'all') {
            $query->where(['suara_abu.id' => $jenis]);
        }
        return $query->get()->toArray();
    }
    public static function getSuaraAbuByDesa($idDesa, $jenis)
    {
        $query = self::select(['pemilih.id', 'pemilih.nama', 'pemilih.no_nik', 'pemilih.alamat', 'pemilih.no_hp', 'suara_abu.deskripsi', 'type_pemilih.id AS type_id'])
            ->join('type_pemilih', 'type_pemilih.id_pemilih', '=', 'pemilih.id')
            ->join('suara_abu', 'suara_abu.id', '=', 'type_pemilih.id_suara_abu')
            ->where(['type_pemilih.id_pemilih_jenis' => 5])
            ->where(['pemilih.id_desa' => $idDesa]);

        if ($jenis != 'all') {
            $query->where(['suara_abu.id' => $jenis]);
        }
        return $query->get()->toArray();
    }
    public static function getPemilihExpeptSuaraAbuByDesa($idDesa)
    {
        return self::select(['pemilih.id', 'pemilih.nama AS pemilih_nama'])
            ->with(['typePemilih' => function ($q) {
                $q->select(['id_pemilih', 'id_pemilih_jenis', 'id_keluarga'])->with(['jenisPemilih' => function ($q) {
                    $q->select(['id_jenis', 'deskripsi']);
                }]);
            }])
            ->where(function ($q) {
                $q->doesntHave('typePemilih');
                $q->orWhere(function ($q) {
                    $q->whereHas('typePemilih', function ($q) {
                        $q->where('type_pemilih.id_pemilih_jenis', '!=', 5);
                    });
                });
            })
            ->where(['pemilih.id_desa' => $idDesa])
            ->orderBy('pemilih.nama')
            ->get()->toArray();
    }

    public static function getAllTimSukses($tingkat, $jenis)
    {
        $query = self::select(['pemilih.id', 'pemilih.nama', 'pemilih.no_nik', 'pemilih.alamat', 'pemilih.no_hp', 'tim_sukses_jenis.deskripsi', 'type_pemilih.id AS type_id'])
            ->join('type_pemilih', 'type_pemilih.id_pemilih', '=', 'pemilih.id')
            ->join('tim_sukses_jenis', 'tim_sukses_jenis.id', '=', 'type_pemilih.id_tim_sukses')
            ->where(['type_pemilih.id_pemilih_jenis' => 6]);

        switch ($tingkat) {
            case 'kabupaten':
                $query->whereNotNull('type_pemilih.id_kabupaten');
                break;
            case 'kecamatan':
                $query->whereNotNull('type_pemilih.id_kecamatan');
                break;
            case 'desa':
                $query->whereNotNull('type_pemilih.id_desa');
                break;
            case 'tps':
                $query->whereNotNull('type_pemilih.id_tps');
                break;
        }

        if ($jenis != 'all') {
            $query->where(['tim_sukses_jenis.id' => $jenis]);
        }
        return $query->get()->toArray();
    }
    public static function getTimSuksesByTingkat($idDesa, $tingkat, $jenis)
    {
        $query = self::select(['pemilih.id', 'pemilih.nama', 'pemilih.no_nik', 'pemilih.alamat', 'pemilih.no_hp', 'tim_sukses_jenis.deskripsi', 'type_pemilih.id AS type_id'])
            ->leftJoin('desa', 'desa.id', '=', 'pemilih.id_desa')
            ->leftJoin('kecamatan', 'kecamatan.id', '=', 'desa.id_kecamatan')
            ->join('type_pemilih', 'type_pemilih.id_pemilih', '=', 'pemilih.id')
            ->join('tim_sukses_jenis', 'tim_sukses_jenis.id', '=', 'type_pemilih.id_tim_sukses')
            ->where(['type_pemilih.id_pemilih_jenis' => 6]);

        switch ($tingkat) {
            case 'kabupaten':
                $query->whereNotNull('type_pemilih.id_kabupaten')
                    ->where(['kecamatan.id_kabupaten' => $idDesa]);
                break;
            case 'kecamatan':
                $query->whereNotNull('type_pemilih.id_kecamatan')
                    ->where(['desa.id_kecamatan' => $idDesa]);
                break;
            case 'desa':
                $query->whereNotNull('type_pemilih.id_desa')
                    ->where(['pemilih.id_desa' => $idDesa]);
                break;
            case 'tps':
                $query->whereNotNull('type_pemilih.id_tps')
                    ->where(['pemilih.id_tps' => $idDesa]);
                break;
        }

        if ($jenis != 'all') {
            $query->where(['tim_sukses_jenis.id' => $jenis]);
        }
        return $query->get()->toArray();
    }
    public static function getPemilihForTimSuksesByTingkat($id, $tingkat)
    {
        $query = self::select([
            'pemilih.id',
            'pemilih.nama AS pemilih_nama',
            'desa.nama AS desa_nama',
        ])
            ->leftJoin('desa', 'desa.id', '=', 'pemilih.id_desa')
            ->leftJoin('kecamatan', 'kecamatan.id', '=', 'desa.id_kecamatan')
            ->with(['typePemilih' => function ($q) {
                $q->select([
                    'id_pemilih',
                    'id_pemilih_jenis',
                    DB::raw("(
                        CASE
                            WHEN id_kabupaten IS NOT NULL THEN 'Kabupaten'
                            WHEN id_kecamatan IS NOT NULL THEN 'Kecamatan'
                            WHEN id_desa IS NOT NULL THEN 'Desa'
                            WHEN id_tps IS NOT NULL THEN 'Tps'
                            ELSE '-'
                    END) AS tingkat")
                ])->with(['jenisPemilih' => function ($q) {
                    $q->select(['id_jenis', 'deskripsi']);
                }]);
            }]);

        switch ($tingkat) {
            case 'kabupaten':
                $query->where(['kecamatan.id_kabupaten' => $id]);
                break;
            case 'kecamatan':
                $query->where(['desa.id_kecamatan' => $id]);
                break;
            case 'desa':
                $query->where(['pemilih.id_desa' => $id]);
                break;
            case 'tps':
                $query->where(['pemilih.id_tps' => $id]);
                break;
        }

        return $query->orderBy('pemilih.nama')->get()->toArray();
    }

    public static function getAllSaksi($tingkat, $jenis)
    {
        $query = self::select(['pemilih.id', 'pemilih.nama', 'pemilih.no_nik', 'pemilih.alamat', 'pemilih.no_hp', 'jenis_saksi.deskripsi', 'type_pemilih.id AS type_id'])
            ->join('type_pemilih', 'type_pemilih.id_pemilih', '=', 'pemilih.id')
            ->join('jenis_saksi', 'jenis_saksi.id', '=', 'type_pemilih.id_saksi')
            ->where(['type_pemilih.id_pemilih_jenis' => 7]);

        switch ($tingkat) {
            case 'kabupaten':
                $query->whereNotNull('type_pemilih.id_kabupaten');
                break;
            case 'kecamatan':
                $query->whereNotNull('type_pemilih.id_kecamatan');
                break;
            case 'desa':
                $query->whereNotNull('type_pemilih.id_desa');
                break;
            case 'tps':
                $query->whereNotNull('type_pemilih.id_tps');
                break;
        }

        if ($jenis != 'all') {
            $query->where(['jenis_saksi.id' => $jenis]);
        }
        return $query->get()->toArray();
    }
    public static function getSaksiByTingkat($idDesa, $tingkat, $jenis)
    {
        $query = self::select(['pemilih.id', 'pemilih.nama', 'pemilih.no_nik', 'pemilih.alamat', 'pemilih.no_hp', 'jenis_saksi.deskripsi', 'type_pemilih.id AS type_id'])
            ->leftJoin('desa', 'desa.id', '=', 'pemilih.id_desa')
            ->leftJoin('kecamatan', 'kecamatan.id', '=', 'desa.id_kecamatan')
            ->join('type_pemilih', 'type_pemilih.id_pemilih', '=', 'pemilih.id')
            ->join('jenis_saksi', 'jenis_saksi.id', '=', 'type_pemilih.id_saksi')
            ->where(['type_pemilih.id_pemilih_jenis' => 7]);

        switch ($tingkat) {
            case 'kabupaten':
                $query->whereNotNull('type_pemilih.id_kabupaten')
                    ->where(['kecamatan.id_kabupaten' => $idDesa]);
                break;
            case 'kecamatan':
                $query->whereNotNull('type_pemilih.id_kecamatan')
                    ->where(['desa.id_kecamatan' => $idDesa]);
                break;
            case 'desa':
                $query->whereNotNull('type_pemilih.id_desa')
                    ->where(['pemilih.id_desa' => $idDesa]);
                break;
            case 'tps':
                $query->whereNotNull('type_pemilih.id_tps')
                    ->where(['pemilih.id_tps' => $idDesa]);
                break;
        }

        if ($jenis != 'all') {
            $query->where(['jenis_saksi.id' => $jenis]);
        }
        return $query->get()->toArray();
    }
    public static function getPemilihForSaksiByTingkat($id, $tingkat)
    {
        $query = self::select([
            'pemilih.id',
            'pemilih.nama AS pemilih_nama',
            'desa.nama AS desa_nama',
        ])
            ->leftJoin('desa', 'desa.id', '=', 'pemilih.id_desa')
            ->leftJoin('kecamatan', 'kecamatan.id', '=', 'desa.id_kecamatan')
            ->with(['typePemilih' => function ($q) {
                $q->select([
                    'id_pemilih',
                    'id_pemilih_jenis',
                    DB::raw("(
                        CASE
                            WHEN id_kabupaten IS NOT NULL THEN 'Kabupaten'
                            WHEN id_kecamatan IS NOT NULL THEN 'Kecamatan'
                            WHEN id_desa IS NOT NULL THEN 'Desa'
                            WHEN id_tps IS NOT NULL THEN 'Tps'
                            ELSE '-'
                    END) AS tingkat")
                ])->with(['jenisPemilih' => function ($q) {
                    $q->select(['id_jenis', 'deskripsi']);
                }]);
            }]);

        switch ($tingkat) {
            case 'kabupaten':
                $query->where(['kecamatan.id_kabupaten' => $id]);
                break;
            case 'kecamatan':
                $query->where(['desa.id_kecamatan' => $id]);
                break;
            case 'desa':
                $query->where(['pemilih.id_desa' => $id]);
                break;
            case 'tps':
                $query->where(['pemilih.id_tps' => $id]);
                break;
        }

        return $query->orderBy('pemilih.nama')->get()->toArray();
    }
}
