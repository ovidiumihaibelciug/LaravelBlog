<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory('App\User'::class, 20)->create();
        factory('App\Post'::class, 1000)->create();
        factory('App\Comment'::class, 2000)->create();
    }
}
