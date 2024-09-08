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
        Schema::table('courses', function (Blueprint $table) {
            $table->longText("course_para_5")->nullable()->after('course_para_4');
            $table->longText("course_para_6")->nullable()->after('course_para_5');
            $table->longText("course_para_7")->nullable()->after('course_para_6');
            $table->longText("course_para_8")->nullable()->after('course_para_7');
            $table->longText("course_para_9")->nullable()->after('course_para_8');
            $table->longText("course_para_10")->nullable()->after('course_para_9');
            $table->longText("course_para_11")->nullable()->after('course_para_10');
            $table->longText("course_para_12")->nullable()->after('course_para_11');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            //
        });
    }
};
