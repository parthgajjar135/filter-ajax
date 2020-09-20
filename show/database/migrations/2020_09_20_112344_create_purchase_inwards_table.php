<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_inwards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_id');
            $table->string('invoice_no');
            $table->date('invoice_date');
            $table->string('delivery_note');
            $table->text('supplier_reference');
            $table->string('buyer_order_no');
            $table->date('buyer_order_date');
            $table->string('dispatch_doc_no');
            $table->date('delivery_date');
            $table->string('terms_of_delivery');
            $table->string('delivery_destination');
            $table->bigInteger('branch_id');
            $table->float('purchase_vat');
            $table->float('round_of_amount');
            $table->string('terms_of_payment');
            $table->string('other_reference');            
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
        Schema::dropIfExists('purchase_inwards');
    }
}
