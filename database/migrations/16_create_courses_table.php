<?php

use App\Enums\ActiveEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("teacher_id");
            $table->unsignedBigInteger('curriculum_id');
            $table->unsignedBigInteger('title');
            $table->unsignedBigInteger('description');
            $table->json('cost');
            $table->float('percentage');
            $table->enum('ActiveEnum', ActiveEnum::values())->default(ActiveEnum::Active->value);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();

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

            $table->foreign("title")
                ->references("id")
                ->on("translates")
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
        Schema::dropIfExists('courses');
    }
};
