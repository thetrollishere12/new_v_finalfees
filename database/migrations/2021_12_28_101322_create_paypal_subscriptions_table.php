<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('payment_method');
            $table->string('name');
            $table->string('paypal_id');
            $table->string('paypal_status');
            $table->string('paypal_plan')->nullable()->default(null);
            $table->integer('quantity')->nullable()->default(null);
            $table->timestamp('trial_ends_at')->nullable()->default(null);
            $table->timestamp('ends_at')->nullable()->default(null);
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
        Schema::dropIfExists('paypal_subscriptions');
    }
}
