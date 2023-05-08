<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResepResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'category'=>$this->category->name,
            'chef'=>$this->user->name,
            'title'=>$this->title,
            'description'=>$this->description,
            'group'=>$this->group,
            'thumbnail'=>env('ASSET_URL')."/uploads/".$this->thumbnail
        ];  
    }
}