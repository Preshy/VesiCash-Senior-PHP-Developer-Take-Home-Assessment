<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscrowTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escrow_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sender_email');
            $table->bigInteger('sender_phone');
            $table->string('recipient_email');
            $table->bigInteger('recipient_phone');
            $table->text('payload');
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
        Schema::dropIfExists('escrow_transactions');
    }
}
