<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsPremiumToInputLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('input_links', function (Blueprint $table) {
            $table->boolean('is_premium')->default('0')->after('url');
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
                'is_premium'
            ]);
        });
    }
}
