<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('course_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('video_id')->constrained('video_stores')->onUpdate('cascade')->onDelete('cascade');
            $table->string('doc_url');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_stores');
    }
};
