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
        Schema::create('notify_edus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courseId')->constrained('course_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('adminId')->constrained('admins')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('educatorId')->constrained('educators')->onUpdate('cascade')->onDelete('cascade');
            $table->text('message');
            $table->integer('isRead');
            $table->integer('delete');
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
        Schema::dropIfExists('notify_edus');
    }
};
