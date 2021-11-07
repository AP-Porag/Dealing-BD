<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('asraf@aic.mail.com'),
            'role'=>'admin',
        ]);
        User::create([
            'name'=>'User',
            'email'=>'user@user.com',
            'password'=>Hash::make('user@user.com'),
            'role'=>'user',
        ]);
        User::create([
            'name'=>'Asraf Porag',
            'email'=>'asraf@aic.mail.com',
            'password'=>Hash::make('asraf@aic.mail.com'),
            'role'=>'admin',
        ]);
        User::create([
            'name'=>'Konika Asraf',
            'email'=>'konika@aic.mail.com',
            'password'=>Hash::make('konika@aic.mail.com'),
            'role'=>'user',
        ]);
    }
}
