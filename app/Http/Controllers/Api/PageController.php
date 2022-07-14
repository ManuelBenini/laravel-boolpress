<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        // Oppure ->with('category)->with('tags)
        $posts = Post::with(['category', 'tags'])->paginate(5);

        return response()->json($posts);
    }
}
