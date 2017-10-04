<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialNetworkUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_network_user_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('social_network_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->longText('data')->nullable();
            $table->string('since', 50)->nullable();
            $table->foreign('social_network_id')->references('id')->on('social_networks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_network_user_data');
    }
}
