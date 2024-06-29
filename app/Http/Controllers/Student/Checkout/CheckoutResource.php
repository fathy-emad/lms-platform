<?php

namespace App\Http\Controllers\Student\Checkout;

use App\Http\Resources\TranslationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckoutResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "student_id" => $this->student_id,
            "course" => [
                "title" => new TranslationResource($this->course->curriculum->curriculumTranslate),
                "cost" => $this->course->cost["course"]
            ],
            "teacher" => [
                "name" => $this->course->teacher->prefix->value ."/ " . $this->course->teacher->name,
                "stage" => new TranslationResource($this->course->teacher->stage->stageTranslate),
                "subject" => new TranslationResource($this->course->teacher->subject->subjectTranslate),
                "image" => asset("uploads/".$this->course->teacher->image["file"])
            ],
        ];
    }
}
