<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/login', function () {
    return view('login'); 
})->name('login');

Route::post('loginAdmin', [UserController::class, 'loginAdmin']);



    Route::middleware(['auth', 'Role:admin'])->group(function () {
        Route::get('getAllTemporaryUsers', [UserController::class, 'temporaryIndex'])->name('getAllTemporaryUsers');
        Route::post('acceptUser/{id}', [UserController::class, 'acceptUser']);
        Route::get('allusers', [UserController::class, 'index']);
        Route::delete('deleteUser/{id}', [UserController::class, 'destroy']);
        Route::delete('deleteApartment/{id}', [UserController::class, 'destroyappartment']);
        Route::post('increaseBalance/{id}',[UserController::class, 'addBalance']);
        Route::get('/admin', function () {
    return view('dashboard.shell');
});
Route::post('/logout', function () {
    Auth::logout(); 
    request()->session()->invalidate(); 
    request()->session()->regenerateToken();
    
    return redirect('/login'); 
})->name('logout');
Route::get('/admin/content/{page}', function ($page) {


    if (!view()->exists("dashboard.pages.$page")) {
        abort(404);
    }
$apartments = DB::table('apartments')->get();
$images = DB::table('images')
    ->whereIn('id', function ($query) {
        $query->select(DB::raw('MIN(id)'))
              ->from('images')
              ->groupBy('apartment_id');
    })
    ->pluck('image', 'apartment_id');

$users = DB::table('users')
            ->where('role', '!=', 'admin')
            ->get();
    $Temporaryusers = DB::table('temporary_users')->get();
    return view("dashboard.pages.$page", compact('Temporaryusers','users','apartments','images'));
    
});
    });