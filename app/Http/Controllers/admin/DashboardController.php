<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Facility;

class DashboardController extends Controller
{
    public function index()
    {
        $categoryCount = Category::count();
        $facilityCount = Facility::count();
        $facilities = Facility::with('category')->get();

        return view('admin.dashboard', compact('categoryCount', 'facilityCount', 'facilities'));
    }
}
