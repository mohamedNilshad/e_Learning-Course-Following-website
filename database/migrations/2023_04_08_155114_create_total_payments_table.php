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
        Schema::create('total_payments', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('payment_id')->constrained('payment_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('course_details')->onUpdate('cascade')->onDelete('cascade');
            $table->double('totalAmount');
            $table->double('withdrewedAmount');
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
        Schema::dropIfExists('total_payments');
    }
};
