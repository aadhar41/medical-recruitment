<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->string('unique_code')->nullable($value = true);
            $table->unsignedBigInteger('job_id')->comment('Job Applied For.');
            $table->unsignedBigInteger('job_type')->comment('Type of Job');
            $table->string('email')->nullable($value = true);
            $table->string('first_name')->nullable($value = true);
            $table->string('last_name')->nullable($value = true);
            $table->string('contact')->nullable($value = true);
            $table->string('work_place')->nullable($value = true);
            $table->enum('ahpra', ['0', '1'])->default("0")->comment('[1 => "AHPRA LOCATION", 0 => "NO AHPRA"]');
            $table->string('location')->nullable($value = true)->comment('City');
            $table->string('suburb')->nullable($value = true);
            $table->string('state')->nullable($value = true);
            $table->string('postcode')->nullable($value = true);
            $table->text('message')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->string('cv')->nullable($value = true);
            $table->enum('status', ['1', '0'])->default("1")->comment('[1 => "Enabled", 0 => "Disabled"]');
            $table->enum('quickapply', ['1', '2'])->default("1")->comment('[1 => "Quick Application", 2 => "Detail Application"]');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('job_type')->references('id')->on('job_types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
}
