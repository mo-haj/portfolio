<?php

namespace App\Http\Controllers;
use App\Models\Medic;
use Illuminate\Http\Request;

class MedicController extends Controller
{
    public function index()
    {
        $medics = Medic::all();
        return view('medics.index', compact('medics'));
    }

    public function create()
    {
        return view('medics.create');
    }

    public function store(Request $request)
    {
        Medic::create($request->all());
        return redirect()->route('medics.index')->with('success', 'Medic created successfully.');
    }

    public function show(Medic $medic)
    {
        return view('medics.show', compact('medic'));
    }

    public function edit(Medic $medic)
    {
        return view('medics.edit', compact('medic'));
    }

    public function update(Request $request, Medic $medic)
    {
        $medic->update($request->all());
        return redirect()->route('medics.index')->with('success', 'Medic updated successfully.');
    }

    public function destroy(Medic $medic)
    {
        $medic->delete();
        return redirect()->route('medics.index')->with('success', 'Medic deleted successfully.');
    }
}
