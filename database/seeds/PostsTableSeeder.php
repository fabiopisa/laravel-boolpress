<?php

use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10 ; $i++) { 
            $new_post = new Post();
            $new_post->title = 'titolo'.($i + 1);
            $new_post->slug = Str::slug($new_post->title,'-');
            $new_post->content = ($i + 1) . 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus error provident maxime illum, repellendus doloremque, laboriosam quam dolore ea porro sunt delectus ab, fugiat eligendi ipsa in obcaecati. Minima, explicabo?';
            $new_post->save();
        }
    }
}
