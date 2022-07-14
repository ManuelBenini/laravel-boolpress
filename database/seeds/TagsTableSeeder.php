<?php

use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['Frontend', 'Backend', 'Laravel', 'VueJs', 'UX'];

        foreach ($tags as $tag) {
            $new_tag = new Tag();

            $new_tag->name = $tag;
            $new_tag->slug = Str::slug($tag, '-');

            $new_tag->save();
        }
    }
}
