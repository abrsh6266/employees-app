<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountriesRequest;
use App\Http\Requests\UpdateCountriesRequest;
use App\Models\Country;
use App\Tables\Countries;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.countries.index",[
            'countries'=> Countries::class,
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
    public function store(StoreCountriesRequest $request)
    {
        Country::create($request->validated());
        Splade::toast('country created successfully')->autoDismiss(3);
        return view('admin.countries.index', [
            'countries' => Countries::class
        ]);
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
    public function edit(Country $country)
    {
        $form = SpladeForm::make()
            ->action(route('admin.countries.update',$country))
            ->fields([
                Input::make('name')->label('Country Name'),
                Input::make('country_code')->label('Country Code'),
                Submit::make()->label('Update'),
            ])->method('PUT')->fill($country);
        return view('admin.countries.edit', [
            'form' => $form,
            'country' => $country
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountriesRequest $request, Country $country)
    {
        $country->update($request->validated());
        Splade::toast('country updated')->autoDismiss(3);
        return view('admin.countries.index', [
            'countries' => Countries::class
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        Splade::toast('Country deleted successfully')->autoDismiss(3);
        return back();
    }
}
