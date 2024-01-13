<?php

use App\Enums\ActiveEnum;
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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('SubjectEnumTable');
            $table->json('icon')->nullable();
            $table->enum('ActiveEnum', ActiveEnum::values())->default(ActiveEnum::Active->value);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign("year_id")
                ->references("id")
                ->on("years")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("SubjectEnumTable")
                ->references("id")
                ->on("enumerations")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("created_by")
                ->references("id")
                ->on("admins")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("updated_by")
                ->references("id")
                ->on("admins")
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
        Schema::dropIfExists('subjects');
    }
};
