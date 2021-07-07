<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CocoaBatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'provider' => $this->provider,
            'origin' => $this->origin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'pivot' => $this->whenPivotLoaded('chocolate_bar_cocoa_batch', function () {
                return $this->pivot;
            }),
        ];
    }
}
