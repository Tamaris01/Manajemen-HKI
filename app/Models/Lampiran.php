<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'lampiran';

    protected $fillable = [
        'hak_cipta_id',
        'ktp',
        'contoh_ciptaan_file',
        'contoh_ciptaan_link',
        'bukti_bayar',
        'surat_pernyataan',
        'bukti_pengalihan',
    ];

    public function hakCipta()
    {
        return $this->belongsTo(HakCipta::class);
    }
}
