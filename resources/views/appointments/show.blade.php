<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Appointment Details') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('appointments.edit', $appointment) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit
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
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg mb-6">
                        <h2 class="text-lg font-semibold mb-4">Customer Information</h2>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                                <dd class="text-lg">{{ $appointment->customer_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                <dd class="text-lg">{{ $appointment->customer_email }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone</dt>
                                <dd class="text-lg">{{ $appointment->customer_phone }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                <dd class="text-lg">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $appointment->status === 'confirmed' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $appointment->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg mb-6">
                        <h2 class="text-lg font-semibold mb-4">Booking Details</h2>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Service</dt>
                                <dd class="text-lg">{{ $appointment->service->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Price</dt>
                                <dd class="text-lg font-semibold text-green-600">${{ number_format($appointment->price, 2) }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</dt>
                                <dd class="text-lg">{{ $appointment->appointment_date->format('F d, Y') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Time</dt>
                                <dd class="text-lg">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</dd>
                            </div>
                            @if($appointment->notes)
                                <div class="md:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Notes</dt>
                                    <dd class="text-lg">{{ $appointment->notes }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>

                    @if($appointment->payment)
                        <div class="bg-green-50 dark:bg-green-900 p-6 rounded-lg mb-6">
                            <h2 class="text-lg font-semibold mb-4 text-green-800 dark:text-green-200">Payment Information</h2>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Amount Paid</p>
                                    <p class="text-2xl font-bold text-green-600">${{ number_format($appointment->payment->amount, 2) }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Payment Method</p>
                                    <p class="text-lg font-semibold">{{ ucfirst(str_replace('_', ' ', $appointment->payment->payment_method)) }}</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('payments.show', $appointment->payment) }}" class="text-green-600 hover:text-green-800 font-medium">
                                    View Payment Details →
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="bg-yellow-50 dark:bg-yellow-900 p-6 rounded-lg mb-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h2 class="text-lg font-semibold text-yellow-800 dark:text-yellow-200">Payment Pending</h2>
                                    <p class="text-sm text-yellow-700 dark:text-yellow-300">This appointment hasn't been paid yet.</p>
                                </div>
                                <a href="{{ route('payments.create', ['appointment' => $appointment->id]) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                                    Process Payment
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="mt-6">
                        <h2 class="text-lg font-semibold mb-4">Timeline</h2>
                        <div class="border-l-2 border-blue-500 ml-3 space-y-4">
                            <div class="pl-4">
                                <p class="text-sm text-gray-500">Created on</p>
                                <p class="font-medium">{{ $appointment->created_at->format('F d, Y g:i A') }}</p>
                            </div>
                            <div class="pl-4">
                                <p class="text-sm text-gray-500">Scheduled for</p>
                                <p class="font-medium">{{ $appointment->appointment_date->format('F d, Y') }} at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</p>
                            </div>
                            @if($appointment->payment)
                                <div class="pl-4">
                                    <p class="text-sm text-gray-500">Payment processed on</p>
                                    <p class="font-medium">{{ $appointment->payment->payment_date->format('F d, Y g:i A') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
