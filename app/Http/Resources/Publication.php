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
            'name' => $this->name,
            'location' => $this->location,
            'phone' => $this->phone,
            'email' => $this->email,
            'hour' => $this->hour,
            'publication_date' => $this->publication_date,
            'type' => $this->type,
            'details' => $this->details,
            'image' => $this->image,
            'category'=>'/api/category/' . $this->category_id,
            //'category' => new Category($this->category),
            //'category_name'=>$this->category->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
