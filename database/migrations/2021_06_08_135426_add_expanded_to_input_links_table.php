<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpandedToInputLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('input_links', function (Blueprint $table) {
             $table->string('expanded', 4)->nullable()->after('paypal_button'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('input_links', function (Blueprint $table) {
            $table->dropColumn();
        });
    }
}
