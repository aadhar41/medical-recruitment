<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuySellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_sells', function (Blueprint $table) {
            $table->id();
            $table->string('unique_code')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->unsignedBigInteger('user_id')->comment('I.D. of user who is creating buy sell post.');
            $table->string('type')->nullable($value = true)->comment('[1 => "Buy", 2 => "Sell"]');
            $table->string('property_type')->nullable($value = true)->comment('[1 => "Medical Center", 2 => "Other"]');
            $table->string('promotional_flag')->nullable($value = true)->comment('["New", "Sale", "Offer"]');
            $table->unsignedMediumInteger('state_id')->comment('I.D. of state where property belongs.');
            $table->unsignedMediumInteger('city_id')->comment('I.D. of city where property belongs.');
            $table->integer('suburb_id')->comment('I.D. of suburb where property belongs.');
            $table->string('price')->nullable($value = true)->comment('Price of property');
            $table->string('title')->nullable($value = true)->comment('Title of the property')->collation('utf8mb4_general_ci');
            $table->string('slug')->nullable($value = true)->comment('SLug for the entry.');
            $table->text('description')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->string('number')->nullable($value = true)->comment('Number to contact for buying / Selling.')->collation('utf8mb4_general_ci');
            $table->string('email')->nullable($value = true)->comment('Email to contact for buying / Selling.')->collation('utf8mb4_general_ci');
            $table->string('rating')->nullable($value = true)->comment('Rating of this property.')->collation('utf8mb4_general_ci');
            $table->string('order')->nullable($value = true)->comment('Order number of this property.')->collation('utf8mb4_general_ci');
            $table->enum('status', ['1', '0'])->default("1")->comment('[1 => "Enabled", 0 => "Disabled"]');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('suburb_id')->references('id')->on('suburbs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buy_sells');
    }
}
