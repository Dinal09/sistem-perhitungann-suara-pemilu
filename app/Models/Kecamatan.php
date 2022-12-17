<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';
    protected $fillable = [
        'id_dapil',
        'nama',
        'created_at',
        'updated_at'
    ];
    public $timestamp = TRUE;


    public function dapil()
    {
        return $this->belongsTo(Dapil::class, 'id_dapil', 'id');
    }
    public function desa()
    {
        return $this->hasMany(Desa::class, 'id_kecamatan', 'id');
    }
}