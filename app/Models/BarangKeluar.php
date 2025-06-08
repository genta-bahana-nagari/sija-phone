<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';

    protected $fillable = [
        'phone_id',  // Foreign key for category
        'tgl_keluar',
        'qty_keluar',
        'keterangan_keluar',
    ];

    public function phone()
    {
        return $this->belongsTo(Phone::class, 'phone_id');
    }
}
