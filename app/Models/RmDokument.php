<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmDokument extends Model
{
    use HasFactory;

    protected $table = 'rm_dokument';

    protected $fillable = [
        'dokumens_id',
        'pemeriksaan_id',
        'url',
    ];

    public function dokumen()
    {
        return $this->belongsTo(Document::class, 'dokumens_id');
    }

    public function pemeriksaan()
    {
        return $this->belongsTo(RmPemeriksaan::class, 'pemeriksaan_id');
    }
}
