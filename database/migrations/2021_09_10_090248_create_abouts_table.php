<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('description')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('right_h_1')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('right_h_2')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('right_h_3')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('right_h_4')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('right_p_1')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('right_p_2')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('right_p_3')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('right_p_4')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->string('aboutcontent_image')->nullable($value = true);
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
        Schema::dropIfExists('abouts');
    }
}
