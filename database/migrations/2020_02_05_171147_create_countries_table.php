<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('short_name')->nullable();
            $table->string('show_phonecode')->nullable();
            $table->string('phonecode')->nullable();
            $table->string('flag')->nullable();
            $table->enum('continent', ['africa', 'europe', 'asia', 'south_america', 'north_america', 'australia'])->default('asia');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('country_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('country_id')->unsigned();
            $table->string('name');
            $table->string('currency');
            $table->string('slug');
            $table->string('locale')->index();
            $table->unique(['country_id', 'locale']);
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_translations');
        Schema::dropIfExists('countries');
    }
}
