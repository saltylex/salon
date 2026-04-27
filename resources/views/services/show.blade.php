<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Service Details') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('services.edit', $service) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit Service
                </a>
                <a href="{{ route('services.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Service Name</dt>
                                <dd class="mt-1 text-lg font-semibold">{{ $service->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Price</dt>
                                <dd class="mt-1 text-lg font-semibold text-green-600">${{ number_format($service->price, 2) }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Duration</dt>
                                <dd class="mt-1 text-lg">{{ $service->duration }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</dt>
                                <dd class="mt-1 text-lg">{{ $service->created_at->format('M d, Y') }}</dd>
                            </div>
                            @if($service->description)
                                <div class="md:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</dt>
                                    <dd class="mt-1 text-lg">{{ $service->description }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>

                    <div class="mt-8">
                        <h2 class="text-xl font-semibold mb-4">Related Appointments</h2>
                        @if($service->appointments->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg">
                                    <thead class="bg-gray-100 dark:bg-gray-600">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Customer</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Time</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                        @foreach($service->appointments as $appointment)
                                            <tr>
                                                <td class="px-6 py-4">{{ $appointment->customer_name }}</td>
                                                <td class="px-6 py-4">{{ $appointment->appointment_date->format('M d, Y') }}</td>
                                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</td>
                                                <td class="px-6 py-4">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        {{ $appointment->status === 'confirmed' ? 'bg-blue-100 text-blue-800' : '' }}
                                                        {{ $appointment->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                                        {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">No appointments for this service.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
