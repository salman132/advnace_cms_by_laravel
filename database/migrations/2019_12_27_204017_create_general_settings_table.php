<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_title')->default('My Website');
            $table->string('currency')->default('USD');
            $table->string('currency_symbol')->default('$');
            $table->boolean('ev')->default(0)->comment("1 = Email verify On");
            $table->boolean('en')->default(0)->comment("1= Email Notify On");
            $table->boolean('user_register')->default(0);
            $table->integer('alert_system')->comment("1 = Toastr,2=IZI Toast,3=No");
            $table->string('bg_image')->default('uploads/thumbnails/login-bg.jpg');
            $table->string('bg_color')->nullable();
            $table->string('footer_credit')->nullable();
            $table->integer('timezone_id')->nullable();
            $table->boolean('social_login')->default(0);
            $table->string('active_template')->nullable();
            $table->string('email')->nullable();
            $table->text('email_template')->nullable();
            $table->string('email_config')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
