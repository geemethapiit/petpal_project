<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServiceProviderController;
use App\Http\Controllers\Admin\ServiceTypesController;
use App\Http\Controllers\Admin\SubServiceController;
use App\Http\Controllers\ServiceProvider\ProviderController;
use App\Http\Controllers\ServiceProvider\PetController;
use App\Http\Controllers\Admin\PetsController;
use App\Http\Controllers\Admin\CustomersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 

//front page routes

// route for front page 
Route::get('/', function () {
    return view('frontend.frontpage');
})->name('frontpage');

//routes for frontend pages
Route::get('/frontendabout', function () {
    return view('frontend.about');
})->name('frontendabout');

Route::get('/frontendcontact', function () {
    return view('frontend.contact');
})->name('frontendcontact');

Route::get('/frontendservices', function () {
    return view('frontend.services');
})->name('frontendservices');




// service provider routes

    // rotue for service provider welome page
    Route::get('/welcome-test', function () {
        return view('welcome-test');
    });

    // route for service provider dashboard
    Route::get('/providerdashboard', function () {
        return view('provider.providerdashboard');
    })->name('providerdashboard');

    // route for service provider login
    Route::post('/providerlogin', [ProviderController::class, 'providerlogin'])->name('serviceProvider.login.post');

    // route for service provider logout
    Route::post('/providerlogout', [ProviderController::class, 'providerlogout'])->name('serviceProvider.logout');

    // route for service provider registration
    Route::post('/service-provider-signup', [ProviderController::class, 'store']);


// pet management routes 
            // pet page view 
            Route::get('/viewpetpage', [PetController::class, 'index'])->name('viewpetpage');

            // route for add pet page
            Route::get('/addPet', [PetController::class, 'create'])->name('addPet');

            // view pet records
            Route::get('/pets/{pet}', [PetController::class, 'show'])->name('pets.show');






//Admin routes

    // route for view admin login form
    Route::get('/adminLoginForm', function () {
        return view('admin.adminLoginForm');
    })->name('adminLoginForm');

    // route for view admin signup form
    Route::get('/adminSignUpForm', function () {
        return view('admin.adminSignUpForm');
    })->name('adminSignUpForm');

    // route for admin registration function
    Route::post('/adminregister', [AdminController::class, 'adminregister'])->name('admin.register.post');

    // route for admin login function
    Route::post('/adminlogin', [AdminController::class, 'adminlogin'])->name('admin.login.post');

    // route for admin logout function
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // route for view admin dashboard and display pending requests
    Route::get('/viewadmindashboard', [AdminController::class, 'dashboard'])->name('viewadmindashboard');

    // route for approve request
    Route::post('/approve', [AdminController::class, 'approve'])->name('approve');

    // route for reject request
    Route::post('/reject', [AdminController::class, 'reject'])->name('reject');




// Sub Service routes Admin
            // Route for viewing sub services page
            Route::get('/viewsubservices', [SubServiceController::class, 'index'])->name('viewsubservices');

            // route for add sub service page
            Route::get('/addSubService', [SubServiceController::class, 'create'])->name('addSubService');

            // route for store sub service
            Route::post('/subservices', [SubServiceController::class, 'store'])->name('subservices.store');

            // route for edit sub service page
            Route::get('/subservices/{subservice}/edit', [SubServiceController::class, 'edit'])->name('subservices.edit');

            // route for delete sub service
            Route::delete('/subservices/{subservice}', [SubServiceController::class, 'destroy'])->name('subservices.destroy');

            // Route for updating sub services
            Route::put('/subservices/{subservice}', [SubServiceController::class, 'update'])->name('subservices.update');

            // Route for deleting sub services
            Route::delete('/subservices/{id}', [SubServiceController::class, 'destroy'])->name('subservices.destroy');



// Service Types Routes  Admin
            // Route for viewing service types page
            Route::get('/viewservicetypes', [ServiceTypesController::class, 'index'])->name('viewservicetypes');

            // route for add service type page
            Route::get('/addServiceType', [ServiceTypesController::class, 'create'])->name('addServiceType');

            // route for store service type
            Route::post('/servicetypes', [ServiceTypesController::class, 'store'])->name('servicetypes.store');

            // route for edit service type page
            Route::get('/servicetypes/{servicetype}/edit', [ServiceTypesController::class, 'edit'])->name('servicetypes.edit');

            // route for delete service type
            Route::delete('/servicetypes/{servicetype}', [ServiceTypesController::class, 'destroy'])->name('servicetypes.destroy');

            // Route for updating service types
            Route::put('/servicetypes/{servicetype}', [ServiceTypesController::class, 'update'])->name('servicetypes.update');


// Route for service providers Admin

            // Route for viewing service providers
            Route::get('/viewserviceproviders', [ServiceProviderController::class, 'index'])->name('viewserviceproviders');

            // Route to remove a service provider
            Route::delete('/service-providers/remove/{id}', [ServiceProviderController::class, 'remove'])->name('serviceProvider.remove');

            // route for store service provider
             Route::get('/addServiceProvider', [ServiceProviderController::class, 'create'])->name('addServiceProvider');

            // Route for creating service providers 
            Route::post('/service-providers', [ServiceProviderController::class, 'store'])->name('serviceProviders.store');

            // Route for editing service providers
            Route::get('/service-providers/{serviceProvider}/edit', [ServiceProviderController::class, 'edit'])->name('serviceProvider.edit');


// Route for Pets Admin

            // pet page view 
            Route::get('/viewpetpage', [PetsController::class, 'index'])->name('viewpetpageadmin');

// Route for customers admin

            // Route for viewing pet owners
            Route::get('/viewcustomers', [CustomersController::class, 'index'])->name('viewcustomers');

            // Route to destory a customer
            Route::delete('/customers/remove/{id}', [CustomersController::class, 'destroy'])->name('petowners.destroy');

            // Route for editing a customer
            Route::get('/customers/{customer}/edit', [CustomersController::class, 'edit'])->name('petowners.edit');
            