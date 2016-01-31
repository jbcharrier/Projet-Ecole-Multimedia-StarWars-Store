<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert(

            [
                [
                    'title'      => 'Lazers',
                    'slug'       => 'lazers',
                ],
                [
                    'title'      => 'Casques',
                    'slug'       => 'casques',
                ],
            ]
        );
    }
}
