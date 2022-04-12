<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodigoQrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo_qrs', function (Blueprint $table) {
            $table->id();
			
			$table->foreignId('user_profile_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade')->on('user_profiles');
			$table->string('url', 128)->nullable()->unique();
			$table->string('typedots', 128)->nullable()->default(null);
			$table->string('width', 128)->nullable()->default(null);
			$table->string('height', 128)->nullable()->default(null);
			$table->string('background', 128)->nullable()->default(null);
			$table->string('color', 128)->nullable()->default(null);
			$table->string('image', 128)->nullable()->default(null);

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
        Schema::dropIfExists('codigo_qrs');
    }
}
