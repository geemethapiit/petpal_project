<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\petownersController;
use App\Http\Controllers\Api\PetsController;
use App\Http\Controllers\Api\LabRecordsController;
use App\Http\Controllers\Api\VaccinationController;
use App\Http\Controllers\Api\MedicationController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\ServiceTypeController;
use App\Http\Controllers\Api\FeedbackController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// pet owner registration
Route::post('/auth/register', [petownersController::class, 'register']);

// pet owner login
Route::post('/auth/login', [petownersController::class, 'login']);



// pets management
Route::middleware('auth:sanctum')->group(function () {
    //pet registration
    Route::post('/pets/register', [PetsController::class, 'register']);

    //pet update
    Route::put('/pets/update/{id}', [PetsController::class, 'update']);

    //pet delete
    Route::delete('/pets/delete/{id}', [PetsController::class, 'delete']);

    //pet list
    Route::get('/pets/list', [PetsController::class, 'list']);

    // pet name list 
    Route::get('/pets/names', [PetsController::class, 'nameList']);
});


// medical recordds management
Route::middleware('auth:sanctum')->group(function () {
    // lab records
    Route::get('/lab-records/{pet_id}', [LabRecordsController::class, 'list']);

    // vaccination records
    Route::get('/vaccinations/{pet_id}', [VaccinationController::class, 'list']);

    // medication records
    Route::get('/medications/{pet_id}', [MedicationController::class, 'list']);
});



// appointment management
Route::middleware('auth:sanctum')->group(function () {
    // available slots
    Route::get('/slots/available', [AppointmentController::class, 'availableSlots']);

    // book appointment
    Route::post('/appointment/book', [AppointmentController::class, 'bookAppointment']);

    // cancel appointment
    Route::delete('/appointment/cancel/{id}', [AppointmentController::class, 'cancelAppointment']);
    
    // upcoming appointments
    Route::get('/appointments/upcoming', [AppointmentController::class, 'upcomingAppointments']);

    // past appointments
    Route::get('/appointments/past', [AppointmentController::class, 'pastAppointments']);
});


// display service types
Route::get('/service-types', [ServiceTypeController::class, 'list']);

// feedback
Route::middleware('auth:sanctum')->group(function () {
    // create feedback
    Route::post('/feedback/create', [FeedbackController::class, 'create']);
});