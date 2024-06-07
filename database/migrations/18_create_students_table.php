<?php

use App\Enums\GenderEnum;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->date("born")->nullable();
            $table->enum('GenderEnum', GenderEnum::values())->default(GenderEnum::Male->value);
            $table->json('image')->nullable();
            $table->json('address')->nullable();
            $table->string("school")->nullable();
            $table->boolean('online')->default(false);

            $table->string('password');
            $table->longText('jwtToken')->nullable();
            $table->string('verifyToken')->nullable();

            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign("country_id")
                ->references("id")
                ->on("countries")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
