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
        Schema::create('educators', function (Blueprint $table) {
            $table->id();
            $table->string('educatorName');
            $table->string('educatorEmail')->unique();
            $table->string('educatorPassword');
            $table->text('educatorBio');
            $table->string('educatorProfileImage');
            $table->string('educatorCoverImage');
            $table->boolean('blockEducator');
            $table->integer('resetCode');
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
        Schema::dropIfExists('educators');
    }
};
