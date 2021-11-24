<?php

namespace App\Http\Controllers\Auth;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LupaPasswordController extends Controller
{
    public function index()
    {
        $title = 'Lupa Password';
        $kat = Kategori::latest()->get();
        return view('lupa-password', compact('title', 'kat'));
    }
}
