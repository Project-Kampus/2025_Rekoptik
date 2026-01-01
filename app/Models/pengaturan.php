<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengaturan extends Model
{
    protected $table = 'pengaturans';

    protected $fillable = [
        'nama_toko',
        'nama_aplikasi',
        'alamat',
        'no_hp',
        'telp',
        'email',
        'logo',
    ];
}
