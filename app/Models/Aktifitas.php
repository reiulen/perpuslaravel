<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aktifitas extends Model
{
    protected $guarded=['id'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
