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
        Schema::create('assignment_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("lesson_id");
            $table->unsignedBigInteger("bank_question_id");
            $table->string("answer")->nullable();

            $table->foreign("student_id")
                ->references("id")
                ->on("students")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("lesson_id")
                ->references("id")
                ->on("lessons")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("bank_question_id")
                ->references("id")
                ->on("bank_questions")
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_results');
    }
};
