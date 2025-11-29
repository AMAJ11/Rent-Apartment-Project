<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    //
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reveiws() {
        return $this->hasMany(Reveiw::class);
    }

    public function availability() {
        return $this->hasMany(Availability::class);
    }

    public function favoritedBy() {
        return $this->belongsToMany(User::class,'favorites');
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
    
}
