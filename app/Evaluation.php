<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'domain', 'semester', 'user_id', 'student_id', 'status', 'created_at', 'class', 'comments'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function student() {
    	return $this->belongsTo('App\Student');
    }

    public function teacher() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function criterion() {
    	return $this->hasMany('App\Criteria');
    }
}
