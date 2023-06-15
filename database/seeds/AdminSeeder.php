<?php

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
        $user = \App\Models\User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'mohamedelgallad1982@gmail.com',
            'mobile' => '01272555871',
            'password' => bcrypt('ykmamem#2021*'),
        ]);
        $user->attachRole('admin');
    }
}
