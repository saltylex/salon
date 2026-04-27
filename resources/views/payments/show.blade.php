<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Payment Details') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('payments.edit', $payment) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('payments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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
                        <h2 class="text-lg font-semibold mb-4">Payment Information</h2>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Amount</dt>
                                <dd class="text-2xl font-bold text-green-600">${{ number_format($payment->amount, 2) }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                <dd>
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                                        {{ $payment->status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $payment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $payment->status === 'failed' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $payment->status === 'refunded' ? 'bg-purple-100 text-purple-800' : '' }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Payment Method</dt>
                                <dd class="text-lg">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Payment Date</dt>
                                <dd class="text-lg">{{ $payment->payment_date->format('F d, Y g:i A') }}</dd>
                            </div>
                            @if($payment->transaction_id)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Transaction ID</dt>
                                    <dd class="text-lg font-mono">{{ $payment->transaction_id }}</dd>
                                </div>
                            @endif
                            @if($payment->notes)
                                <div class="md:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Notes</dt>
                                    <dd class="text-lg">{{ $payment->notes }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>

                    <div class="bg-blue-50 dark:bg-blue-900 p-6 rounded-lg mb-6">
                        <h2 class="text-lg font-semibold mb-4 text-blue-800 dark:text-blue-200">Appointment Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Customer</p>
                                <p class="text-lg font-semibold">{{ $payment->appointment->customer_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Service</p>
                                <p class="text-lg font-semibold">{{ $payment->appointment->service->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Appointment Date</p>
                                <p class="text-lg">{{ $payment->appointment->appointment_date->format('F d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Appointment Time</p>
                                <p class="text-lg">{{ \Carbon\Carbon::parse($payment->appointment->appointment_time)->format('g:i A') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Contact</p>
                                <p class="text-lg">{{ $payment->appointment->customer_phone }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Appointment Status</p>
                                <p>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $payment->appointment->status === 'confirmed' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $payment->appointment->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $payment->appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($payment->appointment->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-blue-200 dark:border-blue-700">
                            <a href="{{ route('appointments.show', $payment->appointment) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                View Full Appointment Details →
                            </a>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                        <h2 class="text-lg font-semibold mb-4">Timeline</h2>
                        <div class="border-l-2 border-blue-500 ml-3 space-y-4">
                            <div class="pl-4">
                                <p class="text-sm text-gray-500">Payment Recorded</p>
                                <p class="font-medium">{{ $payment->created_at->format('F d, Y g:i A') }}</p>
                            </div>
                            <div class="pl-4">
                                <p class="text-sm text-gray-500">Payment Date</p>
                                <p class="font-medium">{{ $payment->payment_date->format('F d, Y g:i A') }}</p>
                            </div>
                            <div class="pl-4">
                                <p class="text-sm text-gray-500">Last Updated</p>
                                <p class="font-medium">{{ $payment->updated_at->format('F d, Y g:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
