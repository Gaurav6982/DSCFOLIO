<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProfilePictureAndResumeNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_info', function (Blueprint $table) {
            $table->mediumText('profile_picture')->nulalble()->change();
            $table->mediumText('resume')->nulalble()->change();
        });
         //DB::statement('ALTER TABLE user_info MODIFY profile_picture varchar(25) NULL;');
         //DB::statement('ALTER TABLE user_info MODIFY resume varchar(25) NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
