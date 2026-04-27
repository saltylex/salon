<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointments = Appointment::whereDoesntHave('payment')->get();
        $statuses = ['paid', 'pending', 'failed', 'refunded'];
        $methods = ['cash', 'credit_card', 'debit_card', 'bank_transfer', 'e_wallet'];

        $payments = [];
        $transactionIds = [];

        $selectedAppointments = $appointments->random(min(rand(10, 20), $appointments->count()));

        foreach ($selectedAppointments as $appointment) {
            $status = $statuses[array_rand($statuses)];
            $amount = $status === 'failed' ? round($appointment->price * rand(50, 90) / 100, 2) : $appointment->price;

            do {
                $transactionId = fake()->uuid();
            } while (in_array($transactionId, $transactionIds, true));

            $transactionIds[] = $transactionId;

            $paymentDate = match($status) {
                'paid' => fake()->dateTimeBetween($appointment->appointment_date, '+7 days'),
                'pending' => fake()->dateTimeBetween($appointment->appointment_date, $appointment->appointment_date . ' +2 days'),
                'failed' => fake()->dateTimeBetween($appointment->appointment_date, $appointment->appointment_date . ' +1 day'),
                'refunded' => fake()->dateTimeBetween($appointment->appointment_date, '+30 days'),
            };

            $payments[] = [
                'appointment_id' => $appointment->id,
                'amount' => $amount,
                'payment_method' => $methods[array_rand($methods)],
                'payment_date' => $paymentDate,
                'transaction_id' => $transactionId,
                'status' => $status,
                'notes' => rand(0, 3) === 0 ? fake()->sentence() : null,
                'created_at' => $paymentDate,
                'updated_at' => $paymentDate,
            ];
        }

        Payment::insert($payments);
    }
}
