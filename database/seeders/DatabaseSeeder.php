<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       Buku::factory(10)->create();
    }
}
