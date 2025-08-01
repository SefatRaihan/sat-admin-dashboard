<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeatureSliderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'cta_text' => $this->cta_text,
            'cta_link' => $this->cta_link,
            'items' => FeatureSliderItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
