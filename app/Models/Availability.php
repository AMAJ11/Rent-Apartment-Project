<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    //
    protected $guarded = ['id'];

    public function apartment() {
        return $this->belongsTo(Apartment::class);
    }
}
