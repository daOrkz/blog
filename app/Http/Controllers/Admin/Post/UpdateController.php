<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, $id)
    {
        $data = $request->validated();

        $post = Post::findOrFail($id);

        $post->update(['title' => $data['title']]);

//        $category->title = $data['title'];
//        $category->save();

        return redirect(route('admin.posts.index'));
    }
}
