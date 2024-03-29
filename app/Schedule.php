<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //table name
    protected $table = 'schedules';
    //Primary Key
    public $primaryKey = 'id';

    public function timeblocks() 
    {
        return $this->hasMany('App\Timeblock');
    }
}
