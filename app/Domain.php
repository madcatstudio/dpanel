<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $guarded = [];
    protected $dates = ['registration_date'];

    public function getFormattedRegistrationDateAttribute()
    {
        return $this->registration_date->format('j/m/Y');
    }

    public function maintainer()
    {
        return $this->belongsTo(Maintainer::class);
    }

    public function hasMaintainer()
    {
        return $this->maintainer();
    }

    public function hosting()
    {
        return $this->belongsTo(Hosting::class);
    }

    public function hasHosting()
    {
        return $this->hosting();
    }

    public function deleteHosting()
    {
        $this->hosting()->dissociate();
        $this->save();
    }

    public function deleteMaintainer()
    {
        $this->maintainer()->dissociate();
        $this->save();
    }

    public function webapps()
    {
        return $this->hasMany(WebApp::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function databases()
    {
        return $this->hasMany(Database::class);
    }

    public function subdomains()
    {
        return $this->hasMany(Subdomain::class);
    }
}
