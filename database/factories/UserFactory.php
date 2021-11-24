<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
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
            'pengarang' => $this->faker->name(),
            'jumlah_buku' => '100',	
            'deskripsi' => $this->faker->words(),	
            'tahun_terbit' => '2021',
            'penerbit' => $this->faker->name(),
            'isbn' => '12345678',
            'kategori' => 'pendidikan',	
            'gambar_buku' => 'gambar.jpg',
            'views' => $this->faker->numberBetween(0, 100)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
