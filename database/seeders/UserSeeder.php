<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        $admin->assignRole('admin');

        $waiter = User::create([
            'name' => 'waiter',
            'email' => 'waiter@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        $waiter->assignRole('waiter');

        $kasir = User::create([
            'name' => 'kasir',
            'email' => 'kasir@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        $kasir->assignRole('kasir');

        $owner = User::create([
            'name' => 'owner',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        $owner->assignRole('owner');

    }
}
