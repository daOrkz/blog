<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::paginate(9);
//        $posts = Post::all();
        $randomPosts = Post::all()->random(4);

        $likedPosts = Post::withCount('postUserLiked')
            ->orderBy('post_user_liked_count', 'DESC')
            ->get()
            ->take(4);

        return view('main.index', compact('posts', 'randomPosts', 'likedPosts'));
    }
}
