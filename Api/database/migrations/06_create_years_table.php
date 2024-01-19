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
        Schema::create('years', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('stage_id');
            $table->unsignedBigInteger('YearEnumTable');
            $table->enum('ActiveEnum', ActiveEnum::values())->default(ActiveEnum::Active->value);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign("stage_id")
                ->references("id")
                ->on("stages")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("YearEnumTable")
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
        Schema::dropIfExists('years');
    }
};
