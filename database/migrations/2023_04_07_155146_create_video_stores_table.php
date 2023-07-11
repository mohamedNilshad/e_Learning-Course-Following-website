<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('course_details')->onUpdate('cascade')->onDelete('cascade');
            $table->string('video_url');
            $table->string('video_title');
            $table->string('video_thumb_url');
            $table->string('video_description');
            $table->integer('video_order');
            
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
        Schema::dropIfExists('video_stores');
    }
};