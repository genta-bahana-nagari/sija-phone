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
            CREATE TRIGGER jumlah_masuk
                AFTER INSERT ON barang_masuk FOR EACH ROW
                begin
                UPDATE phones
                SET phones.stok = phones.stok + NEW.qty_masuk
                WHERE phones.id=NEW.phone_id;
            END;
            CREATE TRIGGER jumlah_keluar
                AFTER INSERT ON barang_keluar FOR EACH ROW
                begin
                UPDATE phones
                SET phones.stok = phones.stok - NEW.qty_keluar
                WHERE phones.id=NEW.phone_id;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS jumlah_masuk;
            DROP TRIGGER IF EXISTS jumlah_keluar;
        ");
    }
};