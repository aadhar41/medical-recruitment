<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToJobSeekerRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_registrations', function (Blueprint $table) {
            $table->string('image')->nullable($value = true)->comment('Profile image for jobseeker.')->after('cv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_registrations', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
