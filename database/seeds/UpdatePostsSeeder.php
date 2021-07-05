<?php

use App\Category;
use App\Post;
use Illuminate\Database\Seeder;

class UpdatePostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //prendo tutti i posts
        $posts = Post::all();
        //poi li ciclo e gli dico di inserire nella colonna category_id
        //un numero random compreso tra gli id presenti nella tabella categories
        foreach ($posts as $post) {
            $data=[
                //in questo modo prenderà un id in maniera randomica ad ogni cilco
                //del foreach elo metto dentro una variabile array
                'category_id'=>Category::inRandomOrder()->first()->id
            ];
            //infine faccio l'update e inserisco il seed in DatabaseSeeder
            //e uso il comando per pushare nella tabella php artisan db:seed
            $post->update($data);
        }
    }
}
