<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Publication extends JsonResource
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
            'affair' => $this->affair,
            'details' => $this->details,
            'hour' => $this->hour,
            'location' => $this->location,
            'phone' => $this->phone,
            'publication_date' => $this->publication_date,
            'category'=>'/api/category/' . $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
