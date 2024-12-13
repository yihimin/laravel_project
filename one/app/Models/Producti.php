<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producti extends Model
{
    use HasFactory;

    protected $table = 'producti'; // 테이블 이름
    protected $fillable = ['name', 'description', 'price', 'stock', 'image_path'];
}
