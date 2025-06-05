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
            CREATE TRIGGER update_stok_dari_order
            AFTER INSERT ON orders
            FOR EACH ROW
            BEGIN
                UPDATE phones
                SET stok = stok - NEW.jumlah_order
                WHERE id = NEW.phone_id;
                
                IF (SELECT stok FROM phones WHERE id = NEW.phone_id) = 0 THEN
                    UPDATE phones SET status_stok = 0 WHERE id = NEW.phone_id;
                END IF;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS update_stok_dari_order;
        ");
    }
};