<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('display_name');
            $table->mediumText('description');
            $table->mediumText('profile_picture');
            $table->mediumText('resume');
            $table->mediumText('link_set1_name');
            $table->mediumText('link_set2_name');
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
        Schema::dropIfExists('user_info');
    }
}
