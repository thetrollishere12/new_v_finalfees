<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbayAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebay_accounts', function (Blueprint $table) {
            $table->id();

            $table->string('ebay_email')->nullable();

            $table->string('parent_email')->nullable();

            $table->string('app_token')->nullable();

            $table->string('user_token')->nullable();

            $table->string('session_int')->nullable();

            $table->string('json')->nullable();

            $table->string('oauthtoken')->nullable();

            $table->BigInteger('verifiedOauth')->nullable();

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
        Schema::dropIfExists('ebay_accounts');
    }
}
