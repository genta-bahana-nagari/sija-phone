<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER order_barang_keluar
                AFTER INSERT ON orders
                FOR EACH ROW
                BEGIN
                    -- Insert data ke tabel barang_keluar
                    INSERT INTO barang_keluar (
                        phone_id,
                        tgl_keluar,
                        qty_keluar,
                        keterangan_keluar,
                        created_at,
                        updated_at
                    )
                    VALUES (
                        NEW.phone_id,                             
                        CURDATE(),                                
                        NEW.jumlah_order,                         
                        'Dibeli customer',                        
                        NOW(),                                    
                        NOW()                                     
                    );
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS order_barang_keluar;
        ");
    }
};