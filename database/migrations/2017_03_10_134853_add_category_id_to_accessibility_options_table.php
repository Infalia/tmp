<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToAccessibilityOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accessblty_opts', function (Blueprint $table) {
            $table->integer('accessblty_cat_id')->unsigned()->after('id');
            $table->foreign('accessblty_cat_id')->references('id')->on('accessblty_cats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accessblty_opts', function (Blueprint $table) {
            $table->dropColumn('accessblty_cat_id');
        });
    }
}
