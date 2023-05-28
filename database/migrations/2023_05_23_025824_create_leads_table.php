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
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id')->startingValue(30001);
            $table->string('source');
            $table->enum('status', ['open', 'complicated', 'closed']);
            $table->timestamp('converted_at')->nullable();
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')->unsigned()->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedInteger('campaign_id')->nullable();
            $table->foreign('campaign_id')->unsigned()->references('id')->on('campaigns')->onDelete('cascade');  
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
        Schema::dropIfExists('leads');
    }
};
