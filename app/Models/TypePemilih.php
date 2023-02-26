<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePemilih extends Model
{
    use HasFactory;
    protected $table = 'type_pemilih';
    protected $fillable = [
        'id_pemilih',
        'id_pemilih_jenis',
        'id_suara_abu',
        'id_tim_sukses',
        'id_keluarga',
        'id_saksi',
        'id_tps',
        'id_desa',
        'id_kecamatan',
        'id_kabupaten',
        'created_at',
        'created_by',
        'updated_at'
    ];
    public $timestamp = TRUE;

    public function pemilih()
    {
        return $this->belongsTo(Pemilih::class, 'id_pemilih', 'id_jenis');
    }
    public function jenisPemilih()
    {
        return $this->hasOne(PemilihJenis::class, 'id_jenis', 'id_pemilih_jenis');
    }
    public function suaraAbu()
    {
        return $this->hasOne(SuaraAbu::class, 'id', 'id_suara_abu');
    }
    public function timSukses()
    {
        return $this->hasOne(TimSuksesJenis::class, 'id', 'id_tim_sukses');
    }
    public function keluarga()
    {
        return $this->hasOne(JenisKeluarga::class, 'id', 'id_keluarga');
    }
    public function saksi()
    {
        return $this->hasOne(jenisPemilih::class, 'id', 'id_saksi');
    }
    public function tps()
    {
        return $this->hasOne(jenisPemilih::class, 'id', 'id_tps');
    }
    public function desa()
    {
        return $this->hasOne(jenisPemilih::class, 'id', 'id_desa');
    }
    public function kecamatan()
    {
        return $this->hasOne(jenisPemilih::class, 'id', 'id_kecamatan');
    }
    public function kabupaten()
    {
        return $this->hasOne(jenisPemilih::class, 'id', 'id_kabupaten');
    }
}
