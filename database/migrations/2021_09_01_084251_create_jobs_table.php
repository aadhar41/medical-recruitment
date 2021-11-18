<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('unique_code')->nullable($value = true);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('job_type');
            $table->unsignedBigInteger('job_category');
            $table->unsignedBigInteger('medical_center');
            $table->unsignedBigInteger('profession');
            $table->unsignedBigInteger('speciality');
            $table->unsignedMediumInteger('state');
            $table->unsignedMediumInteger('city');
            $table->integer('suburb');
            $table->text('address')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->string('rate')->nullable($value = true);
            $table->string('work_days')->nullable($value = true);
            $table->text('title')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('slug')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->string('from_date')->nullable($value = true);
            $table->string('to_date')->nullable($value = true);
            $table->text('description')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('practice_offer')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('essential_criteria')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->enum('status', ['1', '0'])->default("1")->comment('[1 => "Enabled", 0 => "Disabled"]');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->foreign('job_type')->references('id')->on('job_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('job_category')->references('id')->on('job_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('medical_center')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('profession')->references('id')->on('professions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('speciality')->references('id')->on('specialties')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('state')->references('id')->on('states')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('suburb')->references('id')->on('suburbs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
