<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
 
        $user->email = "codepiter@gmail.com";
       // $user->password = "22222222";
        $user->password = Hash::make('22222222');
        //'password' => Hash::make('password'),
        $user->nimda_si = 1;
        $user->save();
    }
}
