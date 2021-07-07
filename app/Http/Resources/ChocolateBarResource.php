<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChocolateBarResource extends JsonResource
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
            'weight' => $this->weight,
            'code' => $this->code,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'cocoa_batches' => CocoaBatchResource::collection($this->whenLoaded('cocoa_batches')),
            'pivot' => $this->whenPivotLoaded('chocolate_bar_cocoa_batch', function () {
                return $this->pivot;
            }),
        ];
    }
}
