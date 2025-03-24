<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Expenses',function (Blueprint $table){
            $table->id()->autoIncrement();
            $table->string('vendor');
            $table->string('category');
            $table->double('amount');
            $table->integer('paymentMethod');
            $table->string('expenditureAccount');
            $table->string('destinationAccount');
            $table->integer('employeeId');
            $table->integer('departmentId');
            $table->string('expenseDate');
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
        Schema::dropIfExists('Expenses');
    }
};
