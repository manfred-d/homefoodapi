<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealsResource extends JsonResource
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
        return [
            'id'=>$this->id,
            'MealName'=>$this->MealName,
            'Description'=>$this->Description,
            'Price'=>$this->Price,
            'Quantity'=>$this->Quantity,
            'Ingredients'=>$this->Ingredients,
            'Preparationtime'=>$this->PreparationTime,
            'MealImage'=>$this->MealImage,
            'CategoryId'=>$this->CategoryId,
            'CookId'=>$this->CookId,
            'CreatedAt'=>$this->created_at,
        ];
    }
}
