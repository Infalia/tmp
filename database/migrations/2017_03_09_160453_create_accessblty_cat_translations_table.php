<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessbltyCatTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessblty_cat_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accessblty_cat_id')->unsigned();
            $table->string('name');
            $table->string('locale', 10)->index();
            $table->unique(['accessblty_cat_id', 'locale']);
            $table->foreign('accessblty_cat_id')->references('id')->on('accessblty_cats')->onDelete('cascade');
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
        Schema::dropIfExists('accessblty_cat_translations');
    }
}
