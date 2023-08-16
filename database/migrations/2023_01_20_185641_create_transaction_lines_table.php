<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_lines', function (Blueprint $table) {
            $table->id();
             $table->bigInteger('transaction_id')->unsigned();
               $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
               $table->bigInteger('article_id')->unsigned();
               $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
               $table->integer('qte')->default(0);
               
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
        Schema::dropIfExists('transaction_lines');
    }
}
