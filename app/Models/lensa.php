<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lensa extends Model
{
    protected $table = 'lensas';

    protected $fillable = [
        'nama_lensa',
        'kategori',
        'material',
        'coating',
        'harga',
    ];
}
