<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "total" => $this->total(),
            "per_page" => $this->perPage(),
            "current_page" => $this->currentPage(),
            "last_page" => $this->lastPage(),
            "first_page_url" => $this->url(1),
            "last_page_url" => $this->url($this->lastPage()),
            "next_page_url" => $this->nextPageUrl(),
            "prev_page_url" => $this->previousPageUrl(),
            "path" => $this->path(),
            "from" => $this->firstItem(),
            "to" => $this->lastItem(),
        ];
    }
}
