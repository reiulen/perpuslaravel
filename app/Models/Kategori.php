<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['q'] ?? false, function($query, $q){
            return $query->where('kategori', 'like', '%' .$q. '%');
        });
    }
}

