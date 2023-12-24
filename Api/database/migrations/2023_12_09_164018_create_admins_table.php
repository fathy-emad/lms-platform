<?php

use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('roleEnum');
            $table->string('genderEnum')->default('male');
            $table->string('statusEnum')->default('pending');
            $table->string('block_reason')->nullable();
            $table->boolean('online')->default(false);
            $table->string('national_id')->nullable();
            $table->string('timezone')->nullable();
            $table->json('image')->nullable();
            $table->json('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('jwtToken')->nullable();
            $table->string('verifyToken')->nullable();

            $table->foreignId("country_id")
                ->constrained("countries")
                ->cascadeOnDelete()
                ->restrictOnDelete();

            $table->foreignId("created_by")
                ->constrained("admins")
                ->cascadeOnDelete()
                ->restrictOnDelete();

            $table->foreignId("updated_by")->nullable()
                ->constrained("admins")
                ->cascadeOnDelete()
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
