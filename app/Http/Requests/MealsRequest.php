<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MealsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'MealName' => 'required',
            'Description' =>'required',
            'Price'=>'required|numeric',
            'Quantity' => 'required|numeric',
            'Ingredients'=>'required',
            'PreparationTime'=>'required',
            'MealImage'=>'required|image',
            'CategoryId'=>'required',
            'CookId'=>'required'
        ];
    }
}
