<?php

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Omar',
            'last_name' => 'Ehab',
            'email' => 'teacher@app.com',
            'mobile' => '01113060202',
            'password' => bcrypt("123456789"),
            'available_balance' => 1000
        ]);
        $user->attachRole("teacher");
        $teacher = Teacher::create([
            'user_id' => $user->id,
            'address' => 'Test Address',
            'country' => 'Egypt',
            'city' => 'Alexandria',
            'gender' => 'male',
        ]);
    }
}
