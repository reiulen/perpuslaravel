<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Anggota extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = "anggotas";
    protected $primaryKey = "id";
    protected $guarded=['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['q'] ?? false, function($query, $q){
            return $query->where('id_anggota', 'like', '%' .$q. '%')
                         ->orwhere('nama', 'like', '%' .$q. '%')
                         ->orwhere('email', 'like', '%' .$q. '%')
                         ->orwhere('jenis_kelamin', 'like', '%' .$q. '%')
                         ->orwhere('kelas', 'like', '%' .$q. '%'); 
        });
    }
}
