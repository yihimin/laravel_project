<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jangbu extends Model
{
    use HasFactory;

    protected $fillable =[
        'io',
        'writeday',
        'products_id',
        'price',
        'numi',
        'numo',
        'prices',
        'bigo'
        ];
}
