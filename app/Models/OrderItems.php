<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItems extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    // mass asignment
    protected $fillable =[
        'Order_Id',
        'Meal_Id',
        'Quantity',
        'SubTotal'
    ];
}
