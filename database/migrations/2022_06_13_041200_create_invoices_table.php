<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_num')->unique();
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->string('payment_terms')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['draft', 'pending', 'paid'])->index();
            $table->date('invoice_date')->nullable();
            $table->date('payment_due')->nullable();
            $table->double('total', 8, 2)->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
