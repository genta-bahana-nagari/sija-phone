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


            CREATE FUNCTION ketStok(status BOOLEAN) RETURNS VARCHAR(25)
            DETERMINISTIC
            BEGIN
                IF status_stok = 0 THEN
                    RETURN 'Habis';
                ELSEIF status_stok = 1 THEN
                    RETURN 'Tersedia';
                ELSE
                    RETURN 'Status tidak diketahui';
                END IF;
            END;


        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXIST ketStok;");
    }
};