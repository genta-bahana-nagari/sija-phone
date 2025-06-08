<?php

namespace Database\Seeders;

use App\Models\PaymentTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $paymentTypes = [
            'Transfer Bank',
            'E-Wallet',
            'Kartu Kredit',
            'Cash on Delivery',
            'Debit/Credit',
            'Debit Instan',
        ];

        foreach ($paymentTypes as $type) {
            PaymentTypes::create(['tipe_pembayaran' => $type]);
        }
    }
}
