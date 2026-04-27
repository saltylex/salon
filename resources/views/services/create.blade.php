<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create New Service') }}
            </h2>
            <a href="{{ route('services.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Services
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium mb-2">Service Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('name') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium mb-2">Price ($) *</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('price') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="duration" class="block text-sm font-medium mb-2">Duration *</label>
                            <input type="text" name="duration" id="duration" value="{{ old('duration') }}" required
                                placeholder="e.g., 30 mins, 1 hour"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('duration') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                            @error('duration')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium mb-2">Description</label>
                            <textarea name="description" id="description" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('description') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Service
                            </button>
                            <a href="{{ route('services.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
