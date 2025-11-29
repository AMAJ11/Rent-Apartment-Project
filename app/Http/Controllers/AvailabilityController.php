<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    //

    
    //مشان اعرض الاوقات المحجوزة فيها الشقة للمستخدم
    //رسالة للفرونت لا تخلي اليوزر يققدر يحجز بالاوقات لبرجعلك ياها
    // public function showAvailabilty(int $apartment_id) {
    //     $bookings = Availability::where('aprtment_id',$apartment_id)->get();
    //     return response()->json($bookings,200);
    // }
}
