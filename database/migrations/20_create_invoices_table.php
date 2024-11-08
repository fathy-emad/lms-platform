<?php

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentServiceEnum;
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
            $table->enum('PaymentServiceEnum', PaymentServiceEnum::values());
            $table->enum('PaymentMethodEnum', PaymentMethodEnum::values());
            $table->json("paymentData")->nullable();
            $table->float("totalCost");
            $table->unsignedInteger("itemCount");
            $table->foreign("student_id")
                ->references("id")
                ->on("students")
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedBigInteger("created_by");
            $table->foreign("created_by")
                ->references("id")
                ->on("admins")
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->string("transactionTo");
            $table->enum('PaymentStatusEnum', \App\Enums\PaymentStatusEnum::values());
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
