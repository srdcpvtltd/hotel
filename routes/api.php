<?php

use App\Http\Controllers\API\AdvanceBookingsController;
use App\Http\Controllers\Api\HotelRegisterController;
use App\Http\Controllers\FaceRecognitionController;
use App\Http\Controllers\HotelProfileController;
use App\Http\Controllers\PriceRuleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//add,update,delete - hotel
Route::middleware('auth:api')->group(function () {
    Route::post("add-hotel", [HotelProfileController::class, 'add_hotel']);
    // dd("testing");
    Route::post("update-hotel", [HotelProfileController::class, 'update_hotel']);
    Route::post("delete-hotel", [HotelProfileController::class, 'delete_hotel']);
});

//Hotel register and login
Route::post("hotel-register", [HotelRegisterController::class, 'hotel_register']);
Route::post("login", [HotelRegisterController::class, 'login']);


//Bookings
Route::post("create-advance-booking", [AdvanceBookingsController::class, 'create_advance_bookings']); //create Advance Booking
Route::post("retrive-advance-booking", [AdvanceBookingsController::class, 'retrive_advance_bookings']); //retrive Advance Booking
Route::post("update-advance-booking", [AdvanceBookingsController::class, 'update_advance_bookings']); //update Advance Booking
Route::post("delete-advance-booking", [AdvanceBookingsController::class, 'delete_advance_bookings']); //delete Advance Booking

//crud for room type
Route::post("create-room-type", [RoomTypeController::class, 'create_room_type']); //create room type
Route::post("retrive-room-type", [RoomTypeController::class, 'retrive_room_type']); //retrive room type
Route::post("room-type-paginate", [RoomTypeController::class, 'paginate']); //paginate for room type
Route::post("update-room-type", [RoomTypeController::class, 'update_room_type']); //update room type
Route::post("delete-room-type", [RoomTypeController::class, 'delete_room_type']); //delete room type

//crud for price rules
Route::get("room-type-dropdown", [PriceRuleController::class, 'room_type_dropDown']); //dropdown for room type
Route::post("price-rules-create", [PriceRuleController::class, 'create_price_rules']); //create price rules
Route::post("price-rules-retrive", [PriceRuleController::class, 'retrive_price_rules']); //retrive price rules
Route::post("price-rules-paginate", [PriceRuleController::class, 'paginate']); //paginate for price rule
Route::post("price-rules-update", [PriceRuleController::class, 'update_price_rules']); //update price rules
Route::post("price-rules-delete", [PriceRuleController::class, 'delete_price_rules']); //delete price rules

//crud for room
Route::post("room-create", [RoomController::class, 'create_room']); //create rooms
Route::post("room-retrive", [RoomController::class, 'retrive_rooms']); //retrive rooms
Route::post("rooms-paginate", [RoomController::class, 'paginate']); //paginate for rooms
Route::post("room-update", [RoomController::class, 'update_rooms']); //update rooms
Route::post("room-delete", [RoomController::class, 'delete_rooms']); //delete rooms


//get criminals
Route::get('/criminals', [FaceRecognitionController::class, 'criminals']);
//get guests - pending BG check only
Route::get('/guests', [FaceRecognitionController::class, 'guests']);
//send result
Route::post('/save-bg-check-results/{}', [FaceRecognitionController::class, 'saveBgCheckResults']);



// Route::resource('tests', App\Http\Controllers\API\TestAPIController::class);
