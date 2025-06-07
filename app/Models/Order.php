<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'phone_id',
        'jumlah_order',
        'harga_total',
        'alamat',
        'kontak',
        'status_pesanan',
        'user_id',
        'payment_type_id',
        'shipping_type_id',
    ];

    public function phone()
    {
        return $this->belongsTo(Phone::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentTypes::class);
    }
    
    public function shippingType()
    {
        return $this->belongsTo(ShippingType::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
