<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateShortnerLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("main_link")->unique()->collation('utf8_bin');
            $table->string("short_link")->unique()->collation('utf8_bin');
            $table->timestamp("expired_at");

            $table->timestamps();
        });

        DB::update("ALTER TABLE links AUTO_INCREMENT = 1000000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
