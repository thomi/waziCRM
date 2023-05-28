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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id')->startingValue(20001);
            $table->string('full_name');
            $table->string('phone_number')->unique();
            $table->string('email_address')->unique()->nullable();
            $table->string('tax_id')->unique()->nullable();
            $table->string('id_number')->unique()->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->unsigned()->references('id')->on('users')->onDelete('cascade');  
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
