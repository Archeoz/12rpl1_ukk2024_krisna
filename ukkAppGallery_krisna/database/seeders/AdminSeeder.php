<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'Anjai man',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'favthing' => 'adminpower',
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}
