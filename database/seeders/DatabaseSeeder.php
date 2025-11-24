<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
public function run(): void
{
    User::updateOrCreate(
        ['email' => 'admin@mail.com'],
        [
            'name' => 'Super Admin',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'merchant_code' => null,
            'state_code' => null,
            'state' => null,
            'gst_no' => null,
        ]
    );
    $this->call(DemoDataSeeder::class);

}

}
