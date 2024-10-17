<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CarSeeder extends Seeder
{
    public function run()
    {
        $cars = [
            ['name' => 'Toyota Corolla'],
            ['name' => 'Ford Mustang'],
            ['name' => 'Chevrolet Camaro'],
            ['name' => 'Honda Civic'],
            ['name' => 'Mazda 3'],
            ['name' => 'Tesla Model 3'],
            ['name' => 'BMW 3 Series'],
            ['name' => 'Audi A4'],
            ['name' => 'Mercedes-Benz C-Class'],
            ['name' => 'Volkswagen Golf'],
            ['name' => 'Hyundai Elantra'],
            ['name' => 'Nissan Altima'],
            ['name' => 'Subaru Impreza'],
            ['name' => 'Kia Forte'],
            ['name' => 'Dodge Charger'],
        ];

        foreach ($cars as $car) {
            DB::table('cars')->insert([
                'id' => Str::uuid(),         // Generar un UUID
                'name' => $car['name'],      // Nombre del auto
                'available' => true,         // Auto disponible
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
