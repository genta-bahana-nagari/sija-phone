<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        $smartphoneBrands = [
            'Samsung', 'Apple', 'Xiaomi', 'OPPO', 'Vivo',
            'Realme', 'Huawei', 'Infinix', 'Asus', 'Nokia'
        ];

        return [
            'brand' => $this->faker->unique()->randomElement($smartphoneBrands),
        ];
    }
}
