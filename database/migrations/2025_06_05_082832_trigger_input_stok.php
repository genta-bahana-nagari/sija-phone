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
            CREATE TRIGGER status_stok_phone
            BEFORE INSERT ON phones
            FOR EACH ROW
            BEGIN
                IF NEW.stok > 0 THEN
                    SET NEW.status_stok = 1;  -- Tersedia
                ELSE
                    SET NEW.status_stok = 0;  -- Habis
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
            DROP TRIGGER IF EXISTS status_stok_phone;
        ");
    }
};