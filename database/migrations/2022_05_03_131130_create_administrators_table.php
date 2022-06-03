<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->id("administrator_id")
                  ->unsigned();
            $table->string("username", 64)
                  ->nullable(false)
                  ->unique();
            $table->string("password", 128)
                  ->nullable(false);
            $table->boolean("is_valid")
                  ->default(true);
            $table->enum("role", ["super", "regular"])
                  ->default("regular");
                  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrators');
    }
};
