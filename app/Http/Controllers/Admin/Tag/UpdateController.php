<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Models\Tag;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, $id)
    {
        $data = $request->validated();

        $category = Tag::findOrFail($id);

        $category->update(['title' => $data['title']]);

//        $category->title = $data['title'];
//        $category->save();

        return redirect(route('admin.tags.index'));
    }
}
