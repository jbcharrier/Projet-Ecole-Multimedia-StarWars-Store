<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tags')->insert(
        [
            ['name' => 'déguisement'],
            ['name' => 'arme'],
            ['name' => 'jedi'],
            ['name' => 'stormtrooper'],
            ['name' => 'vador'],
        ]
        );
    }
}
