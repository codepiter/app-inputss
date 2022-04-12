<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_links', function (Blueprint $table) {
            $table->id();
			
			$table->foreignId('user_profile_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade')->on('user_profiles');
			
			$table->string('url', 128)->nullable()->default(null);
			$table->string('video', 128)->nullable()->default(null);
			$table->string('title', 128)->nullable()->default(null);
			$table->string('subtitle', 1024)->nullable()->default(null);
			$table->string('logo', 512)->nullable()->default(null);
			$table->integer('position')->nullable()->default(0);
			
			
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
        Schema::dropIfExists('input_links');
    }
}
