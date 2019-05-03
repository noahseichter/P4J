<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'evaluation_id', 'score', 'field_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function evaluation() {
    	return $this->belongsTo('App\Evaluation');
    }

}
