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
        Schema::create('users', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            
            $table->id("user_id")
                  ->unsigned();

            $table->string('email', 128)
                  ->unique()
                  ->nullable(false);

            $table->string('username', 64)
                  ->unique()
                  ->nullable(false);

            $table->string('password', 128)
                  ->nullable(false);

            $table->boolean("is_active")->default(true);

            $table->rememberToken();
            
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
        Schema::dropIfExists('users');
    }
};
