<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        if (isset($data['tag_ids'])) {
            $tag_ids = $data['tag_ids'];
            unset($data['tag_ids']);
        } else $tag_ids = null;

        if (isset($data['preview_image']) && isset($data['main_image'])) {
            $data['preview_image'] = Storage::disk('public')->put('/images/preview', $data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('/images/main', $data['main_image']);
        }

        DB::transaction(function () use ($data, $tag_ids) {
            $posts = Post::firstOrCreate($data);

            if (isset($data['tag_ids'])) {
                $posts->tags()->attach($tag_ids);
            }
        });

        return redirect(route('admin.posts.index'));
    }
}
