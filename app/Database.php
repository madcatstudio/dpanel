<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    protected $guarded = [];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
