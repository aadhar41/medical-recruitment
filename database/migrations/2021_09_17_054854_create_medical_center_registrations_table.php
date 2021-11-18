<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalCenterRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_center_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('unique_code')->nullable($value = true);
            $table->unsignedBigInteger('user_id');
            $table->string('mobile')->nullable($value = true);
            $table->string('fax')->nullable($value = true);
            $table->string('slug')->nullable($value = true);
            $table->text('address')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->unsignedMediumInteger('state')->nullable($value = true)->comment('Location / State');
            $table->unsignedMediumInteger('city')->nullable($value = true);
            $table->integer('suburb')->nullable($value = true);
            $table->string('postcode')->nullable($value = true);
            $table->string('attachment')->nullable($value = true);
            $table->string('image')->nullable($value = true);
            $table->string('token')->nullable($value = true);
            $table->enum('status', ['1', '0'])->default("1")->comment('[1 => "Enabled", 0 => "Disabled"]');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('medical_center_registrations');
    }
}
