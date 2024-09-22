<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke($id)
    {
        $tag = Tag::findOrFail($id);

        $tag->delete();

        return redirect(route('admin.tags.index'));
    }
}
