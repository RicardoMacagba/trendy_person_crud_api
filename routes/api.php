<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AppointmentController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Route::apiResource('/register', [AuthController::class, 'register']);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/register', [AuthController::class, 'register']);
//     Route::get('/profile', [ProfileController::class, 'show']);
//     Route::put('/profile', [ProfileController::class, 'update']);
// });

// Route::post('/register', [AuthController::class, 'register']);
// Route::get('/profile', [ProfileController::class, 'show']);
// Route::put('/profile', [ProfileController::class, 'update']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);



//with middleware auth:sanctum, the user must be authenticated to access the routes
Route::middleware('auth:sanctum')->group(function () {
Route::post('/logout', [AuthController::class, 'logout']);

// Jobs
Route::get('/jobs', [JobController::class, 'index']);
Route::post('/jobs', [JobController::class, 'store']);
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::put('/jobs/{job}', [JobController::class, 'update']);
Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

// Job Applications
Route::post('/jobs/{job}/apply', [JobController::class, 'apply']);

// Messages
Route::get('/messages/{job}', [MessageController::class, 'index']);
Route::post('/messages/{job}', [MessageController::class, 'store']);

// Payments
Route::post('/payments/{job}', [PaymentController::class, 'store']);

// Ratings
Route::post('/ratings/{job}', [RatingController::class, 'store']);

// Appointments
Route::post('/appointments', [AppointmentController::class, 'store']);
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update']);

//creating a route for car
Route::post('/makeCar', [CarController::class, 'store']);
Route::get('/getCar', [CarController::class, 'index']);
Route::get('/showCar/{car}', [CarController::class, 'show']);
Route::put('/updateCar/{car}', [CarController::class, 'update']);

// Admin routes with middleware auth:sanctum and role admin
Route::middleware('auth:sanctum')->group(function () {
Route::get('/admin/users', [AdminController::class, 'users']);
Route::get('/admin/jobs', [AdminController::class, 'jobs']);
Route::put('/admin/jobs/{job}/resolve', [AdminController::class, 'resolveJob']);

});
});

//making a car api
// Route::post('/makeCar', [CarController::class, 'store']);
// Route::get('/getCar', [CarController::class, 'index']);
// Route::get('/showCar/{car}', [CarController::class, 'show']);
// Route::put('/updateCar/{car}', [CarController::class, 'update']);
// Route::delete('/deleteCar/{car}', [CarController::class, 'destroy'])->middleware('auth:sanctum');

// Route::middleware('/makeCar')->group(function () {
//     Route::post('/makeCar', [CarController::class, 'storeCar']);
// });
