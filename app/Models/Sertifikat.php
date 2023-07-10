<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'sertifikat';

    protected $fillable = [
        'hak_cipta_id',
        'link_sertifikat',
    ];

    public function hakCipta()
    {
        return $this->belongsTo(HakCipta::class);
    }
}
