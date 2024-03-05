<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('name');
            $table->bigInteger('phone')->nullable();
            $table->string('profession')->nullable();
            $table->text('bio')->nullable();
            $table->text('description')->nullable();
            $table->string('rate_type')->nullable();
            $table->bigInteger('rate')->nullable();
            $table->string('currency')->nullable();
            $table->text('profile_image_url')->nullable();
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
        Schema::dropIfExists('expert_details');
    }
}
