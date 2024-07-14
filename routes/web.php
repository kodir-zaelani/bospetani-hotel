<?php

use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\HotelbookingController;
use App\Http\Controllers\Backend\HotelController;
use App\Http\Controllers\Backend\HotelroomController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class,'index'])->name('front.index');
Route::get('/hotels', [FrontendController::class,'hotels'])->name('front.hotels');
Route::post('/hotels/search', [FrontendController::class,'search_hotels'])->name('front.search.hotels');
Route::get('/hotels/list/{keyword}', [FrontendController::class,'list_hotels'])->name('front.list.hotels');
Route::get('/hotels/details/{hotel:slug}', [FrontendController::class,'hotel_details'])->name('front.hotels.details');
Route::get('/hotels/details/{hotel:slug}/rooms', [FrontendController::class,'hotel_rooms'])->name('front.hotels.rooms');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('can:checkout hotels')->group(function(){

        Route::post('/hotels/{hotel:slug}/{hotelroom}/book', [FrontendController::class,'hotel_room_book'])->name('front.hotels.room.book');

        Route::get('/hotel/payment/{hotelbooking}', [FrontendController::class,'hotel_payment'])->name('front.hotel.book.payment');

        Route::put('/hotel/payment/{hotelbooking}/store', [FrontendController::class,'hotel_payment_store'])->name('front.hotel.book.payment.store');

        Route::get('/book/finish', [FrontendController::class,'hotel_payment_finish'])->name('front.hotels.book.finish');

    });

    Route::prefix('admin')->name('admin.')->group(function(){
        Route::middleware('can::manage cities')->group(function(){
            Route::resource('cities', CityController::class);
        });
        Route::middleware('can::manage countries')->group(function(){
            Route::resource('countries', CountryController::class);
        });
        Route::middleware('can::manage hotels')->group(function(){
            Route::resource('hotels', HotelController::class);
        });
        Route::middleware('can::manage hotels')->group(function(){
            Route::get('/add/room/{hotel:slug}', [HotelroomController::class, 'create'])->name('hotel_rooms.create');
            Route::post('/add/room/{hotel:slug}/store', [HotelroomController::class, 'store'])->name('hotel_rooms.store');
            Route::get('/add/room/{hotel:slug}/room/{hotelroom}', [HotelroomController::class, 'edit'])->name('hotel_rooms.edit');
            Route::put('/add/room/{hotelroom}/update', [HotelroomController::class, 'update'])->name('hotel_rooms.update');
            Route::delete('/add/room/{hotel:slug}/delete/{hotelroom}', [HotelroomController::class, 'destroy'])->name('hotel_rooms.destroy');
        });
        Route::middleware('can::manage hotel bookings')->group(function(){
            Route::resource('hotel_bookings', HotelbookingController::class);
        });
    });


});

require __DIR__.'/auth.php';
