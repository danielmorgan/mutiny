<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Ships\Ship;

class CreateShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('hull')->default(Ship::$resourceMax['hull']);
            $table->integer('armor')->default(Ship::$resourceMax['armor']);
            $table->integer('propellant')->default(Ship::$resourceMax['propellant']);
            $table->integer('fuel')->default(Ship::$resourceMax['fuel']);
            $table->integer('energy')->default(Ship::$resourceMax['energy'] / 2);
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
        Schema::drop('ships');
    }
}
