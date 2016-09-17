<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_usages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ship_id')->unsigned()->index();
            $table->integer('hull')->default(0);
            $table->integer('armor')->default(0);
            $table->integer('propellant')->default(0);
            $table->integer('fuel')->default(0);
            $table->integer('energy')->default(100);

            $table->foreign('ship_id')
                ->references('id')
                ->on('ships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_usages');
    }
}