<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $payments = Payment::with('appointment.service')->latest()->paginate(10);

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $appointments = Appointment::where('status', '!=', 'cancelled')
            ->whereDoesntHave('payment')
            ->with('service')
            ->orderBy('appointment_date')
            ->get();

        return view('payments.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        $appointment = Appointment::findOrFail($request->appointment_id);

        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,credit_card,debit_card,bank_transfer,e_wallet',
            'payment_date' => 'required|date',
            'transaction_id' => 'nullable|string|max:100|unique:payments,transaction_id',
            'status' => 'required|in:pending,paid,failed,refunded',
            'notes' => 'nullable|string',
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Payment recorded successfully.');
    }

    public function show(Payment $payment)
    {
        $payment->load('appointment.service');

        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $appointments = Appointment::where('status', '!=', 'cancelled')
            ->with('service')
            ->orderBy('appointment_date')
            ->get();

        return view('payments.edit', compact('payment', 'appointments'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,credit_card,debit_card,bank_transfer,e_wallet',
            'payment_date' => 'required|date',
            'transaction_id' => 'nullable|string|max:100|unique:payments,transaction_id,'.$payment->id,
            'status' => 'required|in:pending,paid,failed,refunded',
            'notes' => 'nullable|string',
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully.');
    }
}
