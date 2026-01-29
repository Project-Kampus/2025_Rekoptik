<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
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
        return $this->hasMany(Lensa::class);
    }
}
