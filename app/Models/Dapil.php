<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dapil extends Model
{
    use HasFactory;
    protected $table = 'dapil';
    protected $fillable = [
        'nama',
        'created_at',
        'updated_at'
    ];
    public $timestamp = TRUE;


    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class, 'id_dapil', 'id')->orderBy('nama');
    }
}
