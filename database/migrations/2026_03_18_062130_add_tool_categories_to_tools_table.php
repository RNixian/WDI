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
        Schema::table('tools', function (Blueprint $table) {

           $table->foreignId('tool_category_id')->constrained('tools')->cascadeOnDelete()->nullable();
           $table->foreignId('tool_class_id')->constrained('tools')->cascadeOnDelete()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->dropForeign(['tool_category_id']);
        $table->dropForeign(['tool_class_id']);
        });
    }
};
