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
        Schema::create('posts', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id("post_id")
                  ->unsigned();

            $table->string("title", 128)
                  ->nullable(false);

            $table->text("body")
                  ->nullable(false);

            $table->foreignId("category_id")
                  ->nullable(false)
                  ->unsigned()
                  ->constrained("categories", "category_id")
                  ->onUpdate("cascade")
                  ->onDelete("restrict");

            $table->foreignId("user_id")
                  ->nullable(false)
                  ->unsigned()
                  ->constrained("users", "user_id")
                  ->onUpdate("cascade")
                  ->onDelete("restrict");

            $table->string("image_path", 255)
                  ->nullable();
                  
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
        Schema::dropIfExists('posts');
    }
};
