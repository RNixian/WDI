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
        Schema::table('tool_categories', function (Blueprint $table) {
            // Add the new column
            $table->unsignedBigInteger('tool_class_id');

            // Add foreign key constraint
            $table->foreign('tool_class_id')
                  ->references('id')
                  ->on('tool_classification')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tool_categories', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['tool_class_id']);

            // Then drop the column
            $table->dropColumn('tool_class_id');
        });
    }
};
