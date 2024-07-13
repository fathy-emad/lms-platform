<?php

namespace App\Http\Controllers\Teacher\Payments;

use Illuminate\Http\Request;
use App\Enums\TeacherPaymentStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "pending" => [
                "cost" => $this->where("TeacherPaymentStatusEnum", TeacherPaymentStatusEnum::Pending->value)->sum("cost"),
                "count" => $this->where("TeacherPaymentStatusEnum", TeacherPaymentStatusEnum::Pending->value)->count(),
            ],
            "in_review" => [
                "cost" => $this->where("TeacherPaymentStatusEnum", TeacherPaymentStatusEnum::INReview->value)->sum("cost"),
                "count" => $this->where("TeacherPaymentStatusEnum", TeacherPaymentStatusEnum::INReview->value)->count(),
            ],
            "on_way" => [
                "cost" => $this->where("TeacherPaymentStatusEnum", TeacherPaymentStatusEnum::ONWay->value)->sum("cost"),
                "count" => $this->where("TeacherPaymentStatusEnum", TeacherPaymentStatusEnum::ONWay->value)->count(),
            ],
            "paid" => [
                "cost" => $this->where("TeacherPaymentStatusEnum", TeacherPaymentStatusEnum::Paid->value)->sum("cost"),
                "count" => $this->where("TeacherPaymentStatusEnum", TeacherPaymentStatusEnum::Paid->value)->count(),
            ],
            "statistics" => StatisticsResource::collection($this->groupBy("course_id"))
        ];
    }
}
