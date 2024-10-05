<?php

use App\Http\Controllers\About;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\AdvertisementReleaseController;
use App\Http\Controllers\Admin\AttendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DelegateController;
use App\Http\Controllers\Admin\DelegateReservationController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventSectionController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\HotelRoomController;
use App\Http\Controllers\Admin\HotelRoomReservationController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SopnserInquiryController;
use App\Http\Controllers\Admin\SpearkerController;
use App\Http\Controllers\Admin\SponsorCategoryController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\StallBookingController;
use App\Http\Controllers\Admin\StallController;
use App\Http\Controllers\Admin\VenueController;
use App\Http\Controllers\AdvertisementReleaseFormController;
use App\Http\Controllers\BecomeSopnserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExibihitionBookingKistController;
use App\Http\Controllers\ExibihitionHallBookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SoyConclaveLayoutController;
use App\Http\Controllers\DelegateRegistrationController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\OperatorMiddleware;
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


Route::resources([
    '/' => HomeController::class,
]);

Route::get('/become-sponsor', [BecomeSopnserController::class, 'index']);
Route::post('/become-sponsor', [BecomeSopnserController::class, 'store']);

Route::get('/operator-panel', [OperatorController::class, 'index']);
Route::post('/operator-panel/login', [OperatorController::class, 'login']);
Route::get('/operator-panel/logout', [OperatorController::class, 'logout'])->name('Logout');

Route::get('/test-email', function () {
    Mail::raw('This is a test email to verify SMTP configuration.', function ($message) {
        $message->to('meenaaashish96@gmail.com')
                ->subject('Test Email');
    });

    return 'Test email sent!';
});

Route::prefix('operator-panel')->middleware([OperatorMiddleware::class])->group(function () {
    Route::get('/registration-request', [OperatorController::class, 'registrationRequest']);
    Route::get('/registration-assigned', [OperatorController::class, 'registrationAssigned']);
    Route::get('/badge-assign-request', [OperatorController::class, 'badgeAssignRequest']);
    Route::get('/registration-request/action/{id}', [OperatorController::class, 'registrationRequestAction']);
    Route::post('/registration-request/update/{id}', [OperatorController::class, 'registrationRequestActionUpdate']);
    Route::get('/registration-request/print/{id}/{type}', [OperatorController::class, 'registrationRequestActionPrint']);
    // Route::post('/badge-print/{id}', [OperatorController::class, 'registredEntriesAction']);
    Route::get('/registred-entries', [OperatorController::class, 'registredEntries']);
    Route::get('/registred-entries/action/{id}', [OperatorController::class, 'registredEntriesAction']);
});

Route::get('/delegate-reservation', [DelegateRegistrationController::class, 'index']);
Route::get('/spot-delegate-reservation', [DelegateRegistrationController::class, 'spot']);
Route::get('/delegate-reservation/mail', [DelegateRegistrationController::class, 'create']);
Route::post('/delegate-reservation', [DelegateRegistrationController::class, 'store']);
Route::post('/spot-delegate-reservation', [DelegateRegistrationController::class, 'spotStore']);

Route::get('/spot-text', [DelegateRegistrationController::class, 'spotTest']);

Route::get('/stall/lunch', [DelegateRegistrationController::class, 'showLunch'])->name('stall.lunch');
Route::get('/stall/dinner', [DelegateRegistrationController::class, 'showDinner'])->name('stall.dinner');
Route::get('/stall/breakfast', [DelegateRegistrationController::class, 'showBreakfast'])->name('stall.breakfast');

Route::post('/stall/lunch/scan', [DelegateRegistrationController::class, 'scanLunch'])->name('stall.lunch.scan');
Route::post('/stall/dinner/scan', [DelegateRegistrationController::class, 'scanDinner'])->name('stall.dinner.scan');
Route::post('/stall/breakfast/scan', [DelegateRegistrationController::class, 'scanBreakfast'])->name('stall.breakfast.scan');

Route::post('/generate-qr/{delegateId}', [DelegateRegistrationController::class, 'generateQrCode'])->name('generate.qr');

