<?php

use App\Tag;
use App\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $tags;

    public function __construct(Tag $tag) //$tag devient ainsi une variable de classe
    {
        $this->tag = $tag;
    }

    public function run()
    {

        $shuffle = function($tags, $num)
        {
            $s=[];
            while($num>=0)
            {
                $s[] = $tags[$num];
                $num--;
            }

            return $s;
        };

        // pour utiliser la fonction anonyme $shuffle($tags, 2);

        $max = $this->tag->count(); // autre solution $max = Tag::count(); On compte le nb de tags existant.
        $tags = $this->tag->lists('id'); // liste des id des tags // $tags=Tag::lists('id'); renvoie un tableau numérique des ids // lists('name', 'id') renvoie un [] associatifs name=>id

        factory(App\Product::class, 15)->create()->each(function($product)use($max, $tags, $shuffle){

            $product->tags()->attach($shuffle($tags, rand(1, $max - 1))); // On attache les tags au produit selon la règle définie par la fonction shuffle // $product->tags()->attach([1,2,3]); // Product::find(1)->tags()->attach([1,2]);

        });
    }
}
