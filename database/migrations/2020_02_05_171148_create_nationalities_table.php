<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nationalities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('nationality_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nationality_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('locale')->index();
            $table->unique(['nationality_id', 'locale']);
            $table->foreign('nationality_id')->references('id')->on('nationalities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nationality_translations');
        Schema::dropIfExists('nationalities');
    }
}
