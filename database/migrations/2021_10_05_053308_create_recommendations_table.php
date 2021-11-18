<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->string('unique_code')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->unsignedBigInteger('user_id')->comment('I.D. of user who is writing the recommendation.');
            $table->unsignedBigInteger('for')->comment('Recommendation For i.e. MSRA / Medical Center / Recruiter / Clinic');
            $table->unsignedBigInteger('role_id')->comment('Role of user who is writing the recommendation.');
            $table->string('title')->nullable($value = true)->collation('utf8mb4_general_ci');;
            $table->string('slug')->nullable($value = true);
            $table->text('description')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->string('rating')->nullable($value = true)->comment('For Upvotes / Rating Given by other user.')->collation('utf8mb4_general_ci');
            $table->enum('status', ['1', '0'])->default("1")->comment('[1 => "Enabled", 0 => "Disabled"]');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('for')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recommendations');
    }
}
