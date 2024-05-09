<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DateTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $timezone = auth('admin')->user()->country->timezone ?? "EET";
        return [
            "timestamp" => $this->resource,
            "dateTime" => Carbon::parse($this->resource)->timezone($timezone)->format('d/n/Y g:i A'),
        ];
    }
}
