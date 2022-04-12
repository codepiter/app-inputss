<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputLinkFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_link_follows', function (Blueprint $table) {
            $table->id();
			
			$table->unsignedBigInteger('input_links_id');
            $table->ipAddress('ip_visitor');
            $table->string('country_name', 30);
            $table->string('country_code', 5);
            $table->string('city_name', 30);
			
            $table->timestamps();
			
			/*foreign key */
            $table->foreign('input_links_id')->references('id')->on('input_links')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('input_link_follows');
    }
}
