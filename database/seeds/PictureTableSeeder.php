<?php

use App\Product;
use App\Picture;
use Illuminate\Database\Seeder;
//php artisan migrate:refresh --seed



class PictureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $faker;

    public function __construct(Faker\Generator $faker)
    {
        $this->faker = $faker;
    }

    public function run()
    {
        // on commence par supprimer les images déjà créées.
        $files = Storage::allFiles(); // retourne un tableau du nom des images.


        foreach($files as $file)
        {
            Storage::delete($file);
        }

        $products = Product::all(); // je vais récupérer tous les produits

       foreach($products as $product){

            $uri = str_random(12).'_370x235.jpg';
            Storage::put(
                $uri,
                file_get_contents('http://lorempixel.com/futurama/370/235/')
            );

            Picture::create([
                'product_id' => $product->id, // je récupère l'id
                'uri' => $uri,
                'title' => $this->faker->name
            ]);
        }
    }
}
