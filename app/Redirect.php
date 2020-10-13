<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $fillable = [
        'country_id', 'url'
    ];

    protected $casts = [
        'country_id' => 'int',
        'url' => 'string'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
