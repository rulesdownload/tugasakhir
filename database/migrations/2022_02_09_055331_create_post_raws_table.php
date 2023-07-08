<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostRawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_raws', function (Blueprint $table) {
            $table->id();
           $table->text("des_lok",100)->nullable();
            $table->text("des_mas",100)->nullable();
            $table->double("lat",10,6)->nullable();
            $table->double("lng",10,6)->nullable();
            $table->foreignId("city_id");
            $table->foreignId("district_id");
            $table->foreignId("status_id")->nullable();
            $table->foreignId("problem_id")->nullable();
            $table->foreignId("tipe_id")->nullable();
            $table->bigInteger('user_id');
            $table->string("prog_id")->nullable();
            $table->string("done_id")->nullable();
            $table->text("progtxt",100)->nullable();
            $table->text("donetxt",100)->nullable();
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
        Schema::dropIfExists('post_raws');
    }
}
