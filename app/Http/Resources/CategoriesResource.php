<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
{
    public $preserveKeys = true;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return  [
            'id'=>$this->id,
            'CategoryName'=>$this->CategoryName,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}
