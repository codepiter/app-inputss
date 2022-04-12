<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('advertising')->unique()->comment('Proveedor de anuncios.');
            $table->longText('head')->nullable()->comment('Script para el encabezado de la pagina');
            $table->longText('block')->nullable()->comment('Anuncio con dimensiones de cuadrado.');
            $table->longText('horizontal')->nullable()->comment('Anuncio con dimensiones de banner horizontal');
            $table->longText('vertical')->nullable()->comment('Anuncio con dimensiones de banner vertical');
            $table->timestamps();
        });

        Schema::create('state_ad', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default('0')->comment('Estado de los anuncios');
            $table->foreignId('advertisements_id')->constrained('advertisements')
            ->nullable()
            /*->onUpdate('cascade')->onDelete('null')*/;
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
        Schema::dropIfExists('state_ad');
        Schema::dropIfExists('advertisements');
    }
}
