<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdomain extends Model
{
    protected $guarded = [];

    public function getFullUrlAttribute()
    {
        return 'http://' . $this->name . '.' . $this->domain->name;
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

}
