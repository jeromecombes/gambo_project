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
        $user = new User();
        $user->email = 'jerome.combes@biblibre.com';
        $user->password = Hash::make('password');
        $user->admin = 1;
        $user->lastname = 'Combes';
        $user->firstname = 'Jérôme';
        $user->access = [10,11,12];
        $user->university = 'VWPP';
        $user->language = 'fr';
        $user->save();
    }
}
