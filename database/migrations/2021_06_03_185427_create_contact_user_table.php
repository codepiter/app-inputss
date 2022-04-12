<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_profiles_id');
            $table->string('fullname', 50);
            $table->string('email');
            $table->string('phone', 32);
            $table->timestamps();

            /*foreign key */
            $table->foreign('user_profiles_id')->references('id')->on('user_profiles')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_user');
    }
}
