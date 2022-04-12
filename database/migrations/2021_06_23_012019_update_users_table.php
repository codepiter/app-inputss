<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Campo tipo de Usuario 1 Administrador, 2 Cliente
            $table->foreignId('user_type_id')->default('2')->after('nimda_si')
                ->comment('Asignación tipo de usuario 1:Administrador, 2:Cliente.')
                ->constrained('user_types')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'user_type_id'
            ]);
        });
    }
}
