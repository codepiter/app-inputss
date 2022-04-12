<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
        $table->id();
			
			$table->string('name', 256)->nullable()->default(null);
			$table->string('limit_items', 256)->nullable()->default(null);
			$table->string('limit_orders', 256)->nullable()->default(null);
			$table->decimal('price', 8,2)->nullable()->default(null);

			
			
			$table->string('period', 256)->nullable()->default(null);
			$table->string('paddle_id', 256)->nullable()->default(null);
			$table->string('description', 256)->nullable()->default(null);
			$table->string('features', 256)->nullable()->default(null);
			$table->string('enable_ordering', 256)->nullable()->default(null);
			$table->string('stripe_id', 256)->nullable()->default(null);
			$table->string('paypal_id', 256)->nullable()->default(null);
			$table->string('mollie_id', 256)->nullable()->default(null);
			$table->string('paystack_id', 256)->nullable()->default(null);

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
        Schema::dropIfExists('plans');
    }
}
