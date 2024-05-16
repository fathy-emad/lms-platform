<?php

use App\Enums\GenderEnum;
use App\Enums\NamePrefixEnum;
use App\Enums\TeacherStatusEnum;
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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->enum("prefix", NamePrefixEnum::values())->default(NamePrefixEnum::Mr->value);
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('national_id')->nullable();

            $table->enum('GenderEnum', GenderEnum::values())->default(GenderEnum::Male->value);
            $table->enum('TeacherStatusEnum', TeacherStatusEnum::values())->default(TeacherStatusEnum::Pending->value);

            $table->string('block_reason')->nullable();
            $table->json('image')->nullable();
            $table->json('address')->nullable();
            $table->json('contract')->nullable();
            $table->boolean('online')->default(false);

            $table->string('password');
            $table->longText('jwtToken')->nullable();
            $table->string('verifyToken')->nullable();

            $table->unsignedBigInteger('stage_id')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign("country_id")
                ->references("id")
                ->on("countries")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("stage_id")
                ->references("id")
                ->on("stages")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("subject_id")
                ->references("id")
                ->on("subjects")
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
