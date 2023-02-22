<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStrengtheningSupervisionManagers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strengthening_supervision_managers', function (Blueprint $table) {
            $table->id();
            $table->date('revision_date');
            $table->bigInteger('nac_id')->unsigned();
            $table->foreign('nac_id')->references('id')->on('nacs');
            $table->bigInteger('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->time('start_time');
            $table->time('final_time');
            $table->text('development_activity_image');
            $table->text('evidence_participation_image');
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
        Schema::dropIfExists('strengthening_supervision_managers');
    }
}
