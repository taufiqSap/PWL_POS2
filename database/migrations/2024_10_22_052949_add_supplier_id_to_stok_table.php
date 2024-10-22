<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('stok', function (Blueprint $table) {
        $table->unsignedBigInteger('supplier_id')->after('stok_id'); // Adjust position if needed
        // If foreign key constraint is required:
        // $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('stok', function (Blueprint $table) {
        $table->dropColumn('supplier_id');
    });
}

    
};
