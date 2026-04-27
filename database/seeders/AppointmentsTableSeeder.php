<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'test@example.com')->first();
        $services = Service::all();
        $statuses = ['confirmed', 'completed', 'cancelled'];
        $now = now();

        $appointments = [];

        for ($i = 0; $i < 35; $i++) {
            $randomDays = rand(-45, 30);
            $randomHour = rand(8, 18);
            $randomMinute = rand(0, 3) * 15;

            $appointmentDate = $now->copy()->addDays($randomDays)->setTime($randomHour, $randomMinute);
            $service = $services->random();
            $status = $statuses[array_rand($statuses)];

            $appointments[] = [
                'customer_name' => fake()->name(),
                'customer_email' => fake()->unique()->safeEmail(),
                'customer_phone' => fake()->e164PhoneNumber(),
                'service_id' => $service->id,
                'appointment_date' => $appointmentDate->toDateString(),
                'appointment_time' => $appointmentDate->format('H:i:s'),
                'price' => $service->price,
                'status' => $status,
                'notes' => rand(0, 3) === 0 ? fake()->sentence() : null,
                'created_at' => fake()->dateTimeBetween('-45 days', 'now'),
                'updated_at' => fake()->dateTimeBetween('-45 days', 'now'),
            ];
        }

        Appointment::insert($appointments);
    }
}
