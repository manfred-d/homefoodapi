<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chefs extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    // mass assign 
    protected $fillable = [
        'CookName',
        'Specialty',
        'Bio',
        'Ratings',
        'UserId'
    ];
}
