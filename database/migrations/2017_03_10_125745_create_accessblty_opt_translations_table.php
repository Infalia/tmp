<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessbltyOptTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessblty_opt_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accessblty_opt_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['accessblty_opt_id', 'locale']);
            $table->foreign('accessblty_opt_id')->references('id')->on('accessblty_opts')->onDelete('cascade');
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
        Schema::dropIfExists('accessblty_opt_translations');
    }
}
