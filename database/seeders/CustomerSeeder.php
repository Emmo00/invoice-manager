<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()
            ->count(20)
            ->hasInvoices(5)
            ->create();

        Customer::factory()
            ->count(70)
            ->hasInvoices(1)
            ->create();

        Customer::factory()
            ->count(10)
            ->hasInvoices(3)
            ->create();

        Customer::factory()
            ->count(10)
            ->create();
    }
}
