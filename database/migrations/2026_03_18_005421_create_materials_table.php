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
    Schema::create('materials', function (Blueprint $table) {
        $table->id();

        // Basic info
        $table->string('item_description');

        $table->foreignId('class_id')->nullable();
        $table->foreignId('category_id')->nullable();
        $table->foreignId('supplier_id')->nullable();
        $table->string('unit')->nullable();
        $table->integer('quantity');
        $table->decimal('unit_price', 10, 2)->nullable();
        $table->date('from_date');
        $table->date('to_date');

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
