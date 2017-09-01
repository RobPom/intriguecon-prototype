<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //table name
    protected $table = 'games';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    public function timeblocks() {
        return $this->belongsToMany(Timeblock::class);
    }

}

