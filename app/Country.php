<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function redirects()
    {
        return $this->hasMany(Redirect::class);
    }
}
