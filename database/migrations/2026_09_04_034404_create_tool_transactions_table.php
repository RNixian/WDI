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
        Schema::create('tool_transactions', function (Blueprint $table) {
            $table->id();

            $table->string('transaction_code')->unique();
            $table->string('transaction_type');
            $table->string('status');

            $table->timestamps();
        });


        Schema::create('transaction_borrowers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transaction_id')
                ->constrained('tool_transactions')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('borrower_id')
                ->constrained('borrowers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('role');
            $table->string('confirmation_method')->nullable();
            $table->string('confirmation_status')->default('pending');

            $table->timestamp('confirmed_at')->nullable();

            $table->timestamps();
        });


        Schema::create('transaction_tool_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transaction_id')
                ->constrained('tool_transactions')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('tool_id')
                ->constrained('si_tools')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('borrowers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->unsignedInteger('quantity')->default(1);

            $table->string('status');

            $table->timestamp('borrowed_at')->nullable();
            $table->timestamp('returned_at')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_tool_items');
        Schema::dropIfExists('transaction_borrowers');
        Schema::dropIfExists('tool_transactions');
    }
};
