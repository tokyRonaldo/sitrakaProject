<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAproposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apropos', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('logo');
            $table->string('nif');
            $table->string('state');
            $table->string('number_phone1');
            $table->string('number_phone2');
            $table->string('email');
            $table->string('facebook');
            $table->text('description');
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
        Schema::dropIfExists('apropos');
    }
}
