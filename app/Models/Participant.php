<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['meeting_id', 'name', 'owner_type', 
        'role_name', 'role_name_sub',
        'action_name', 'action_name_sub',
        'meeting_title_open', 'role_open', 'action_open'];

    public function meeting()
    {
        return $this->belongsTo('App\Models\Meeting');
    }
}
