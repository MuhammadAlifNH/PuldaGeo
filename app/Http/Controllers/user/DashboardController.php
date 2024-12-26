<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Facility;

class DashboardController extends Controller
{
    public function index()
    {
        $facilities = Facility::with('category')->get();
        return view('user.dashboard', compact('facilities'));
    }
}
