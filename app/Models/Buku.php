<?php

namespace App\Models;

use App\Models\Pinjaman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Buku;

class Buku extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
       $query->when($filters['q'] ?? false, function($query, $q){
         return $query->where('judul_buku', 'like', '%' . $q . '%')
                     ->orWhere('pengarang', 'like', '%' . $q . '%')
                     ->orWhere('penerbit', 'like', '%' . $q . '%')
                     ->orWhere('deskripsi', 'like', '%' . $q . '%');
       })->when($filters['kategori'] ?? false, function($query, $kategori){
            return $query->whereHas('kategori', function($query) use ($kategori){
                $query->whereKategori($kategori);
            });
        });
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class);
    }
}
