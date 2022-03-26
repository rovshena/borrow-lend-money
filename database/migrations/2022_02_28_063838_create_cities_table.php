<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained();
            $table->string('oblast')->nullable();
            $table->string('region')->nullable();
            $table->string('name')->fulltext();
            $table->string('slug')->unique();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('timezone_sign')->nullable();
            $table->string('timezone_value')->nullable();
            $table->string('population')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->nullable();
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
        Schema::dropIfExists('cities');
    }
}
