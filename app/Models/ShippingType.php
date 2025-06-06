<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingType extends Model
{
    use HasFactory;

    protected $table = 'shipping_types';

    protected $fillable = ['tipe_pengiriman', 'ongkos'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'shipping_type_id');
    }
}
