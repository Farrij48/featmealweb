<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PasienResource extends JsonResource
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
            'email'=>$this->email,
            'password'=>$this->password,
            'name'=>$this->name,
            'gender'=>$this->gender,
            'phone'=>$this->phone,
            'nik'=>$this->nik,
            'address'=>$this->address,
            'gejala'=>$this->gejala,
            'diagnosis'=>$this->diagnosis,
            'avatar'=>env('ASSET_URL')."/uploads/".$this->avatar
        ];
    }
}