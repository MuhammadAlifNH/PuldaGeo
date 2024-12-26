<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::with('category')->get();
        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.facilities.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Facility::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'created_by' => Auth::id(), // Menyimpan ID pengguna yang sedang login
        ]);

        return redirect()->route('facilities.index')->with('success', 'Facility created successfully.');
    }

    public function edit($id)
    {
        $facility = Facility::findOrFail($id);
        $categories = Category::all();

        return view('admin.facilities.edit', compact('facility', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $facility = Facility::findOrFail($id);
        $facility->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('facilities.index')->with('success', 'Facility updated successfully.');
    }

    public function destroy($id)
    {
        $facility = Facility::findOrFail($id);
        $facility->delete();

        return redirect()->route('facilities.index')->with('success', 'Facility deleted successfully.');
    }
}