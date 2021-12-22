<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtsyAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etsy_accounts', function (Blueprint $table) {
            $table->id();

            $table->string('etsy_email');

            $table->string('parent_email');

            $table->string('bearer_token');

            $table->string('refresh_token');

            $table->bigInteger('etsy_user_id');

            $table->BigInteger('etsy_shop_id');

            $table->string('etsy_shop_name')->nullable();

            $table->string('etsy_shop_url')->nullable();

            $table->string('etsy_shop_icon')->nullable();

            $table->integer('etsy_shop_transaction')->nullable();

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
        Schema::dropIfExists('etsy_accounts');
    }
}
