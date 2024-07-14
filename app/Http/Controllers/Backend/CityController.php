<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityUpdateRequst;
use App\Http\Requests\StoreCityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            //
        return view('admin.cities.index',[
            'cities' => City::orderByDesc('created_at')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        // dd($request->name);

        DB::transaction(function() use ($request) {
            $validated         = $request->validated();
            $validated['slug'] = Str::slug($validated['name']);
            $newData           = City::create($validated);
        });

        return redirect()->route('admin.cities.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
          //
        return view('admin.cities.edit',[
            'city' => $city,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityUpdateRequst $request, City $city)
    {
          DB::transaction(function() use ($request, $city) {
            $validated         = $request->validated();
            $validated['slug'] = Str::slug($validated['name']);
            $city->update($validated);
        });

        return redirect()->route('admin.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
             //
        DB::transaction(function() use ($city){
            $city->delete();
        });

        return redirect()->route('admin.cities.index');
    }
}
