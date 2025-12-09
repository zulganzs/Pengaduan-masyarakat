<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Landing Page logic
    public function landing()
    {
        // Arithmetic for Landing Page (Total reports)
        $totalReports = Report::count();
        $resolvedCount = Report::where('status', 'resolved')->count();
        
        return view('landing', compact('totalReports', 'resolvedCount'));
    }

    // Public Feed (Looping Logic)
    public function index()
    {
        $reports = Report::with('category', 'user')
            ->whereIn('status', ['process', 'resolved']) // Only show active/done reports in public
            ->latest()
            ->paginate(10);

        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('reports.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'location' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('reports', 'public');
        }

        Report::create([
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'image' => $path,
        ]);

        return redirect()->route('dashboard')->with('success', 'Report submitted successfully!');
    }

    // User Dashboard (Looping Logic for specific user)
    public function userDashboard()
    {
        $user = Auth::user();
        $myReports = $user->reports()->latest()->get(); // Getting collections for looping in Blade

        return view('dashboard.user', compact('myReports'));
    }

    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }
}
