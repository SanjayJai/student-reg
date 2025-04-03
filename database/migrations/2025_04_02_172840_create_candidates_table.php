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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->date('dob');
            $table->string('gender');
            $table->text('address');
            $table->string('position');
            $table->string('qualification');
            $table->string('institution');
            $table->string('year_passing');
            $table->string('specialization');
            $table->text('skills')->nullable();
            $table->string('registration_number')->unique();
            $table->string('resume')->nullable(); // Add this column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
