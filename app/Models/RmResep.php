<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmResep extends Model
{
    use HasFactory;

    protected $table = 'rm_resep';

    protected $fillable = [
        'pemeriksaan_id',
        'resep_dari',

        'od_sferis',
        'od_silindris',
        'od_axis',
        'od_add_lensa',
        'pd_od',

        'os_sferis',
        'os_silindris',
        'os_axis',
        'os_add_lensa',
        'pd_os',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(RmPemeriksaan::class, 'pemeriksaan_id');
    }
}
