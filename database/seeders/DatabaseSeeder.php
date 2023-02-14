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

        // $this->call(PermissionsTableSeeder::class);
        $this->call(Depedencias::class);
        $this->call(Usuarios::class);
        // $this->call(ActividadTableSeeder::class);
        // $this->call(UbigeoTableSeeder::class);
        // if (env("APP_ENV") == 'local') {
        //     $this->call(ProyectoTableSeeder::class);
        // }
        
    }
}
