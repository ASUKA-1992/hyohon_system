<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explode extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'note', 'place', 'speed', 'quantity', 'size', 'front_bigger', 'colors', 'count', 'order'];
}
