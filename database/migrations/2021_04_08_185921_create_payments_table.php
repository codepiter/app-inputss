<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
			
			$table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade')->on('users');
			$table->decimal('amount', 8, 2)->nullable()->default(null);
			$table->string('payment_mode', 320)->nullable()->default(null);
			$table->string('type_card', 100)->nullable()->default(null);
			
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
        Schema::dropIfExists('payments');
    }
}
