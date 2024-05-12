<?php

namespace App\Http\Controllers;
use App\Models\Date;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public function index()
    {
        $dates = Date::all();
        return view('dates.index', compact('dates'));
    }

    public function create()
    {
        return view('dates.create');
    }

    public function store(Request $request)
    {
        Date::create($request->all());
        return redirect()->route('dates.index')->with('success', 'Date created successfully.');
    }

    public function show(Date $date)
    {
        return view('dates.show', compact('date'));
    }

    public function edit(Date $date)
    {
        return view('dates.edit', compact('date'));
    }

    public function update(Request $request, Date $date)
    {
        $date->update($request->all());
        return redirect()->route('dates.index')->with('success', 'Date updated successfully.');
    }

    public function destroy(Date $date)
    {
        $date->delete();
        return redirect()->route('dates.index')->with('success', 'Date deleted successfully.');
    }
}
