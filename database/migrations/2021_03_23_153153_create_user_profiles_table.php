<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
			
			$table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade')->on('users');
			
			$table->string('slug', 128)->nullable()->unique();
			$table->string('name', 64)->nullable()->default(null);
			$table->string('description', 64)->nullable()->default(null);
			$table->string('personid', 32)->nullable()->default(null);
			$table->string('telefono', 32)->nullable()->default(null);
			$table->string('logo', 512)->nullable()->default(null);
			$table->string('background1', 512)->nullable()->default(null);
			//$table->boolean('contactame')->default(false);
			$table->string('contactame', 2)->nullable()->default(null);
			$table->string('msg_giro', 26)->nullable()->default(null);
			$table->string('color_fuente', 14)->nullable()->default(null);
			$table->string('friend_1', 64)->nullable()->default(null);
			$table->string('friend_2', 64)->nullable()->default(null);
			$table->string('type_plan', 32)->nullable()->default('free');
			$table->string('titulo_amigo', 32)->nullable()->default('AMIGO FIEL');
			$table->string('seo', 256)->nullable()->default(null);
			$table->string('color', 256)->nullable()->default('#000');
		
			
			            

			
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
        Schema::dropIfExists('user_profiles');
    }
}
