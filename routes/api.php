<?php

use App\Http\Controllers\API\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/v1')->group(function(){

    # start Sections api
        Route::post('/delegates/{id}/{rid}', [ApiController::class , 'delete']);
        // Route::post('/district', [ApiController::class , 'Districtfind']);
        // Route::post('/division', [ApiController::class , 'Divisionfind']);
        // Route::post('/import/member', [ApiController::class , 'MemberImport']);
        // Route::post('/executive/committee', [ApiController::class , 'ExecutiveCommitteeImport']);
        Route::post('/hotel-room-reservation', [ApiController::class , 'Hotelreservation']);

        Route::post('/delegate-registration', [ApiController::class , 'DelegateRegistration']);
        Route::post('/spot-delegate-registration', [ApiController::class , 'SpotToDelegateRegistration']);
        
        Route::post('/sopaadvertisement-release-form', [ApiController::class , 'AdvertisementForm']);

        Route::post('/exibihition-hall-booking', [ApiController::class , 'ExibihitionBooking']);
        
        Route::get('/export-delegates', [ApiController::class , 'ExportDelegates']);

        Route::get('/export-delegate-ragistration', [ApiController::class , 'ExportDeletegateRegistation']);
        
        Route::get('/getTransition/{id}', [ApiController::class , 'getTransition']);
        
        Route::get('/export-stalls', [ApiController::class , 'ExportStalls']);

        Route::get('/export-advertisement', [ApiController::class , 'ExportAdvertisement']);
        
        Route::get('/export-rooms', [ApiController::class , 'ExportRooms']);
        Route::get('/badge-print/{id}', [ApiController::class , 'BadgePrintAction']);
        
        
    # end Sections api

    
   
    # start Query api
        // Route::get('/query', [QueryController::class , 'getUser']);
        // Route::get('/query/{id}', [QueryController::class , 'getUserById']);
        // Route::post('/query', [QueryController::class , 'create']);
        // Route::put('/query/{id}', [QueryController::class , 'update']);
        // Route::delete('/query/{id}', [QueryController::class , 'delete']);
    # end Query api
    

});
