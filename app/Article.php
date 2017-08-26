<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //table name
    protected $table = 'articles';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
