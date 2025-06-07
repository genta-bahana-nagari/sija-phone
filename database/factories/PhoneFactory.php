<?php

namespace Database\Factories;

use App\Models\Phone;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    protected $model = Phone::class;

    public function definition()
    {
        return [
            'gambar' => $this->faker->imageUrl(640, 480, 'smartphone'),
            'tipe' => $this->faker->unique()->word, // Diabaikan saat dipakai manual di seeder
            'deskripsi' => $this->faker->paragraph,
            'stok' => $this->faker->numberBetween(0, 150),
            'status_stok' => null,
            'harga' => $this->faker->randomFloat(2, 1000000, 30000000),
            'brand_id' => 1, // dummy, ditimpa di seeder
        ];
    }
}
