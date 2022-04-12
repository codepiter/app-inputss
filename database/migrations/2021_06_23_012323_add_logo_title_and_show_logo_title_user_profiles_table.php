<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLogoTitleAndShowLogoTitleUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->boolean('show_logo_title')->default(false)->after('logo');
            $table->string('logo_title', 512)->nullable()->default(null)->after('show_logo_title');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'show_logo_title', 'logo_title'
            ]);
        });
    }
}
