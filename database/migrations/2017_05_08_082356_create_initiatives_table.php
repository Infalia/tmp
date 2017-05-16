<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitiativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initiatives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('initiative_type_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title', 255);
            $table->text('description');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('input_map_data', 255);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->foreign('initiative_type_id')->references('id')->on('initiative_types');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('initiatives');
    }
}
