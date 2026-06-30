<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['name' => 'Budi Santoso', 'phone' => '081234567890', 'email' => 'budi@example.com', 'address' => 'Jl. Mawar No. 10'],
            ['name' => 'Siti Aminah', 'phone' => '081234567891', 'email' => 'siti@example.com', 'address' => 'Jl. Melati No. 5'],
            ['name' => 'Andi Wijaya', 'phone' => '081234567892', 'email' => null, 'address' => 'Jl. Kenanga No. 3'],
            ['name' => 'Walk-in Customer', 'phone' => '000000000000', 'email' => null, 'address' => null],
        ];

        foreach ($customers as $customer) {
            Customer::firstOrCreate(['phone' => $customer['phone']], $customer);
        }
    }
}
