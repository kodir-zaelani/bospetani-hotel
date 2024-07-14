<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryUpdateRequst;
use App\Http\Requests\StoreCountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          //
          return view('admin.countries.index',[
            'countries' => Country::orderByDesc('created_at')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        DB::transaction(function() use($request) {
            $validated         = $request->validated();
            $validated['slug'] = Str::slug($validated['name']);
            $newData           = Country::create($validated);
        });

        return redirect()->route('admin.countries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
          //
        return view('admin.countries.edit',[
            'country' => $country,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
          return view('admin.countries.edit',[
            'country' => $country,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryUpdateRequst $request, Country $country)
    {
         DB::transaction(function() use($request, $country) {
            $validated         = $request->validated();
            $validated['slug'] = Str::slug($validated['name']);
            $country->update($validated);
        });

        return redirect()->route('admin.countries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        DB::transaction(function() use ($country){
            $country->delete();
        });

        return redirect()->route('admin.countries.index');
    }
}
