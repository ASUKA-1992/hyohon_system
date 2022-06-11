<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['meeting_id', 'name',
        'role_name', 'role_name_sub',
        'action_name', 'action_name_sub'];
}
