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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curriculum_id');
            $table->unsignedBigInteger('teacher_id');
            $table->json('costs'); //for course or branch or chapter or lesson
            $table->enum('ActiveEnum', ActiveEnum::values())->default(ActiveEnum::Active->value);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign("curriculum_id")
                ->references("id")
                ->on("curricula")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("teacher_id")
                ->references("id")
                ->on("teachers")
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
        Schema::dropIfExists('courses');
    }
};
