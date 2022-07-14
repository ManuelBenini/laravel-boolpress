<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;

class PostsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++) {
            $post = Post::inRandomOrder()->first();

            $tag = Tag::inRandomOrder()->first()->id;

            if(!$post->tags->contains($tag)){
                $post->tags()->attach($tag);
            }

        }
    }
}
