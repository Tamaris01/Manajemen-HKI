<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakCipta extends Model
{
    public $timestamps = false;
    protected $table = 'hak_cipta';
    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = [
        'id',
        'pemohon_id',
        'admin_id',
        'jenis_permohonan',
        'jenis_ciptaan',
        'sub_jenis_ciptaan',
        'judul',
        'uraian_singkat',
        'tanggal_pertama',
        'kota_pertama',
        'keterangan',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,"pemohon_id","id");
    }
    public function pencipta()
    {
        return $this->hasMany(Pencipta::class);
    }
    public function lampiran()
    {
        return $this->hasOne(Lampiran::class);
    }
    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class);
    }
}
