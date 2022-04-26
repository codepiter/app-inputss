<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_type = new UserType();
        $user_type->type = "Administrador";
        $user_type->save();
        //------------
        $user_type2 = new UserType();
        $user_type2->type = "Cliente";
        $user_type2->save();
    }
}
