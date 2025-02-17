<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $posts = Post::paginate(9);
//        $posts = Post::all();
        $allPosts = Post::all();
        $randomPosts = $allPosts->random(fn (Collection $items) => min(4, count($items)));

        $likedPosts = Post::withCount('postUserLiked')
            ->orderBy('post_user_liked_count', 'DESC')
            ->get()
            ->take(4);

//        dd(auth()->user()->can('view-admin-panel-link', [self::class]));
//        dd(auth()->user()->can('admin', [self::class]));
//        if ($request->user()->can('admin', [self::class])) {
//            dd(11);
//        }


//        dd($this->authorize('admin', [self::class]));


        return view('main.index', compact('posts', 'randomPosts', 'likedPosts'));
    }
}
