<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Classic Manicure', 'price' => 25.00, 'duration' => '30 mins', 'description' => 'Basic nail shaping, cuticle care, hand massage, and polish.'],
            ['name' => 'Gel Manicure', 'price' => 45.00, 'duration' => '45 mins', 'description' => 'Long-lasting gel polish with UV/LED curing.'],
            ['name' => 'Classic Pedicure', 'price' => 35.00, 'duration' => '45 mins', 'description' => 'Foot soak, nail trimming, callus removal, and polish.'],
            ['name' => 'Gel Pedicure', 'price' => 55.00, 'duration' => '60 mins', 'description' => 'Gel polish application with full pedicure treatment.'],
            ['name' => 'Nail Extensions (Acrylic)', 'price' => 60.00, 'duration' => '90 mins', 'description' => 'Full set of acrylic nail extensions.'],
            ['name' => 'Nail Extensions (Gel)', 'price' => 70.00, 'duration' => '90 mins', 'description' => 'Gel nail extensions for a natural look.'],
            ['name' => 'Nail Art (Basic)', 'price' => 15.00, 'duration' => '15 mins', 'description' => 'Simple designs, stripes, dots, and basic patterns.'],
            ['name' => 'Nail Art (Advanced)', 'price' => 35.00, 'duration' => '30 mins', 'description' => 'Hand-painted designs, 3D art, and intricate patterns.'],
            ['name' => 'Polish Change', 'price' => 15.00, 'duration' => '20 mins', 'description' => 'Remove old polish and apply new polish.'],
            ['name' => 'Nail Repair', 'price' => 10.00, 'duration' => '10 mins', 'description' => 'Fix broken or cracked nails.'],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['name' => $service['name']],
                $service
            );
        }
    }
}
