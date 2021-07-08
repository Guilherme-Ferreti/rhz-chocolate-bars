<?php

namespace App\Http\Resources\Consultation;

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
        $cocoa_batches = $this->cocoa_batches->toarray();

        foreach ($cocoa_batches as &$cocoa_batch) {
            $cocoa_batch = [
                'id' => $cocoa_batch['id'],
                'origin' => $cocoa_batch['origin'],
                'provider' => $cocoa_batch['provider'],
                'grams' => $cocoa_batch['pivot']['grams'],
                'created_at' => $cocoa_batch['created_at'],
                'updated_at' => $cocoa_batch['updated_at'],
                'percentage' => ($cocoa_batch['pivot']['grams'] * 100) / $this->weight,
            ];
        }

        return [
            'id' => $this->id,
            'weight' => $this->weight,
            'code' => $this->code,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'cocoa_batches' => $cocoa_batches,
        ];
    }
}
