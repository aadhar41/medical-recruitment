<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('main_logo')->nullable($value = true);
            $table->string('phone')->nullable($value = true);
            $table->string('email')->nullable($value = true);
            $table->string('web')->nullable($value = true);
            $table->string('fax')->nullable($value = true);
            $table->string('whatsapp')->nullable($value = true);
            $table->string('link')->nullable($value = true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
