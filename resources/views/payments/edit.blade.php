<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Payment') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('payments.show', $payment) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    View Details
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
                    <form action="{{ route('payments.update', $payment) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="appointment_id" class="block text-sm font-medium mb-2">Appointment *</label>
                            <select name="appointment_id" id="appointment_id" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('appointment_id') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                                @foreach($appointments as $appointment)
                                    <option value="{{ $appointment->id }}" {{ old('appointment_id', $payment->appointment_id) == $appointment->id ? 'selected' : '' }}>
                                        {{ $appointment->customer_name }} - {{ $appointment->service->name }} on {{ $appointment->appointment_date->format('M d, Y') }} - ${{ number_format($appointment->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('appointment_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium mb-2">Amount ($) *</label>
                            <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount', $payment->amount) }}" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('amount') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                            @error('amount')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="payment_method" class="block text-sm font-medium mb-2">Payment Method *</label>
                            <select name="payment_method" id="payment_method" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('payment_method') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                                <option value="cash" {{ old('payment_method', $payment->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="credit_card" {{ old('payment_method', $payment->payment_method) == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="debit_card" {{ old('payment_method', $payment->payment_method) == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                <option value="bank_transfer" {{ old('payment_method', $payment->payment_method) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="e_wallet" {{ old('payment_method', $payment->payment_method) == 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                            </select>
                            @error('payment_method')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="payment_date" class="block text-sm font-medium mb-2">Payment Date *</label>
                            <input type="datetime-local" name="payment_date" id="payment_date" value="{{ old('payment_date', $payment->payment_date->format('Y-m-d\TH:i')) }}" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('payment_date') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                            @error('payment_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="transaction_id" class="block text-sm font-medium mb-2">Transaction ID</label>
                            <input type="text" name="transaction_id" id="transaction_id" value="{{ old('transaction_id', $payment->transaction_id) }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('transaction_id') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                            @error('transaction_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium mb-2">Status *</label>
                            <select name="status" id="status" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('status') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                                <option value="pending" {{ old('status', $payment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ old('status', $payment->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="failed" {{ old('status', $payment->status) == 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="refunded" {{ old('status', $payment->status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium mb-2">Notes</label>
                            <textarea name="notes" id="notes" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('notes') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">{{ old('notes', $payment->notes) }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Payment
                            </button>
                            <a href="{{ route('payments.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
