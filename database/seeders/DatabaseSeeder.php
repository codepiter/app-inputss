<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Seeders tipos de usuario
        \App\Models\UserType::insert([
            ['type' => 'Administrador'],
            ['type' => 'Cliente'],
        ]);

        $ad = \App\Models\Ads\Advertising::create(
            [
                'advertising' => 'Sin anuncios',
                'head' => '<script></script>',
                'block' => '<div style="marging-left:20%; marging-right:20%;"><h3 style="background-color:gray;">Un Anuncio</h3></div>',
                'horizontal' => '<div style="background-color:gray;"><h3 style="padding-top:40px">Un Anuncio</h4><br></div>',
            ]
        );

        \App\Models\Ads\StateAd::insert([
            'active' => false,
            'advertisements_id' => ($ad->id),
        ]);
    }
}