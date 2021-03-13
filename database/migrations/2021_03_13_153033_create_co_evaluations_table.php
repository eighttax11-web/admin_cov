<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_evaluations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('assignment_id')->constrained();
            $table->string('file');
            $table->integer('total_students');
            $table->boolean('status');
            $table->string('drive_url');
            $table->dateTime('last_date_send');
            $table->integer('total_success');
            $table->integer('total_errors');
            $table->integer('co_evaluations_files');
            $table->dateTime('last_date_load');
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
        Schema::dropIfExists('co_evaluations');
    }
}
