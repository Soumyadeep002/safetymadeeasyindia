<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string("blog_title")->default("Blog Title");
            $table->string("blog_type")->default("Educational");
            $table->string("blog_para_1")->default("This is blog paragraph");
            $table->string("blog_para_2")->nullable();
            $table->string("blog_para_3")->nullable();
            $table->string("author")->nullable("Blog Writter");
            $table->string("date")->default("June 26, 2024");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
