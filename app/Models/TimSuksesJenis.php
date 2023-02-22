<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimSuksesJenis extends Model
{
    use HasFactory;
    protected $table = 'tim_sukses_jenis';
    protected $fillable = [
        'deskripsi',
        'created_at',
        'updated_at'
    ];
    public $timestamp = TRUE;
}
