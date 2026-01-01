<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lensa extends Model
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
    ];
    public function supplier()
    {
        return $this->belongsTo(supplier::class);
    }
}
