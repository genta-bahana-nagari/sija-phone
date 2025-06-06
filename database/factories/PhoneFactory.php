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
        // Daftar brand dan tipe HP nyata
        $brandTypes = [
            'Samsung' => ['Galaxy S23', 'Galaxy A54', 'Galaxy Z Fold 5'],
            'Apple' => ['iPhone 14', 'iPhone 13 Pro', 'iPhone SE 2022'],
            'Xiaomi' => ['Redmi Note 12', 'Mi 11 Lite', 'Poco X5 Pro'],
            'OPPO' => ['Reno8', 'A96', 'Find X5 Pro'],
            'Vivo' => ['V27', 'Y22', 'X80 Pro'],
            'Realme' => ['Realme 11 Pro', 'Narzo 60', 'Realme C55'],
            'Infinix' => ['Zero 5G', 'Hot 12', 'Note 30 Pro'],
            'Huawei' => ['P50 Pro', 'Nova 9', 'Mate 40 Pro'],
            'Asus' => ['ROG Phone 7', 'Zenfone 9', 'ROG Phone 6D'],
            'Nokia' => ['G21', 'X30', 'C31'],
        ];

        // Pilih brand secara acak
        $brandName = $this->faker->randomElement(array_keys($brandTypes));
        $brand = Brand::firstOrCreate(['brand' => $brandName]);

        return [
            'gambar' => $this->faker->imageUrl(640, 480, 'smartphone'), // Menghasilkan URL gambar
            'tipe' => $this->faker->randomElement($brandTypes[$brandName]), // Menentukan tipe berdasarkan brand
            'deskripsi' => $this->faker->paragraph, // Menghasilkan deskripsi spesifikasi
            'stok' => $this->faker->numberBetween(0, 100), // Stok dalam rentang 0 hingga 100
            'status_stok' => null, // Status stok akan diatur otomatis oleh trigger
            'harga' => $this->faker->randomFloat(2, 1000000, 15000000), // Harga dengan dua angka desimal
            'brand_id' => $brand->id, // Menetapkan brand_id sesuai dengan id brand
        ];
    }
}