Route::get('/delegate/scan/{id}', [DelegateRegistrationController::class, 'scanDelegate'])->name('delegate.qr.scan');

Route::get('/get-delegate-info/{id}', [DelegateRegistrationController::class, 'getDelegateInfo']);

Route::get('/advertisement-release-form', [AdvertisementReleaseFormController::class, 'index']);
Route::post('/advertisement-release-form', [AdvertisementReleaseFormController::class, 'store']);

Route::get('/exibihition-hall-booking', [ExibihitionHallBookingController::class, 'index']);
Route::post('/exibihition-hall-booking', [ExibihitionHallBookingController::class, 'store']);

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);

Route::get('/about', [AboutController::class, 'index']);
Route::get('/soy-conclave-layout', [SoyConclaveLayoutController::class, 'index']);
Route::get('/exibihition-booking-list', [ExibihitionBookingKistController::class, 'index']);




//Admin Routes
Route::get('/sopa/admin', [LoginController::class, 'index']);
Route::post('/sopa/admin/login', [LoginController::class, 'Login'])->name('Login');
Route::get('/sopa/admin/logout', [LoginController::class, 'Logout'])->name('Logout');

Route::prefix('sopa/admin')->middleware([AdminMiddleware::class])->group(function () {
    Route::resources([
        'dashboard' => DashboardController::class,
        // 'comment' => CommentController::class,
    ]);

     //Event route start
     Route::get('/event', [EventController::class, 'index']);
     Route::get('/event/add', [EventController::class, 'create']);
     Route::post('/event/add', [EventController::class, 'store']);
     Route::get('/event/edit/{id}', [EventController::class, 'edit']);
     Route::post('/event/edit/{id}', [EventController::class, 'update']);
     Route::get('/event/delete/{id}', [EventController::class, 'destroy']);
     Route::get('/event/status/{id}', [EventController::class, 'status']);
     //Event route end


    //venue route start
    Route::get('/venue', [VenueController::class, 'index']);
    Route::get('/venue/add', [VenueController::class, 'create']);
    Route::post('/venue/add', [VenueController::class, 'store']);
    Route::get('/venue/edit/{id}', [VenueController::class, 'edit']);
    Route::post('/venue/edit/{id}', [VenueController::class, 'update']);
    Route::get('/venue/delete/{id}', [VenueController::class, 'destroy']);
    Route::get('/venue/status/{id}', [VenueController::class, 'status']);
    //venue route end


    //schedule route start
    Route::get('/schedule', [ScheduleController::class, 'index']);
    Route::get('/schedule/add', [ScheduleController::class, 'create']);
    Route::post('/schedule/add', [ScheduleController::class, 'store']);
    Route::get('/schedule/edit/{id}', [ScheduleController::class, 'edit']);
    Route::post('/schedule/edit/{id}', [ScheduleController::class, 'update']);
    Route::get('/schedule/delete/{id}', [ScheduleController::class, 'destroy']);
    Route::get('/schedule/status/{id}', [ScheduleController::class, 'status']);
    //schedule route end


     //attend route start
     Route::get('/attend', [AttendController::class, 'index']);
     Route::get('/attend/add', [AttendController::class, 'create']);
     Route::post('/attend/add', [AttendController::class, 'store']);
     Route::get('/attend/edit/{id}', [AttendController::class, 'edit']);
     Route::post('/attend/edit/{id}', [AttendController::class, 'update']);
     Route::post('/attend/updateorder', [AttendController::class, 'updateorder']);

     Route::get('/attend/delete/{id}', [AttendController::class, 'destroy']);
     Route::get('/attend/status/{id}', [AttendController::class, 'status']);
     //attend route end

    //speaker route start
    Route::get('/speaker', [SpearkerController::class, 'index']);
    Route::get('/speaker/add', [SpearkerController::class, 'create']);
    Route::post('/speaker/add', [SpearkerController::class, 'store']);
    Route::get('/speaker/edit/{id}', [SpearkerController::class, 'edit']);
    Route::post('/speaker/edit/{id}', [SpearkerController::class, 'update']);
    Route::get('/speaker/delete/{id}', [SpearkerController::class, 'destroy']);
    Route::get('/speaker/status/{id}', [SpearkerController::class, 'status']);
    //speaker route end

    //guest route start
    Route::get('/guest', [GuestController::class, 'index']);
    Route::get('/guest/add', [GuestController::class, 'create']);
    Route::post('/guest/add', [GuestController::class, 'store']);
    Route::get('/guest/edit/{id}', [GuestController::class, 'edit']);
    Route::post('/guest/edit/{id}', [GuestController::class, 'update']);
    Route::get('/guest/delete/{id}', [GuestController::class, 'destroy']);
    Route::get('/guest/status/{id}', [GuestController::class, 'status']);
    //guest route end

    //Sponsors Category route start
    Route::get('/sponsors/category', [SponsorCategoryController::class, 'index']);
    Route::get('/sponsors/category/add', [SponsorCategoryController::class, 'create']);
    Route::post('/sponsors/category/add', [SponsorCategoryController::class, 'store']);
    Route::get('/sponsors/category/edit/{id}', [SponsorCategoryController::class, 'edit']);
    Route::post('/sponsors/category/edit/{id}', [SponsorCategoryController::class, 'update']);
    Route::post('/sponsors/category/updateorder', [SponsorCategoryController::class, 'updateorder']);
    Route::get('/sponsors/category/delete/{id}', [SponsorCategoryController::class, 'destroy']);
    Route::get('/sponsors/category/status/{id}', [SponsorCategoryController::class, 'status']);
    //Sponsors category route end

    //Sponsors route start
    Route::get('/sponsors', [SponsorController::class, 'index']);
    Route::get('/sponsors/add', [SponsorController::class, 'create']);
    Route::post('/sponsors/add', [SponsorController::class, 'store']);
    Route::get('/sponsors/edit/{id}', [SponsorController::class, 'edit']);
    Route::post('/sponsors/edit/{id}', [SponsorController::class, 'update']);
    Route::get('/sponsors/delete/{id}', [SponsorController::class, 'destroy']);
    Route::get('/sponsors/status/{id}', [SponsorController::class, 'status']);
    //Sponsors route end


    //inquiry route start
    Route::get('/inquiry/sponsors', [SopnserInquiryController::class, 'index']);
    Route::get('/inquiry/sponsors/add', [SopnserInquiryController::class, 'create']);
    Route::post('/inquiry/sponsors/add', [SopnserInquiryController::class, 'store']);
    Route::get('/inquiry/sponsors/edit/{id}', [SopnserInquiryController::class, 'edit']);
    Route::post('/inquiry/sponsors/edit/{id}', [SopnserInquiryController::class, 'update']);
    Route::get('/inquiry/sponsors/delete/{id}', [SopnserInquiryController::class, 'destroy']);
    Route::get('/inquiry/sponsors/status/{id}', [SopnserInquiryController::class, 'status']);
    //inquiry route end

    //Document route start
    Route::get('/document', [DocumentController::class, 'index']);
    Route::get('/document/add', [DocumentController::class, 'create']);
    Route::post('/document/add', [DocumentController::class, 'store']);
    Route::get('/document/edit/{id}', [DocumentController::class, 'edit']);
    Route::post('/document/edit/{id}', [DocumentController::class, 'update']);
    Route::get('/document/delete/{id}', [DocumentController::class, 'destroy']);
    Route::get('/document/status/{id}', [DocumentController::class, 'status']);
    //Document route end

    //contact route start
    Route::get('/contact', [AdminContactController::class, 'index']);
    Route::get('/contact/add', [AdminContactController::class, 'create']);
    Route::post('/contact/add', [AdminContactController::class, 'store']);
    Route::get('/contact/edit/{id}', [AdminContactController::class, 'edit']);
    Route::post('/contact/edit/{id}', [AdminContactController::class, 'update']);
    Route::get('/contact/delete/{id}', [AdminContactController::class, 'destroy']);
    Route::get('/contact/status/{id}', [AdminContactController::class, 'status']);
    //contact route end


    //photGallery route start
    Route::get('/gallery', [GalleryController::class, 'index']);
    Route::get('/gallery/add', [GalleryController::class, 'create']);
    Route::post('/gallery/add', [GalleryController::class, 'store']);
    Route::get('/gallery/edit/{id}', [GalleryController::class, 'edit']);
    Route::post('/gallery/edit/{id}', [GalleryController::class, 'update']);
    Route::post('/gallery/delete/', [GalleryController::class, 'fileDestroy']);
    Route::get('/gallery/delete/{id}', [GalleryController::class, 'destroy']);
    Route::get('/gallery/status/{id}', [GalleryController::class, 'status']);
    //photGallery route end


    //eventSection route start
      Route::get('/eventsection', [EventSectionController::class, 'index']);
      Route::get('/eventsection/add', [EventSectionController::class, 'create']);
      Route::post('/eventsection/add', [EventSectionController::class, 'store']);
      Route::get('/eventsection/edit/{id}', [EventSectionController::class, 'edit']);
      Route::post('/eventsection/edit/{id}', [EventSectionController::class, 'update']);
      Route::post('/eventsection/delete/', [EventSectionController::class, 'fileDestroy']);
      Route::get('/eventsection/delete/{id}', [EventSectionController::class, 'destroy']);
      Route::get('/eventsection/status/{id}', [EventSectionController::class, 'status']);
      //eventSection route end


       //delegates route start
        Route::get('/delegates', [DelegateController::class, 'index']);
        Route::get('/delegates/add', [DelegateController::class, 'create']);
        Route::post('/delegates/add', [DelegateController::class, 'store']);
        Route::get('/delegates/edit/{id}', [DelegateController::class, 'edit']);
        Route::post('/delegates/edit/{id}', [DelegateController::class, 'update']);
        Route::get('/delegates/delete/{id}', [DelegateController::class, 'destroy']);
        Route::get('/delegates/status/{id}', [DelegateController::class, 'status']);

        Route::get('/delegates/reservation', [DelegateController::class, 'create']);
        //delegates route end

        //delegate registations route start
        Route::get('/delegates/registations', [DelegateReservationController::class, 'index']);
        Route::get('/delegates/registations/add', [DelegateReservationController::class, 'create']);
        Route::post('/delegates/registations/add', [DelegateReservationController::class, 'store']);
        Route::get('/delegates/registations/edit/{id}', [DelegateReservationController::class, 'edit']);
        Route::get('/delegates/registations/view/{id}', [DelegateReservationController::class, 'view']);
        Route::post('/delegates/registations/edit/{id}', [DelegateReservationController::class, 'update']);
        Route::get('/delegates/registations/delete/{id}', [DelegateReservationController::class, 'destroy']);
        Route::get('/delegates/registations/status/{id}', [DelegateReservationController::class, 'status']);
        Route::get('delegates/registations/xsal', [DelegateReservationController::class, 'BulkUpload']);
        //delegate registations route end

        //hotelroom route start
        Route::get('/hotelroom', [HotelRoomController::class, 'index']);
        Route::get('/hotelroom/add', [HotelRoomController::class, 'create']);
        Route::post('/hotelroom/add', [HotelRoomController::class, 'store']);
        Route::get('/hotelroom/edit/{id}', [HotelRoomController::class, 'edit']);
        Route::post('/hotelroom/edit/{id}', [HotelRoomController::class, 'update']);
        Route::get('/hotelroom/delete/{id}', [HotelRoomController::class, 'destroy']);
        Route::get('/hotelroom/status/{id}', [HotelRoomController::class, 'status']);
        //hotelroom route end


        //advertisement route start
         Route::get('/advertisement', [AdvertisementController::class, 'index']);
         Route::get('/advertisement/add', [AdvertisementController::class, 'create']);
         Route::post('/advertisement/add', [AdvertisementController::class, 'store']);
         Route::get('/advertisement/edit/{id}', [AdvertisementController::class, 'edit']);
         Route::post('/advertisement/edit/{id}', [AdvertisementController::class, 'update']);
         Route::get('/advertisement/delete/{id}', [AdvertisementController::class, 'destroy']);
         Route::get('/advertisement/status/{id}', [AdvertisementController::class, 'status']);
        //advertisement route end

        //stall route start
        Route::get('/stall', [StallController::class, 'index']);
        Route::get('/stall/layout', [StallController::class, 'layout']);
        Route::post('/stall/layout/add', [StallController::class, 'layoutadd']);
        Route::post('/stall/layout/gridadd', [StallController::class, 'gridadd']);
        Route::get('/stall/add', [StallController::class, 'create']);
        Route::post('/stall/add', [StallController::class, 'store']);
        Route::get('/stall/edit/{id}', [StallController::class, 'edit']);
        Route::post('/stall/edit/{id}', [StallController::class, 'update']);
        Route::get('/stall/delete/{id}', [StallController::class, 'destroy']);
        Route::get('/stall/layout/delete/{id}', [StallController::class, 'destroygrid']);
        Route::get('/stall/status/{id}', [StallController::class, 'status']);
        //stall route end

        //hotelroom reservation route start
        Route::get('/hotelroom/reservation', [HotelRoomReservationController::class, 'index']);
        Route::get('/hotelroom/reservation/add', [HotelRoomReservationController::class, 'create']);
        Route::post('/hotelroom/reservation/add', [HotelRoomReservationController::class, 'store']);
        Route::get('/hotelroom/reservation/edit/{id}', [HotelRoomReservationController::class, 'edit']);
        Route::post('/hotelroom/reservation/edit/{id}', [HotelRoomReservationController::class, 'update']);
        Route::get('/hotelroom/reservation/delete/{id}', [HotelRoomReservationController::class, 'destroy']);
        Route::get('/hotelroom/reservation/status/{id}', [HotelRoomReservationController::class, 'status']);
        Route::post('hotelroom/reservation/xsal', [HotelRoomReservationController::class, 'BulkUpload']);
        //hotelroom reservation route end


         //advertisement release route start
         Route::get('/advertisement/release', [AdvertisementReleaseController::class, 'index']);
         Route::get('/advertisement/release/add', [AdvertisementReleaseController::class, 'create']);
         Route::post('/advertisement/release/add', [AdvertisementReleaseController::class, 'store']);
         Route::get('/advertisement/release/edit/{id}', [AdvertisementReleaseController::class, 'edit']);
         Route::get('/advertisement/release/view/{id}', [AdvertisementReleaseController::class, 'view']);
         Route::post('/advertisement/release/edit/{id}', [AdvertisementReleaseController::class, 'update']);
         Route::get('/advertisement/release/delete/{id}', [AdvertisementReleaseController::class, 'destroy']);
         Route::get('/advertisement/release/status/{id}', [AdvertisementReleaseController::class, 'status']);
         Route::post('advertisement/release/xsal', [AdvertisementReleaseController::class, 'BulkUpload']);
        //advertisement release route end


        //stall booking route start
        Route::get('/stall/booking', [StallBookingController::class, 'index']);
        Route::get('/stall/booking/add', [StallBookingController::class, 'create']);
        Route::post('/stall/booking/add', [StallBookingController::class, 'store']);
        Route::get('/stall/booking/edit/{id}', [StallBookingController::class, 'edit']);
        Route::get('/stall/booking/view/{id}', [StallBookingController::class, 'view']);
        Route::post('/stall/booking/edit/{id}', [StallBookingController::class, 'update']);
        Route::get('/stall/booking/delete/{id}', [StallBookingController::class, 'destroy']);
        Route::get('/stall/booking/status/{id}', [StallBookingController::class, 'status']);
        Route::post('stall/booking/xsal', [StallBookingController::class, 'BulkUpload']);
        //stall booking route end


});
