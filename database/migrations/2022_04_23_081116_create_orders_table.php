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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->default(0);
            $table->string('customer_name')->default('guest')->nullable();
            $table->string('email');
            $table->string('address');
            $table->string('telephone');
            $table->bigInteger('price');
            //$table->foreignId('promotion_id')->nullable()->constrained();
            $table->integer('is_approved')->default(0)->nullable();
            $table->integer('is_canceled')->default(0)->nullable();
            $table->integer('is_finished')->default(0)->nullable();
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
        Schema::dropIfExists('orders');
    }
};
