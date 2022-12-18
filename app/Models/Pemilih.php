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


    public function tps()
    {
        return $this->belongsTo(Tps::class, 'id_tps', 'id');
    }
    public function suaraAbu()
    {
        return $this->hasOne(SuaraAbu::class, 'id', 'id_suara_abu');
    }
}