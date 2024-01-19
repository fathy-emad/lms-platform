<?php

use App\Enums\GenderEnum;
use App\Enums\TeacherStatusEnum;
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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('NamePrefixEnumTable');
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();

            $table->enum('GenderEnum', GenderEnum::values())->default(GenderEnum::Male->value);
            $table->enum('TeacherStatusEnum', TeacherStatusEnum::values())->default(TeacherStatusEnum::Pending->value);
            $table->string('block_reason')->nullable();

            $table->json("SubjectsEnumTable");

            $table->json('image');
            $table->json('contract')->nullable();
            $table->boolean('online')->default(false);

            $table->string('password');
            $table->longText('jwtToken')->nullable();
            $table->string('verifyToken')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign("NamePrefixEnumTable")
                ->references("id")
                ->on("enumerations")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("country_id")
                ->references("id")
                ->on("countries")
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

            $table->timestamp('email_verified_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
