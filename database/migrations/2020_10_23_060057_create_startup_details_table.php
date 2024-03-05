<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartupDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('startup_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('company_name')->nullable();
            $table->text('company_website')->nullable();
            $table->text('comapny_details')->nullable();
            $table->text('phone')->nullable();
            $table->string('stage')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->integer('team_size')->nullable();
            $table->bigInteger('monthly_revenue')->nullable();
            $table->integer('founded_year')->nullable();
            $table->bigInteger('funds_raised')->nullable();
            $table->string('industry')->nullable();
            $table->text('profile_image_url')->nullable();
            $table->json('tags')->nullable();
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
        Schema::dropIfExists('startup_details');
    }
}
