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
        Schema::create('comments', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id("comment_id")
                  ->unsigned();

            $table->text("body")
                  ->nullable(false);

            $table->foreignId("post_id")
                  ->nullable(false)
                  ->unsigned()
                  ->constrained("posts", "post_id")
                  ->onUpdate("cascade")
                  ->onDelete("restrict");

            $table->foreignId("user_id")
                  ->nullable(false)
                  ->unsigned()
                  ->constrained("users", "user_id")
                  ->onUpdate("cascade")
                  ->onDelete("restrict");

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
        Schema::dropIfExists('comments');
    }
};
