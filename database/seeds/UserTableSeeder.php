<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        factory(\App\User::class)->create([
            'name' => 'Octavio Cornejo',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);

        factory(\App\User::class, 10)->create();
    }
}
