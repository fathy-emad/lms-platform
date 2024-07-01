<?php

use App\Enums\TeacherPaymentStatusEnum;
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
        Schema::create('teacher_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("invoice_id");
            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("payment_id");
            $table->unsignedBigInteger("course_id");
            $table->unsignedBigInteger("teacher_id");
            $table->unsignedBigInteger("enrollment_id");
            $table->float("cost");
            $table->enum("status", TeacherPaymentStatusEnum::values())->default(TeacherPaymentStatusEnum::Pending->value);

            $table->foreign("invoice_id")
                ->references("id")
                ->on("invoices")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("student_id")
                ->references("id")
                ->on("students")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("payment_id")
                ->references("id")
                ->on("payments")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("course_id")
                ->references("id")
                ->on("courses")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("teacher_id")
                ->references("id")
                ->on("teachers")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("enrollment_id")
                ->references("id")
                ->on("enrollments")
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
        Schema::dropIfExists('teacher_payments');
    }
};
