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
        Schema::create('special_requests', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('student_id')->unsigned()->index();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->bigInteger('unit_id')->unsigned()->index();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');

            $table->string('reason');

            $table->bigInteger('unit_exam')->unsigned()->index()->nullable();
            $table->foreign('unit_exam')->references('id')->on('unit_exams')->onDelete('cascade');

            $table->string('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_requests');
    }
};
