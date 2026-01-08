<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aksesoris extends Model
{
    protected $table = 'aksesoris';

    protected $fillable = [
        'nama',
        'material',
        'keterangan',
        'supplier_id',
    ];
    public function supplier()
    {
        return $this->belongsTo(supplier::class);
    }
}
