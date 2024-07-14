<?php

namespace App\Http\Controllers\Backend;

use App\Models\City;
use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;

class HotelController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        return view('admin.hotels.index',[
            'hotels' => Hotel::with('rooms')->orderByDesc('created_at')->paginate(10),
        ]);
    }

    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        return view('admin.hotels.create',[
            'cities'   => City::orderBy('name','asc')->get(),
            'countries' => Country::orderBy('name', 'asc')->get(),
        ]);
    }

    /**
    * Store a newly created resource in storage.
    */
    public function store(StoreHotelRequest $request)
    {


        DB::transaction(function() use($request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('images/thumbnails/' . date('Y/m/d'));
                $validated['thumbnail'] = $thumbnailPath;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $hotel = Hotel::create($validated);

            if ($request->hasFile('photos')) {
                # code...
                foreach ($request->file('photos') as $photo) {
                    # code...
                    $photoPath = $photo->store('images/photos/' . date('Y/m/d') );
                    $hotel->photos()->create([
                        'photo' =>$photoPath
                    ]);
                }
            }
        });

        return redirect()->route('admin.hotels.index');
    }

    /**
    * Display the specified resource.
    */
    public function show(Hotel $hotel)
    {
        return view('admin.hotels.show',[
            'hotel' => $hotel,
            'latesphotos' => $hotel->photos()->orderByDesc('id')->take(3)->get(),
        ]);
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit',[
            'hotel'     => $hotel,
            'cities'    => City::orderBy('name','asc')->get(),
            'countries' => Country::orderBy('name', 'asc')->get(),
            'latesphotos' => $hotel->photos()->orderByDesc('id')->take(3)->get(),
        ]);
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {
        DB::transaction(function() use($request, $hotel) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('images/thumbnails/' . date('Y/m/d'));
                $validated['thumbnail'] = $thumbnailPath;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $hotel->update($validated);

            if ($request->hasFile('photos')) {
                # code...
                foreach ($request->file('photos') as $photo) {
                    # code...
                    $photoPath = $photo->store('images/photos/' . date('Y/m/d') );
                    $hotel->photos()->create([
                        'photo' =>$photoPath
                    ]);
                }
            }
        });

        return redirect()->route('admin.hotels.index');
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Hotel $hotel)
    {
          //
        DB::transaction(function() use ($hotel){
            $hotel->delete();
        });

        return redirect()->route('admin.hotels.index');
    }
}
