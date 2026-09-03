<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('si_tools', function (Blueprint $table) {
            $table->id();

            $table->string('tools_description');
            $table->foreignId('tool_cat_id')
                  ->constrained('tool_categories')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->string('size')->nullable();
            $table->unsignedInteger('qty')->default(0);

            $table->date('purchased_at')->nullable();

            $table->string('brand')->nullable();
            $table->string('status')->default('Available');

            $table->string('invoice_reference')->nullable();

            $table->decimal('unit_price', 12, 2)->default(0.00);

            $table->string('serial_tag')->nullable()->unique();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('si_tools');
    }
};
