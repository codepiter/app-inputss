<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgComercialAndComercial2ToInputLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('input_links', function (Blueprint $table) {
            $table->string('img_comercial', 512)->nullable()->after('url_comercial'); 
            $table->string('comercial2', 256)->nullable()->after('comercial'); 
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
           $table->dropColumn([
               'img_comercial',
               'comercial2'
           ]);
        });
    }
}
