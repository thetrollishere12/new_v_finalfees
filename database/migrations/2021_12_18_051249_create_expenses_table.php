<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {

            $table->id();
            $table->integer('item_sku')->nullable();
            $table->integer('user_id');
            $table->string('spreadsheet_id');
            $table->date('date')->nullable();
            $table->string('currency');
            $table->string('img')->nullable();
            $table->string('name');
            $table->decimal('amount', 65,2);
            $table->string('description')->nullable();
            $table->decimal('tax', 65,2)->nullable();
            $table->string('account');
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
        Schema::dropIfExists('expenses');
    }
}
