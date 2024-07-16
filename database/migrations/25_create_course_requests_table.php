<?php

use App\Enums\TeacherCourseRequestStatusEnum;
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
        Schema::create('course_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("teacher_id");
            $table->unsignedBigInteger("curriculum_id");
            $table->enum("TeacherCourseRequestStatusEnum", TeacherCourseRequestStatusEnum::values())->default(TeacherCourseRequestStatusEnum::Pending->value);
            $table->foreign("teacher_id")
                ->references("id")
                ->on("teachers")
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreign("curriculum_id")
                ->references("id")
                ->on("curricula")
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
        Schema::dropIfExists('course_requests');
    }
};
