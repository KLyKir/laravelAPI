<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public static $wrap = 'event';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'notes' => $this->notes,
            'dateStart' => $this->dt_start,
            'dateEnd' => $this->dt_end
        ];
    }
}
