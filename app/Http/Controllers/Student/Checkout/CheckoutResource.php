<?php

namespace App\Http\Controllers\Student\Checkout;

use App\Http\Controllers\AuthStudent\Resources\LoginResource;
use App\Http\Controllers\Course\Register\CourseResource;
use App\Http\Resources\DateTimeResource;
use App\Models\Cart;
use App\Models\Student;
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

        $totalCost = Cart::where('student_id', $this->student->id)
            ->join('courses', 'carts.course_id', '=', 'courses.id')
            ->sum('courses.cost->course');

        return [
            "id" => $this->id,
            "student" => new LoginResource($this->student),
            "course" => new CourseResource($this->course),
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
            "total" => $totalCost
        ];
    }
}
