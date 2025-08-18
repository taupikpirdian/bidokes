<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::first();
        return view('welcome', compact('aboutUs'));
    }
}
