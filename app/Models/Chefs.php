<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chefs extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    // mass assign 
    protected $fillable = [
        'CookName',
        'Specialty',
        'Bio',
        'Ratings',
        'User_Id'
    ];
}
