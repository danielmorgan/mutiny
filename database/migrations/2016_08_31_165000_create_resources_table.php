<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Ships\Ship;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ship_id')->unsigned()->index();
            $table->integer('hull')->unsigned()->default(0);
            $table->integer('armor')->unsigned()->default(0);
            $table->integer('propellant')->unsigned()->default(0);
            $table->integer('fuel')->unsigned()->default(0);
            $table->integer('coolant')->unsigned()->default(0);
            $table->integer('energy')->unsigned()->default(0);

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
        Schema::drop('resources');
    }
}
