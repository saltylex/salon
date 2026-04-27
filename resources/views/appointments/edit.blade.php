<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Appointment') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('appointments.show', $appointment) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    View Details
                </a>
                <a href="{{ route('appointments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('appointments.update', $appointment) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <label for="customer_name" class="block text-sm font-medium mb-2">Customer Name *</label>
                                    <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $appointment->customer_name) }}" required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('customer_name') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                                    @error('customer_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="customer_email" class="block text-sm font-medium mb-2">Email *</label>
                                    <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email', $appointment->customer_email) }}" required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('customer_email') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                                    @error('customer_email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="customer_phone" class="block text-sm font-medium mb-2">Phone Number *</label>
                                    <input type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone', $appointment->customer_phone) }}" required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('customer_phone') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                                    @error('customer_phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <div class="mb-4">
                                    <label for="service_id" class="block text-sm font-medium mb-2">Service *</label>
                                    <select name="service_id" id="service_id" required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('service_id') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ old('service_id', $appointment->service_id) == $service->id ? 'selected' : '' }}>
                                                {{ $service->name }} - ${{ number_format($service->price, 2) }} ({{ $service->duration }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="appointment_date" class="block text-sm font-medium mb-2">Date *</label>
                                    <input type="date" name="appointment_date" id="appointment_date" value="{{ old('appointment_date', $appointment->appointment_date->format('Y-m-d')) }}" required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('appointment_date') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                                    @error('appointment_date')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="appointment_time" class="block text-sm font-medium mb-2">Time *</label>
                                    <input type="time" name="appointment_time" id="appointment_time" value="{{ old('appointment_time', $appointment->appointment_time->format('H:i')) }}" required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('appointment_time') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                                    @error('appointment_time')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium mb-2">Status *</label>
                                    <select name="status" id="status" required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('status') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                                        <option value="confirmed" {{ old('status', $appointment->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="completed" {{ old('status', $appointment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ old('status', $appointment->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('status')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium mb-2">Notes</label>
                            <textarea name="notes" id="notes" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('notes') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">{{ old('notes', $appointment->notes) }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Appointment
                            </button>
                            <a href="{{ route('appointments.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
