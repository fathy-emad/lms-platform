<?php

namespace App\Http\Controllers\WebServices\Enums;

use ApiResponse;
use App\Enums\ActiveEnum;
use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
use App\Enums\GenderEnum;
use App\Enums\SystemConstantsEnum;
use App\Enums\TeacherStatusEnum;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class EnumsController extends Controller
{
    public function activeStatus(): JsonResponse
    {
        $translations = collect(ActiveEnum::cases())->map(fn($case) => new TranslationResource($case, true));
        return ApiResponse::sendSuccess($translations, "record read successfully", null);
    }

    public function adminRole(): JsonResponse
    {
        $translations = collect(AdminRoleEnum::cases())->map(fn($case) => new TranslationResource($case, true));
        return ApiResponse::sendSuccess($translations, "record read successfully", null);
    }

    public function adminStatus(): JsonResponse
    {
        $translations = collect(AdminStatusEnum::cases())->map(fn($case) => new TranslationResource($case, true));
        return ApiResponse::sendSuccess($translations, "record read successfully", null);
    }

    public function genderStatus(): JsonResponse
    {
        $translations = collect(GenderEnum::cases())->map(fn($case) => new TranslationResource($case, true));
        return ApiResponse::sendSuccess($translations, "record read successfully", null);
    }

    public function teacherStatus(): JsonResponse
    {
        $translations = collect(TeacherStatusEnum::cases())->map(fn($case) => new TranslationResource($case, true));
        return ApiResponse::sendSuccess($translations, "record read successfully", null);
    }

    public function systemConstants(): JsonResponse
    {
        $systemConstants = collect(SystemConstantsEnum::cases())->map(fn($case) => new TranslationResource($case, true));
        return ApiResponse::sendSuccess($systemConstants, "record read successfully", null);
    }
}
