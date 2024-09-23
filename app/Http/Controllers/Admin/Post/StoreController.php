<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\Post;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        Post::firstOrCreate(['title' => $data['title']],[
            'title' => $data['title']
        ]);

        return redirect(route('admin.posts.index'));
    }
}
