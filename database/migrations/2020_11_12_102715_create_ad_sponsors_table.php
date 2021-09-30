<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_sponsors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sponsor_id')->unsigned()->nullable();
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->longText('url')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('information')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('ad_sponsors');
    }
}
