<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(

            [

                [
                    'name'      => 'Tony',
                    'email'     => 'tony@tony.fr',
                    'password'  => Hash::make('Tony'),
                    'role'      => 'administrator'
                ],
                [
                    'name'      => 'Antoine',
                    'email'     => 'antoine@antoine.fr',
                    'password'  => Hash::make('Antoine'),
                    'role'      => 'visitor'
                ],
                [
                    'name'      => 'Romain',
                    'email'     => 'romain@romain.fr',
                    'password'  => Hash::make('Romain'),
                    'role'      => 'visitor'
                ],
                [
                    'name'      => 'yini',
                    'email'     => 'yini@yini.fr',
                    'password'  => Hash::make('yini'),
                    'role'      => 'visitor'
                ],
            ]
        );
    }
}
