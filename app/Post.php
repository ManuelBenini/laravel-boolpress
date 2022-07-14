<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id'
    ];

    public static function generateSlug($title){
        $slug = Str::slug($title, '-');
        $base_slug = $slug;
        $counter = 1;
        $slug_already_exist = Post::where('slug', $slug)->first();

        while($slug_already_exist){
           $slug = $base_slug . '-' . $counter;
           $counter++;
           $slug_already_exist = Post::where('slug', $slug)->first();
        }
        return $slug;
    }
}
