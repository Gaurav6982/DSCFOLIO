<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\SocialMediaNames;
class AddDataToSocialMediaNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            $social=new SocialMediaNames;
            $social->name="Behance";
            $social->save();
            $social=new SocialMediaNames;
            $social->name="LinkedIn";
            $social->save();
            $social=new SocialMediaNames;
            $social->name="Github";
            $social->save();
            $social=new SocialMediaNames;
            $social->name="Twitter";
            $social->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
