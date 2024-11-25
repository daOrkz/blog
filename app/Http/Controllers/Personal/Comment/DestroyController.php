<?php

namespace App\Http\Controllers\Personal\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect(route('personal.comment.index'));
    }
}
