<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke($id)
    {
        $post = Post::find($id);
        auth()->user()->userPostLiked()->detach($post->id);

        return redirect(route('personal.liked.index'));
    }
}
