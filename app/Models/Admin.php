<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Admin extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'admin';
    protected $fillable = [
        'id',
        'name',
        'username',
        'email',
        'password',
        'image'
    ];
    public function findByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
