<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reviews extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    // mass asignment
    protected $fillable =[
        'Cook_Id',
        'User_Id',
        'Rating',
        'Comment',
    ];
}
