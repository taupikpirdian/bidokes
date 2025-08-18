<?php

namespace App\Http\Controllers\admin;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutUs = AboutUs::all();
        return view('admin.about-us.index', compact('aboutUs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $is_edit = false;
        return view('admin.about-us.create', compact('is_edit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);

        AboutUs::create($request->all());

        return redirect()->route('dashboard.about-us.index')->with('success', 'About Us created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return view('admin.about-us.show', compact('aboutUs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $is_edit = true;
        $aboutUs = AboutUs::findOrFail($id);
        return view('admin.about-us.create', compact('is_edit', 'aboutUs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);

        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->update($request->all());

        return redirect()->route('dashboard.about-us.index')->with('success', 'About Us updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->delete();

        return redirect()->route('dashboard.about-us.index')->with('success', 'About Us deleted successfully');
    }
}