<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('package_type', ['free', 'paid'])->default('free');
            $table->string('period')->default('');
            $table->enum('period_type', ['hours', 'days', 'weeks', 'months', 'years'])->default('months');
            $table->double('price')->default(0);
            $table->longText('plan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('package_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('package_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('locale')->index();
            $table->unique(['package_id', 'locale']);
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_translations');
        Schema::dropIfExists('packages');
    }
}
