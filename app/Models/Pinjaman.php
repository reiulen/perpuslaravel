<?php

namespace App\Models;

use App\Models\Buku;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pinjaman extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
    
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function getTglPinjamAttribut()
    {
        return Carbon::parse($this->attributes['tgl_pinjam'])
                ->transalatedFormat('l, d F Y');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['pinjam'] ?? false, function($query, $q){
            return $query->where('id_anggota', 'like', '%' .$q. '%')
                         ->orWhere('nama_peminjam', 'like', '%' .$q. '%')
                         ->orWhere('judul_buku', 'like', '%' .$q. '%')
                         ->orWhere('email', 'like', '%' .$q. '%')
                         ->orWhere('jenis_kelamin', 'like', '%' .$q. '%')
                         ->orWhere('kelas', 'like', '%' .$q. '%')
                         ->orWhere('tgl_pinjam', 'like', '%' .$q. '%')
                         ->orWhere('tgl_kembali', 'like', '%' .$q. '%')
                         ->orWhere('status', 'like', '%' .$q. '%')
                         ->orWhere('denda', 'like', '%' .$q. '%');
        });
    }
}
