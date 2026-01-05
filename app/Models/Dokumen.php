<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumens';

    protected $fillable = [
        'nama',
        'keterangan',
    ];

    public function rmDokumens()
    {
        return $this->hasMany(RmDokument::class, 'dokumens_id');
    }
}
