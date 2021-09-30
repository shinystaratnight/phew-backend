<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('plan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('role_translations', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('role_id')->unsigned();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->string('slug');
            $table->string('locale')->index();
            $table->unique(['role_id','locale']);
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_translations');
        Schema::dropIfExists('roles');
    }
}
