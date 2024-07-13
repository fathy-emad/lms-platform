<?php

namespace App\Http\Controllers\Teacher\Payments;

use App\Http\Resources\TranslationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class StatisticsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $curriculum = $this->first()->course->curriculum;
        return [
            "stage" => new TranslationResource($curriculum->subject->year->stage->stageTranslate),
            "year" => new TranslationResource($curriculum->subject->year->yearTranslate),
            "course" => new TranslationResource($curriculum->curriculumTranslate),
            "count" => $this->count(),
            "cost" => $this->sum("cost")
        ];
    }
}
