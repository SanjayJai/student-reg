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
        Schema::table('candidates', function (Blueprint $table) {
            // Group Discussion
            $table->dateTime('gd_date_time')->nullable();
            $table->string('gd_interviewer')->nullable();
            $table->string('gd_status')->nullable();
            $table->integer('gd_marks')->nullable();
    
            // Technical Round
            $table->dateTime('technical_date_time')->nullable();
            $table->string('technical_interviewer')->nullable();
            $table->string('technical_status')->nullable();
            $table->integer('technical_marks')->nullable();
    
            // HR Round
            $table->dateTime('hr_date_time')->nullable();
            $table->string('hr_interviewer')->nullable();
            $table->string('hr_status')->nullable();
            $table->integer('hr_marks')->nullable();
    
            // Overall Status
            $table->string('overall_status')->nullable();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            //
        });
    }
};
