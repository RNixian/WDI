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
    Schema::table('materials', function (Blueprint $table) {
        $table->foreign('class_id')
              ->references('id')
              ->on('item_classification')
              ->cascadeOnDelete();

        $table->foreign('category_id')
              ->references('id')
              ->on('item_categories')
              ->cascadeOnDelete();

        $table->foreign('supplier_id')
              ->references('id')
              ->on('suppliers')
              ->cascadeOnDelete();
    });
}

public function down(): void
{
    Schema::table('materials', function (Blueprint $table) {
        $table->dropForeign(['class_id']);
        $table->dropForeign(['category_id']);
        $table->dropForeign(['supplier_id']);
    });
}
};
