<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Customer::class, 4)->create();
    }
}
