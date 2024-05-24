<?php

use App\Enums\ActiveEnum;
use App\Enums\QuestionTypeEnum;
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
        Schema::create('bank_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('lesson_id');
            $table->string('question');
            $table->json('answers');
            $table->string('correctAnswer');
            $table->json('images')->nullable();
            $table->enum('QuestionTypeEnum', QuestionTypeEnum::values())->default(QuestionTypeEnum::Choose->value);
            $table->enum('ActiveEnum', ActiveEnum::values())->default(ActiveEnum::Active->value);

            $table->foreign("teacher_id")
                ->references("id")
                ->on("teachers")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("lesson_id")
                ->references("id")
                ->on("lessons")
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
        Schema::dropIfExists('bank_questions');
    }
};
