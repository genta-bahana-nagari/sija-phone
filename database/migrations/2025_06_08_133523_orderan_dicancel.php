<?php

use Illuminate\Database\Migrations\Migration;
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
            CREATE TRIGGER orderan_dicancel
            AFTER UPDATE ON orders
            FOR EACH ROW
            BEGIN
                DECLARE v_qty INT DEFAULT 0;

                IF NEW.status_pesanan = 'dibatalkan' AND OLD.status_pesanan != 'dibatalkan' THEN
                    -- Ambil qty dari barang_keluar
                    SELECT qty_keluar INTO v_qty
                    FROM barang_keluar
                    WHERE phone_id = NEW.phone_id
                    LIMIT 1;

                    -- Kembalikan stok ke tabel phones
                    UPDATE phones
                    SET stok = stok + v_qty
                    WHERE id = NEW.phone_id;

                    -- Hapus entri dari barang_keluar
                    DELETE FROM barang_keluar
                    WHERE phone_id = NEW.phone_id;
                END IF;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS orderan_dicancel;
        ");
    }
};
