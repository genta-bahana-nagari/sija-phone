<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTypes extends Model
{
    use HasFactory;

    protected $table = 'payment_types';

    protected $fillable = ['tipe_pembayaran'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'payment_type_id');
    }
}
