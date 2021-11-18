<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekerRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seeker_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('unique_code')->nullable($value = true);
            $table->unsignedBigInteger('user_id');
            $table->string('gender');
            $table->unsignedBigInteger('profession');
            $table->unsignedBigInteger('specialty');
            $table->string('mobile')->nullable($value = true);
            $table->string('postcode')->nullable($value = true);
            $table->string('location')->nullable($value = true);
            $table->string('city')->nullable($value = true);
            $table->string('suburb')->nullable($value = true);
            $table->string('token')->nullable($value = true);
            $table->string('cv')->nullable($value = true);
            $table->enum('status', ['1', '0'])->default("1")->comment('[1 => "Enabled", 0 => "Disabled"]');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('profession')->references('id')->on('professions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('specialty')->references('id')->on('specialties')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_seeker_registrations');
    }
}
