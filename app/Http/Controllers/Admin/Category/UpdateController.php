<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Category;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, $id)
    {
        $data = $request->validated();

        $category = Category::findOrFail($id);

        $category->update(['title' => $data['title']]);

//        $category->title = $data['title'];
//        $category->save();

        return redirect(route('admin.categories.index'));
    }
}
