<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect(route('admin.posts.index'));
    }
}
