<?php

namespace App\Models;

use App\Models\Aktifitas;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded=['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function aktifitas()
    {
        return $this->hasMany(Aktifitas::class);
    }

    public function aktifitasadmin()
    {
        return $this->hasMany(aktifitasadmin::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['q'] ?? false, function($query, $q){
            return $query->where('id_petugas', 'like', '%' .$q. '%')
                          ->orwhere('nama', 'like', '%' .$q. '%')
                          ->orwhere('username', 'like', '%' .$q. '%')
                          ->orwhere('created_at', 'like', '%' .$q. '%');
        });
    }
}
