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
        Schema::table('si_tools', function (Blueprint $table) {
            $table->unsignedBigInteger('tool_class_id')
                  ->after('tools_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('si_tools', function (Blueprint $table) {
            $table->dropColumn('tool_class_id');
        });
    }
};
