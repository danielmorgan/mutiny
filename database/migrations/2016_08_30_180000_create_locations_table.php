<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->unsigned()->default(1);
            $table->string('locatable_type')->nullable()->default(null);
            $table->integer('locatable_id')->nullable()->default(null)->unsigned();
            $table->string('name')->nullable()->default(null);
            $table->string('slug')->nullable();
            $table->text('description')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->boolean('userCanEnter')->default(false);
            $table->boolean('shipCanEnter')->default(false);
            $table->timestamps();

            $table->unique(['locatable_id', 'locatable_type', 'parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('locations');
    }
}
