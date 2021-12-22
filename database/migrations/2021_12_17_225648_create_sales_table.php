<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('sales_id')->nullable();
            $table->integer('item_id')->nullable();

            $table->integer('user_id');
            $table->string('spreadsheet_id');
            $table->date('sale_date')->nullable();
            $table->string('platform');
            $table->string('currency');

            $table->string('img')->nullable();

            $table->integer('quantity')->nullable();

            $table->string('name');
            $table->decimal('sold_price', 65,2);
            $table->decimal('item_cost', 65,2);
            $table->decimal('shipping_charge', 65,2);
            $table->decimal('shipping_cost', 65,2);
            $table->decimal('fees', 65,2);
            $table->decimal('other_fees', 65,2);
            $table->decimal('processing_fees', 65,2);
            $table->decimal('tax', 65,2);
            $table->decimal('profit', 65,2);
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
        Schema::dropIfExists('sales');
    }
}
