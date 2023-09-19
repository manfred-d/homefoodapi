<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChefsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'=>$this->id,
            'CooksName'=>$this->CookName,
            'Specialty'=>$this->Specialty,
            'Bio'=>$this->Bio,
            'Ratings'=>$this->Ratings,
            'User'=>$this->UserId
        ];
    }
}
