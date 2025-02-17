<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect(route('admin.categories.index'));
    }
}
