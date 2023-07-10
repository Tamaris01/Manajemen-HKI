<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pencipta extends Model
{
    public $timestamps = false;
    protected $table = 'pencipta';

    protected $fillable = [
        'hak_cipta_id',
        'nama',
        'alamat',
        'kode_pos',
        'provinsi',
        'kota',
        'email',
    ];

    public function hakCipta()
    {
        return $this->belongsTo(HakCipta::class);
    }
}
