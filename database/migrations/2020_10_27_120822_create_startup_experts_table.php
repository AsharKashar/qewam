<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartupExpertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('startup_experts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expert_id');
            $table->unsignedBigInteger('startup_id');
            $table->foreign('expert_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('startup_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('status')->nullable();
            $table->text('details')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('startup_experts');
    }
}
