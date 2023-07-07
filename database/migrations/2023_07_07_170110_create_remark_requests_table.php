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
        Schema::create('remark_requests', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('student_id')->unsigned()->index();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->bigInteger('unit_id')->unsigned()->index();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');

            $table->string('reason');
            $table->integer('previous_marks');
            $table->string('status');// assigned, waiting lec feedback, revised

            $table->integer('revised_marks')->nullable();

            $table->bigInteger('assigned_lec')->unsigned()->index()->nullable();
            $table->foreign('assigned_lec')->references('id')->on('lecturers');

            $table->string('feedback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remark_requests');
    }
};
