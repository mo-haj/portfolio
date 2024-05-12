<?php

namespace App\Http\Controllers;
use App\Models\Spec;
use Illuminate\Http\Request;

class SpecController extends Controller
{
    public function index()
    {
        $specs = Spec::all();
        return view('specs.index', compact('specs'));
    }

    public function create()
    {
        return view('specs.create');
    }

    public function store(Request $request)
    {
        Spec::create($request->all());
        return redirect()->route('specs.index')->with('success', 'Specialization created successfully.');
    }

    public function show(Spec $spec)
    {
        return view('specs.show', compact('spec'));
    }

    public function edit(Spec $spec)
    {
        return view('specs.edit', compact('spec'));
    }

    public function update(Request $request, Spec $spec)
    {
        $spec->update($request->all());
        return redirect()->route('specs.index')->with('success', 'Specialization updated successfully.');
    }

    public function destroy(Spec $spec)
    {
        $spec->delete();
        return redirect()->route('specs.index')->with('success', 'Specialization deleted successfully.');
    }
}
