<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'birth_date', 'site', 'start_date', 'EC', 'EL', 'IEP_Speech', 'class'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function teachers() {
    	return $this->belongsToMany('App\User');
    }

    public function evaluations() {
        return $this->hasMany('App\Evaluation');
    }
}
