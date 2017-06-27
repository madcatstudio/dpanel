<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $guarded = [];

    public function getFullNameAttribute()
    {
        return $this->name . '@' . $this->domain->name;
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
