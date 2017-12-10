<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        DB::table('role_user')->truncate();

        factory(\App\Role::class)->create([
            'name' => 'admin',
            'description' => 'administrador de todo el bisness',
        ])->each(function ($role) {
            $role->users()->attach(1);
        });
    }
}
