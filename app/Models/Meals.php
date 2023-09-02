<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meals extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $fillable = [
        'MealName',
        'Description',
        'Price',
        'Quantity',
        'Ingredients',
        'PreparationTime',
        'MealImage',
        'CategoryId',
        'CookId'

];

}
