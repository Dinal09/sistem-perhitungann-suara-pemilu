<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemilihJenis extends Model
{
    use HasFactory;
    protected $table = 'pemilih_jenis';
    protected $fillable = [
        'deskripsi',
        'created_at',
        'updated_at'
    ];
    public $timestamp = TRUE;
}
