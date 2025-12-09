<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Loops: Get all reports for the admin list
        $reports = Report::with(['user', 'category'])->latest()->paginate(15);
        
        // Arithmetic Logic: Calculate Success Rate
        $totalReports = Report::count();
        $resolvedReports = Report::where('status', 'resolved')->count();
        
        // Prevent division by zero
        $successRate = $totalReports > 0 ? ($resolvedReports / $totalReports) * 100 : 0;
        
        // Formatting for display
        $stats = [
            'total' => $totalReports,
            'resolved' => $resolvedReports,
            'pending' => Report::where('status', 'pending')->count(),
            'rate' => number_format($successRate, 1) // e.g., "75.5"
        ];

        return view('dashboard.admin', compact('reports', 'stats'));
    }

    public function updateStatus(Request $request, Report $report)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,verification,process,resolved,rejected',
        ]);

        $report->update(['status' => $validated['status']]);

        return back()->with('success', 'Report status updated!');
    }
}
