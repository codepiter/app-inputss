<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table para definir los tipos/niveles de usuarios para establecer la limitación de
        // sus acciones en el sistema.
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique()->comment('Tipos de usuarios');/**/
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
        Schema::dropIfExists('user_types');
    }
}
