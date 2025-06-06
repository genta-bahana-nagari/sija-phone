<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->string('tipe');
            $table->text('deskripsi');
            $table->integer('stok');
            $table->boolean('status_stok'); // boolean bukan enum lagi
            $table->decimal('harga', 15, 2);
            $table->foreignId('brand_id')->constrained('brands')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phones');
    }
};
