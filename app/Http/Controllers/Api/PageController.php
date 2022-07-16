<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        // Oppure ->with('category)->with('tags)
        $posts = Post::with(['category', 'tags'])->paginate(5);

        $categories = Category::all();
        $tags = Tag::all();

        return response()->json(compact('posts', 'categories', 'tags'));
    }

    public function getPost($slug){
        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        return response()->json($post);
    }

    public function getPostByCategory($category_slug){
        $post_by_category = Category::where('slug', $category_slug)->with('posts')->first();

        return response()->json($post_by_category);
    }

    public function getPostByTag($tag_slug){
        $post_by_tag = Tag::where('slug', $tag_slug)->with('posts')->first();

        return response()->json($post_by_tag);
    }

    public function getPostsByCatTag($category_slug, $tag_slug){
        // Ottengo la categoria scelta
        $category = Category::where('slug', $category_slug)->first();

        // Ottengo il tag scelto
        $tag = Tag::where('slug', $tag_slug)->first();
        $tag_id = $tag->id;

        // Filtro i post che hanno la categoria scelta e filtro nuovamente in base al tag scelto
        $posts = Post::where('category_id', $category->id)->whereHas('tags', function ($query) use ($tag_id){
            $query->where('id', $tag_id);
        })->with(['category','tags'] )->get();

        return response()->json($posts);
    }
}
