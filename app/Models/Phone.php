<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phones';

    protected $fillable = [
        'gambar',
        'tipe',
        'deskripsi',
        'stok',
        'status_stok',
        'harga',
        'brand_id',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function barang_masuk() {
        return $this->hasMany(BarangMasuk::class);
    }
    
    public function barang_keluar() {
        return $this->hasMany(BarangKeluar::class);
    }
}
