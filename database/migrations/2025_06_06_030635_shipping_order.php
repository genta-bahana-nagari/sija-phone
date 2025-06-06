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
        Schema::table('orders', function($table) {
            $table->foreignId('shipping_type_id')->constrained('shipping_types')->onDelete('restrict')->after('payment_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function($table) {
            $table->dropColumn('shipping_type_id');
        });
    }
};
