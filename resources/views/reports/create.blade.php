@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-brand-green to-teal-500 px-6 py-8 sm:px-10">
            <h2 class="text-2xl font-bold text-white">{{ __('Create New Report') }}</h2>
            <p class="mt-2 text-green-100">{{ __('Found an issue? Let us know so we can fix it.') }}</p>
        </div>
        
        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="px-6 py-8 sm:px-10 space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Report Title') }}</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-brand-green focus:border-brand-green sm:text-sm p-2.5 border" placeholder="e.g. Broken Street Light">
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">{{ __('Category') }}</label>
                <select id="category_id" name="category_id" class="mt-1 block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-brand-green focus:border-brand-green sm:text-sm rounded-lg border">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-brand-green focus:border-brand-green sm:text-sm p-2.5 border" placeholder="{{ __('Describe the issue in detail...') }}"></textarea>
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">{{ __('Location') }}</label>
                <input type="text" name="location" id="location" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-brand-green focus:border-brand-green sm:text-sm p-2.5 border" placeholder="e.g. Jl. Sudirman No. 10">
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Evidence Photo (Optional)') }}</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition cursor-pointer">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-brand-green hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-brand-green">
                                <span>{{ __('Upload a file') }}</span>
                                <input id="image" name="image" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">{{ __('or drag and drop') }}</p>
                        </div>
                        <p class="text-xs text-gray-500">{{ __('PNG, JPG, GIF up to 2MB') }}</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <a href="{{ route('dashboard') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-green mr-3">{{ __('Cancel') }}</a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-green hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-green">{{ __('Submit Report') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
