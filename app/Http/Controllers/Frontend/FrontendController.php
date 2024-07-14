<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hotel;
use App\Models\Hotelroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSearchHotelRequest;
use App\Http\Requests\StoreHotelBookingRequest;
use App\Http\Requests\StorePaymentBookingRequest;
use App\Models\Hotelbooking;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index(){
        return view('front.index');
    }
    public function hotels(){
        return view('front.hotels');
    }

    public function search_hotels(StoreSearchHotelRequest $request){

        $request->session()->put('checkin_at', $request->input('checkin_at'));
        $request->session()->put('checkout_at', $request->input('checkout_at'));
        $request->session()->put('keyword', $request->input('keyword'));

        $keyword = $request->session()->get('keyword');


        return redirect()->route('front.list.hotels',[
            'keyword' => $keyword,
        ]);
    }

    public function list_hotels($keyword){
        $hotels = Hotel::with(['hotelrooms', 'city', 'country'])
        ->whereHas('country', function($query) use ($keyword){
            $query->where('name', 'like', '%' . $keyword . '%');
        })
        ->orWhereHas('city', function($query) use ($keyword){
            $query->where('name', 'like', '%' . $keyword . '%');
        })
        ->orWhere('name', 'like', '%' . $keyword . '%')->get();

        return view('front.list_hotels', [
            'hotels' => $hotels,
            'keyword' => $keyword,
        ]);
    }

     public function hotel_details(Hotel $hotel){
        return view('front.details', [
            'hotel'       => $hotel,
            'latesphotos' => $hotel->photos()->orderByDesc('id')->take(3)->get(),
        ]);
    }
     public function hotel_rooms(Hotel $hotel){
        return view('front.list_hotels_rooms', [
            'hotel'       => $hotel,
            'hotelrooms'  => $hotel->hotelrooms->sortBy('price'),
            'latesphotos' => $hotel->photos()->orderByDesc('id')->take(3)->get(),
        ]);
    }

    public function hotel_room_book(StoreHotelBookingRequest $request, Hotel $hotel, Hotelroom $hotelroom){
        $user = Auth::user();

        // dd($hotelroom);

        $checkin_at     = $request->session()->get('checkin_at');
        $checkout_at    = $request->session()->get('checkout_at');

        $hotelBookingId = null;

        DB::transaction(function() use ($request, $user, $hotel, $hotelroom, $checkin_at, $checkout_at, &$hotelBookingId){
            $databooking = $request->validated();
            $databooking['user_id']  = $user->id;
            $databooking['hotel_id'] = $hotel->id;
            $databooking['check_in']  = $checkin_at;
            $databooking['check_out'] = $checkout_at;
            $databooking['hotelroom_id'] = $hotelroom->id;
            $databooking['is_paid'] = false;
            $databooking['proof']   = 'dummytrx.png';

            // Calculate total days
            $checkinDate  = \Carbon\Carbon::parse($checkin_at);
            $checkoutDate = \Carbon\Carbon::parse($checkout_at);
            $totalDays    = $checkinDate->diffInDays($checkoutDate);
            $databooking['total_days'] = $totalDays;

            // calculate total amount
            $databooking['total_amount'] = $hotelroom->price * $totalDays;
            $newBooking = Hotelbooking::create($databooking);
            // dd($newBooking);
            $hotelBookingId = $newBooking->id;
        });

        return redirect()->route('front.hotel.book.payment', $hotelBookingId);
    }

    public function hotel_payment(Hotelbooking $hotelbooking){
        $user = Auth::user();
        return view('front.book_payment', [
            'hotelbooking' => $hotelbooking,
            'user'         => $user,
        ]);
    }
    public function hotel_payment_store(StorePaymentBookingRequest $request, Hotelbooking $hotelbooking){
        $user = Auth::user();

        if ($hotelbooking->user_id != $user->id) {
            # code...
            abort(403);
        }

        DB::transaction(function() use ($request, $hotelbooking){
            $databooking = $request->validated();
            if ($request->hasFile('proof')) {
                $proofPath          = $request->file('proof')->store('images/proofs/');
                $validated['proof'] = $proofPath;
            }
            $hotelbooking->update($databooking);
        });

        return redirect()->route('front.hotels.book.finish');
    }

    public function hotel_payment_finish(){
        return view('front.hotel_payment_finish');
    }
}
