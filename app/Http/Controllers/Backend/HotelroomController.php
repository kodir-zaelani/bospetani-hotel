<?php

namespace App\Http\Controllers\Backend;

use App\Models\Hotel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Hotelroom;

class HotelroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Hotel $hotel)
    {
            //

            return view('admin.hotel_rooms.create',[
                'hotel' => $hotel,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request, Hotel $hotel)
    {
        DB::transaction(function() use ($request, $hotel) {
            $validated = $request->validated();

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('images/roomphotos/' . date('Y/m/d'));
                $validated['photo'] = $photoPath;
            }

            $validated['hotel_id'] = $hotel->id;

            $hotelroom = Hotelroom::create($validated);


        });

        return redirect()->route('admin.hotels.show', $hotel->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel, Hotelroom $hotelroom)
    {
          //
        return view('admin.hotel_rooms.edit',[
            'hotel' => $hotel,
            'hotelroom' => $hotelroom,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Hotelroom $hotelroom)
    {
         DB::transaction(function() use ($request, $hotelroom) {
            $validated = $request->validated();

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('images/roomphotos/' . date('Y/m/d'));
                $validated['photo'] = $photoPath;
            }

            $hotelroom ->update($validated);


        });

        return redirect()->route('admin.hotels.show', $hotelroom->hotel->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel, Hotelroom $hotelroom)
    {
        DB::transaction(function() use ($hotelroom, $hotel){
            $hotelroom->delete();
        });

        return redirect()->route('admin.hotels.show', $hotel->slug);
    }
}
