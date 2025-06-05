<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Phone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Phone>
 */
class PhoneFactory extends Factory
{
    protected $model = Phone::class;

    public function definition()
    {
        return [
            'gambar' => $this->faker->imageUrl(640, 480, 'electronics'),
            'tipe' => $this->faker->word . ' ' . $this->faker->randomNumber(3),
            'spesifikasi' => $this->faker->paragraph,
            'stok' => $this->faker->numberBetween(0, 100),
            'status_stok' => $this->faker->randomElement(['tersedia', 'habis']),
            'harga' => $this->faker->randomFloat(2, 1000000, 15000000),
            'brand_id' => Brand::inRandomOrder()->first()?->id ?? Brand::factory(),
        ];
    }
}
