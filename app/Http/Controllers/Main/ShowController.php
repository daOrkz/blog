<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ShowController extends Controller
{
    public function __invoke($id)
    {
        $post = Post::findOrFail($id);

        $date = Carbon::parse($post->created_at);

        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $id)
            ->get();
        $randomRelated = $relatedPosts->random(fn (Collection $items) => min(4, count($items)));


        return view('main.show', compact('post' , 'date', 'randomRelated'));
    }
}
