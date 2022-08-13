<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\MeetingRequest; 

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'title', 'owner', 'owner_type',
        'role_name', 'role_name_sub', 'action_name', 'action_name_sub',
        'start_date', 'status1_end_date', 'status2_end_date'];
    
    protected $dates = [
        'start_date', 'status1_end_date', 'status2_end_date'
    ];

    public function participants()
    {
        return $this->hasMany('App\Models\Participant');
    }    

}
