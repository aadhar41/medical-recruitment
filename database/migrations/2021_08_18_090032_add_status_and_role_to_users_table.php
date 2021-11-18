<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndRoleToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('status', ['1', '0'])->default("0")->comment('[1 => "Enabled", 0 => "Disabled"]')->after('profile_photo_path');
            $table->unsignedBigInteger('role')->default("2")->comment('[0 => "Super Admin",1 => "Admin", 2 => "Jobseeker", 3 => "Medical Center", 4 => "Doctor", 5 => "Nurse", 6 => "Practice Owner", 7 => "Recruiter", 8 => "Clinic", 9 => "Nature Health Care", 10 => "Ayurveda Therapy Center", 11 => "Acupressure Health Care", 12 => "Homeopathic", 13 => "Other"]')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('role');
        });
    }
}
