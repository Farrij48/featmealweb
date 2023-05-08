<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {

        if($this->document == NULL)
        {
            $document = NULL;
        }
        else
        {
            $document = env('ASSET_URL')."/uploads/".$this->document;
        }
        
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'module_type'=>$this->module_type,
            'fille_type'=>$this->file_type,
            'youtube'=>$this->youtube,
            'document'=>$this->$document,
            'order'=>$this->order,
            'view'=>$this->view
        ];
    }
}