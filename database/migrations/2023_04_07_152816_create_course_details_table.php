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
        Schema::create('course_details', function (Blueprint $table) {
            $table->id();
            // $table-> foreignId('educator_id')->constrained('educators')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('educator_id');
            $table->foreign('educator_id')->references('id')->on('educators')->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('topic_id');
            $table->foreign('topic_id')->references('id')->on('course_topics')->onUpdate('cascade')->onDelete('cascade');

            $table->string('courseName');
            $table->text('courseDescription');
            $table->double('coursePrice');
            $table->string('courseThumbnile');

            $table->integer('courseViews');
            $table->boolean('publishCourse');
            $table->date('uploadDate');
            $table->boolean('deleteCourse');
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
        Schema::dropIfExists('course_details');
    }
};