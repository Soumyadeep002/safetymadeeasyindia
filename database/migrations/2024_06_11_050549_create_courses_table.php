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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string("course_title");
            $table->string("tutor")->default("Safetymadeeasy, India");
            $table->string("subject")->default("Course Subject");
            $table->string("image")->default("course.webp");
            $table->longText("course_para_1")->default("this is about the course");
            $table->longText("course_para_2")->nullable();
            $table->longText("course_para_3")->nullable();
            $table->longText("course_para_4")->nullable();
            $table->string("level")->default("Beginner");
            $table->string("duration")->default("6 hours 15 minutes");
            $table->string("students")->default("100");
            $table->text("question_1")->default("is this course really helpfull ?");
            $table->text("ans_1")->default("This course is highly beneficial, providing practical skills and in-depth knowledge relevant to the field. It enhances your expertise, boosts career prospects, and offers hands-on experience through real-world projects.");
            $table->text("question_2")->nullable();
            $table->text("ans_2")->nullable();
            $table->text("question_3")->nullable();
            $table->text("ans_3")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
