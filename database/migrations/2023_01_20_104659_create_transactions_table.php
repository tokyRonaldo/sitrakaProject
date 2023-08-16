<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
               $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //    $table->bigInteger('article_id')->unsigned();
            //    $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
               $table->bigInteger('contact_id')->unsigned();
               $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
                $table->dateTime('date_transactions');
                $table->dateTime('date_payment')->nullable();
            $table->enum('status', ['payer', 'reste'])->nullable();
            $table->string('no_facture')->nullable();
            $table->string('note')->nullable();
            $table->decimal('prix_total',22,2);
            $table->decimal('total_payment',22,2);
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
        Schema::dropIfExists('transactions');
    }
}
