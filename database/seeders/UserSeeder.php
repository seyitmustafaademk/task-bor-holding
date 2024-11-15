<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'firstname' => 'Seyit Mustafa Adem',
            'lastname' => 'Kandemir',
            'email' => 'seyitmustafaademk@gmail.com',
            'password' => Hash::make('Pa$$w0rd!1871.'),
        ]);

        User::factory(15)->create();
    }
}
