<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSaksi extends Model
{
    use HasFactory;
    protected $table = 'jenis_saksi';
    protected $fillable = [
        'deskripsi',
        'created_at',
        'updated_at'
    ];
    public $timestamp = TRUE;

    public function typePemilih()
    {
        return $this->belongsTo(TypePemilih::class, 'id_saksi', 'id');
    }
}
