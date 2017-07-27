<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interest_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('interest_id')->unsigned();
            $table->string('name');
            $table->string('locale', 10)->index();
            $table->unique(['interest_id', 'locale']);
            $table->foreign('interest_id')->references('id')->on('interests')->onDelete('cascade');
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
        Schema::dropIfExists('interest_translations');
    }
}
