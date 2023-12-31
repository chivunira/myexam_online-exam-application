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
        Schema::create('unit_exams', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('unit_id')->unsigned()->index();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');

            $table->date('exam_date');
            $table->string('exam_venue');
            
            $table->bigInteger('exam_session')->unsigned()->index();
            $table->foreign('exam_session')->references('id')->on('exam_sessions')->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_exams');
    }
};
