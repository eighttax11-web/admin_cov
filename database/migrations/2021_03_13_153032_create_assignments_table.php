<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('person_id')->constrained();
            $table->foreignId('grade_id')->constrained();
            $table->foreignId('group_id')->constrained();
            $table->foreignId('career_id')->constrained();
            $table->foreignId('modality_id')->constrained();
            $table->foreignId('campus_id')->constrained();
            $table->foreignId('period_id')->constrained();
            $table->year('year');
            $table->boolean('status');
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
        Schema::dropIfExists('assignments');
    }
}
