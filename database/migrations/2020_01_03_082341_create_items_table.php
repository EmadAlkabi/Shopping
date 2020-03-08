<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('offline_id')->nullable();
            $table->string('name');
            $table->text('details');
            $table->string('barcode')->nullable();
            $table->string('code')->nullable();
            $table->string('currency');
            $table->decimal('price');
            $table->string('unit');
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->boolean('state');
            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
