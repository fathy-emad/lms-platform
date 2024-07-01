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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("invoice_id");
            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("payment_id");
            $table->unsignedBigInteger("course_id");
            $table->timestamp("expired_at");
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
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
