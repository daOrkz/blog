<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.pots.edit', compact('post'));
    }
}
