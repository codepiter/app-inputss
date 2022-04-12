<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsTitleAndSubtitleForSubscriptionsToUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('title_subs_email', 128)->nullable();
            $table->string('subtitle_subs_email', 128)->nullable();
            $table->string('title_subs_sms', 128)->nullable();
            $table->string('subtitle_subs_sms', 128)->nullable();
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
                'title_subs_email',
                'subtitle_subs_email',
                'title_subs_sms',
                'subtitle_subs_sms'
            ]);
        });
    }
}
