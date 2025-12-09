@extends('layouts.app')

@section('content')
<div class="relative overflow-hidden">
    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16 text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
            {{ __('Make Your Voice Heard.') }}
        </h1>
        <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
            {{ __('Report issues in your community securely and follow up on their resolution.') }}
        </p>
        
        <div class="mt-10 flex justify-center gap-4">
            <a href="{{ route('reports.create') }}" class="px-8 py-4 rounded-xl bg-brand-green text-white font-bold hover:bg-green-600 transition shadow-xl shadow-green-200 transform hover:-translate-y-1">
                {{ __('Create Report') }}
            </a>
            <a href="{{ route('reports.index') }}" class="px-8 py-4 rounded-xl bg-white text-gray-700 border border-gray-200 font-bold hover:border-gray-300 transition hover:bg-gray-50">
                {{ __('View Reports') }}
            </a>
        </div>
    </div>

    <!-- Stats Section (Arithmetic Logic Display) -->
    <div class="bg-white py-12 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Stat Card 1 -->
                <div class="p-6 rounded-2xl bg-slate-50 hover:bg-slate-100 transition duration-300 text-center group cursor-default">
                    <dt class="text-sm font-medium text-gray-500 uppercase tracking-widest">{{ __('Total Reports') }}</dt>
                    <dd class="mt-2 text-4xl font-extrabold text-brand-blue group-hover:scale-110 transition-transform">
                        {{ $totalReports }}
                    </dd>
                </div>
                
                <!-- Stat Card 2 -->
                <div class="p-6 rounded-2xl bg-slate-50 hover:bg-slate-100 transition duration-300 text-center group cursor-default">
                    <dt class="text-sm font-medium text-gray-500 uppercase tracking-widest">{{ __('Resolved') }}</dt>
                    <dd class="mt-2 text-4xl font-extrabold text-brand-green group-hover:scale-110 transition-transform">
                        {{ $resolvedCount }}
                    </dd>
                </div> <!-- Logic Requirement: Arithmetic Display -->

                <!-- Stat Card 3 -->
                <div class="p-6 rounded-2xl bg-slate-50 hover:bg-slate-100 transition duration-300 text-center group cursor-default">
                    <dt class="text-sm font-medium text-gray-500 uppercase tracking-widest">{{ __('Efficiency') }}</dt>
                    <dd class="mt-2 text-4xl font-extrabold text-gray-900 group-hover:scale-110 transition-transform">
                        @if($totalReports > 0)
                            {{ number_format(($resolvedCount / $totalReports) * 100, 0) }}%
                        @else
                            0%
                        @endif
                    </dd>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
