<?php

use App\Enums\ActiveEnum;
use App\Enums\FreeEnum;
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
        Schema::create('course_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("course_id");
            $table->unsignedBigInteger('lesson_id');
            $table->unsignedBigInteger('description');
            $table->string('video')->nullable();
            $table->json('images')->nullable();
            $table->json('files')->nullable();
            $table->json('assignments')->nullable();
            $table->enum('ActiveEnum', ActiveEnum::values())->default(ActiveEnum::Active->value);
            $table->enum('FreeEnum', FreeEnum::values())->default(FreeEnum::NotFree->value);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign("course_id")
                ->references("id")
                ->on("courses")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("lesson_id")
                ->references("id")
                ->on("lessons")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("description")
                ->references("id")
                ->on("translates")
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
        Schema::dropIfExists('course_materials');
    }
};
