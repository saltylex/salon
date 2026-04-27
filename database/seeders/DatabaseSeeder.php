<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\AppointmentsTableSeeder;
use Database\Seeders\PaymentsTableSeeder;
use Database\Seeders\ServicesTableSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ServicesTableSeeder::class,
            AppointmentsTableSeeder::class,
            PaymentsTableSeeder::class,
        ]);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
