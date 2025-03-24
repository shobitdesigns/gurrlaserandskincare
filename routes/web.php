<?php

use App\Http\Controllers\cms\AppointmentController;
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
Route::get('/',                         [DashboardController::class,'index'])->name('dashboard');
Route::get('/about',                    [DashboardController::class,'about'])->name('about');
Route::get('/contact-us',               [DashboardController::class,'contact'])->name('contact');
Route::get('/service',                  [DashboardController::class,'service'])->name('services');
Route::get('/laser-service/{id}',       [DashboardController::class,'laserServiceDetail'])->name('laserServiceDetail');
Route::get('/book-appointment',         [DashboardController::class,'bookAppointment'])->name('bookAppointment');


Route::post('submit-enquiry',           [EnquiryController::class,'storeEnquiry'])->name('storeEnquiry');
Route::post('appintment-store',         [AppointmentController::class,'store'])->name('appointmentStore');
Route::post('/check-appointment',       [AppointmentController::class, 'checkAppointment'])->name('checkAppointment');


require __DIR__.'/auth.php';
