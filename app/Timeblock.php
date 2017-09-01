<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeblock extends Model
{
    public function games() {
        return $this->belongsToMany(Timeblock::class);
    }
}
