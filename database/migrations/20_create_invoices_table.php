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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string("serial")->unique();
            $table->unsignedBigInteger("student_id");
            $table->string("paymentService")->nullable();
            $table->json("paymentData")->nullable();
            $table->float("totalCost");
            $table->unsignedInteger("itemCount");
            $table->foreign("student_id")
                ->references("id")
                ->on("students")
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
        Schema::dropIfExists('invoices');
    }
};
