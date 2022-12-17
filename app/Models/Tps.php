<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;
    protected $table = 'tps';
    protected $fillable = [
        'id_desa',
        'nama',
        'berkas_c1',
        'rekap_mandiri',
        'created_at',
        'updated_at'
    ];
    public $timestamp = TRUE;


    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id');
    }
}