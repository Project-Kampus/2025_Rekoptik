<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'nama',
        'kontak',
        'alamat',
    ];

    public function frames()
    {
        return $this->hasMany(Frame::class);
    }

    public function lensas()
    {
        return $this->hasMany(lensa::class);
    }
}
