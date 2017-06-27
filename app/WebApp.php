<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebApp extends Model
{
    protected $guarded = [];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
