<?php

namespace Database\Seeders;

use App\Models\Phone;
use Illuminate\Database\Seeder;
use Database\Factories\PhoneFactory;

class PhoneSeeder extends Seeder
{
    public function run()
    {
        $brandTypes = (new PhoneFactory)->brandTypes();
        $totalTypes = collect($brandTypes)->flatten()->count();

        Phone::factory()->count($totalTypes)->create();
    }
}
