<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    // mass assignment fillable
    protected $fillable = [
        'Amount',
        'Status',
        'OrderDate',
        'UserId'
    ];
}
