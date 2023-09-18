<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExplodeWorkshop extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];
    
    function workshop_date($id){
    	$explode = Explode::where('order',  $id)->orderBy('created_at')->first();
    	if(is_null($explode)){
    		return "-";
    	} else{
    		$date = date($explode->created_at);
    		return date('Y/m/d', strtotime($date));
    	}
    	
    }
}
