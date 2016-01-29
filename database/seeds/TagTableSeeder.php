<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert(
        [
            ['name' => 'star'],
            ['name' => 'galaxy'],
            ['name' => 'moon'],
            ['name' => 'princess'],
            ['name' => 'vador'],
        ]
        );
    }
}
