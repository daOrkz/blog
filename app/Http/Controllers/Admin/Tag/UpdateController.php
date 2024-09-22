<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Tag;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, $id)
    {
        $data = $request->validated();

        $tag = Tag::findOrFail($id);

        $tag->update(['title' => $data['title']]);

//        $category->title = $data['title'];
//        $category->save();

        return redirect(route('admin.tags.index'));
    }
}
