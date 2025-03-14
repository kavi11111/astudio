<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        User::create([
            'first_name' => 'Kavi',
            'last_name' => 'yarasan',
            'email' => 'kavi@gmail.com',
            'password' => bcrypt('qwerty'),
        ]);
    
        User::create([
            'first_name' => 'Patrick',
            'last_name' => 'jane',
            'email' => 'jane@gmail.com',
            'password' => bcrypt('ytrewq'),
        ]);
    }
}
