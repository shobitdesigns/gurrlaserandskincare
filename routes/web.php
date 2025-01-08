<?php

use App\Http\Controllers\cms\EnquiryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return redirect(route('login'));
// });
Route::get('/',             [DashboardController::class,'index'])->name('dashboard');
Route::get('/about',        [DashboardController::class,'about'])->name('about');
Route::get('/contact-us',   [DashboardController::class,'contact'])->name('contact');
Route::get('/service',      [DashboardController::class,'service'])->name('services');


Route::post('submit-enquiry',       [EnquiryController::class,'storeEnquiry'])->name('storeEnquiry');



require __DIR__.'/auth.php';
