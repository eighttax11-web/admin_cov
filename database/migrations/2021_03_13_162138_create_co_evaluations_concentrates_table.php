<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoEvaluationsConcentratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_evaluations_concentrates', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('co_evaluation_id');
            $table->foreign('co_evaluation_id')->references('id')->on('co_evaluations');

            $table->unsignedBigInteger('evaluator_id');
            $table->foreign('evaluator_id')->references('id')->on('students');

            $table->unsignedBigInteger('evaluated_id');
            $table->foreign('evaluated_id')->references('id')->on('students');

            $table->integer('criterion_1');
            $table->integer('criterion_2');
            $table->integer('criterion_3');
            $table->integer('criterion_4');
            $table->integer('criterion_5');
            $table->integer('criterion_6');
            $table->integer('criterion_7');

            $table->softDeletes();
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
        Schema::dropIfExists('co_evaluations_concentrates');
    }
}
