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
        Schema::create('borrowers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('emp_id')->unique();
            $table->string('contact_no');

            //optional option to add
            $table->string('email')->nullable();
            $table->string('profile_photo')->nullable();

            $table->timestamps();
        });

        Schema::create('borrower_biometrics', function (Blueprint $table) {
            $table->id();
             $table->foreignId('borrower_id')
                  ->constrained('borrowers')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->string('sensor_id');
            $table->unsignedInteger('fingerprint_slot');

            $table->timestamp('enrolled_at');

            //optional option to add
            $table->string('finger_name')->nullable();
            $table->string('status')->default('acticve');
            $table->timestamp('revoked_at')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowers');
        Schema::dropIfExists('borrower_biometrics');
    }
};
