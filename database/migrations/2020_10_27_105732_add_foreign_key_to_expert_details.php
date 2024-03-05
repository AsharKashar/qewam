<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToExpertDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('expert_details', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
        });
        Schema::table('expert_details', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
        Schema::table('startup_details', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
        });
        Schema::table('startup_details', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('expert_details', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
        });

        Schema::table('startup_details', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
        });
    }
}
