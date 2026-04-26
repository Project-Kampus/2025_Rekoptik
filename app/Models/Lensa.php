<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lensa extends Model
{
    protected $table = 'lensas';

    protected $fillable = [
        'supplier_id',
        'nama_lensa',
        'kategori',
        'material',
        'coating',
        'od',
        'os',
        'harga',
        'modal',
    ];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
