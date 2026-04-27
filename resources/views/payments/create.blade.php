<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Record Payment') }}
            </h2>
            <a href="{{ route('payments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Payments
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('payments.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="appointment_id" class="block text-sm font-medium mb-2">Appointment *</label>
                            <select name="appointment_id" id="appointment_id" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('appointment_id') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                                <option value="">Select an appointment</option>
                                @foreach($appointments as $appointment)
                                    <option value="{{ $appointment->id }}" data-amount="{{ $appointment->price }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                        {{ $appointment->customer_name }} - {{ $appointment->service->name }} on {{ $appointment->appointment_date->format('M d, Y') }} at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }} - ${{ number_format($appointment->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('appointment_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-sm text-gray-500 mt-1">Only unpaid appointments are shown.</p>
                        </div>

                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium mb-2">Amount ($) *</label>
                            <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('amount') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                            @error('amount')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="payment_method" class="block text-sm font-medium mb-2">Payment Method *</label>
                            <select name="payment_method" id="payment_method" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('payment_method') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                                <option value="">Select payment method</option>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="debit_card" {{ old('payment_method') == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                            </select>
                            @error('payment_method')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="payment_date" class="block text-sm font-medium mb-2">Payment Date *</label>
                            <input type="datetime-local" name="payment_date" id="payment_date" value="{{ old('payment_date', now()->format('Y-m-d\TH:i')) }}" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('payment_date') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                            @error('payment_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="transaction_id" class="block text-sm font-medium mb-2">Transaction ID</label>
                            <input type="text" name="transaction_id" id="transaction_id" value="{{ old('transaction_id') }}"
                                placeholder="Optional - for card/e-wallet transactions"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('transaction_id') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                            @error('transaction_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium mb-2">Status *</label>
                            <select name="status" id="status" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('status') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="refunded" {{ old('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium mb-2">Notes</label>
                            <textarea name="notes" id="notes" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md @error('notes') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Record Payment
                            </button>
                            <a href="{{ route('payments.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const appointmentSelect = document.getElementById('appointment_id');
            const amountInput = document.getElementById('amount');

            function updateAmount() {
                const selectedOption = appointmentSelect.options[appointmentSelect.selectedIndex];
                if (selectedOption.value && selectedOption.dataset.amount) {
                    amountInput.value = parseFloat(selectedOption.dataset.amount).toFixed(2);
                } else {
                    amountInput.value = '';
                }
            }

            appointmentSelect.addEventListener('change', updateAmount);
            updateAmount();
        });
    </script>
    @endpush
</x-app-layout>
