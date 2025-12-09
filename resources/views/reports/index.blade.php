@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ __('Community Reports') }}</h2>
            <p class="mt-2 text-gray-600">{{ __("See what's happening around you.") }}</p>
        </div>
    </div>

    <!-- Grid of Reports -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Logic Requirement: Foreach Loop -->
        @foreach($reports as $report)
        <div class="group bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-xl hover:shadow-gray-200/50 transition-all duration-300 hover:-translate-y-1">
            <div class="flex justify-between items-start mb-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    {{ $report->category->name ?? 'General' }}
                </span>
                
                <!-- Logic Requirement: Status Badge Color Logic via Model Accessor -->
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $report->status_color }}">
                    {{ ucfirst($report->status) }}
                </span>
            </div>

            <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-1 group-hover:text-brand-blue transition-colors">
                {{ $report->title }}
            </h3>
            
            <p class="text-gray-500 text-sm mb-4 line-clamp-3">
                {{ $report->description }}
            </p>

            <div class="flex items-center justify-between text-xs text-gray-400 border-t border-gray-50 pt-4 mt-auto">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    {{ $report->location }}
                </div>
                <span>{{ $report->created_at->diffForHumans() }}</span>
            </div>
            
            <a href="{{ route('reports.show', $report) }}" class="absolute inset-0 z-10" aria-label="View Report"></a>
        </div>
        @endforeach
        
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $reports->links() }}
    </div>
</div>
@endsection
