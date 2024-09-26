<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

//        foreach ($tags as $tag){;
//        $post->tags->contains($tag) ? dump($tag) : dump('none');
//        }
//        dd($post->tags);

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }
}
