<?php

use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('national_id');

            $table->enum('AdminRoleEnum', [AdminRoleEnum::values()])->default(AdminRoleEnum::Administrator->value);
            $table->enum('GenderEnum', [GenderEnum::values()])->default(GenderEnum::Male->value);
            $table->enum('AdminStatusEnum', [AdminStatusEnum::values()])->default(AdminStatusEnum::Pending->value);

            $table->string('block_reason')->nullable();
            $table->json('image')->nullable();
            $table->json('address')->nullable();
            $table->boolean('online')->default(false);

            $table->string('password');
            $table->longText('jwtToken')->nullable();
            $table->string('verifyToken')->nullable();

            $table->unsignedBigInteger('country_id');
            //$table->unsignedBigInteger('permission_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign("country_id")
                ->references("id")
                ->on("countries")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            /*$table->foreign("permission_id")
                ->references("id")
                ->on("permissions")
                ->restrictOnDelete()
                ->cascadeOnUpdate();*/

            $table->foreign("created_by")
                ->references("id")
                ->on("users")
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign("updated_by")
                ->references("id")
                ->on("users")
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
        Schema::dropIfExists('admins');
    }
};
