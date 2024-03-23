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
        Schema::create('curricula', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subject_id");
            $table->unsignedBigInteger("CurriculumEnumTable");
            $table->json("TermsEnumTable"); //ex:first terms or second term or both
            $table->json("TypesEnumTable"); //ex:general, languages, azhar
            $table->enum('ActiveEnum', ActiveEnum::values())->default(ActiveEnum::Active->value);
            $table->json('period'); //start { day, month } end { day, month }
            $table->integer('priority');

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign("subject_id")
                ->references("id")
                ->on("subjects")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("CurriculumEnumTable")
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
        Schema::dropIfExists('curricula');
    }
};
