<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'judul_buku' => $this->faker->name(),
            'slug' => $this->faker->slug(1),
            'pengarang' => 'Saya suka kamu',
            'jumlah_buku' => '100',	
            'deskripsi' => $this->faker->text(),	
            'tahun_terbit' => '2021',
            'penerbit' => 'Saya suka kamu',
            'isbn' => '12345678',
            'kategori_id' => $this->faker->numberBetween(1, 3),	
            'gambar_buku' => 'gambar.jpg',
            'views' => $this->faker->numberBetween(0, 100)
        ];
    }
}
