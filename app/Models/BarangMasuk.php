<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';

    protected $fillable = [
        'phone_id',  // Foreign key for category
        'tgl_masuk',
        'qty_masuk',
        'keterangan_masuk',
    ];

    public function phone()
    {
        return $this->belongsTo(Phone::class, 'phone_id');
    }
}
