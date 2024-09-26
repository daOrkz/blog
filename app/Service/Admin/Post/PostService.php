<?php

namespace App\Service\Admin\Post;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store($data)
    {
        if (isset($data['tag_ids'])) {
            $tag_ids = $data['tag_ids'];
            unset($data['tag_ids']);
        } else $tag_ids = null;

        if (isset($data['preview_image'])) {
            $data['preview_image'] = Storage::disk('public')->put('/images/preview', $data['preview_image']);
        }

        if (isset($data['main_image'])) {
            $data['main_image'] = Storage::disk('public')->put('/images/main', $data['main_image']);
        }

        DB::transaction(function () use ($data, $tag_ids) {
            $posts = Post::firstOrCreate($data);

            if (isset($tag_ids)) {
                $posts->tags()->attach($tag_ids);
            }
        });
    }

    public function update($data, $id)
    {
        if (isset($data['tag_ids'])) {
            $tag_ids = $data['tag_ids'];
            unset($data['tag_ids']);
        } else $tag_ids = null;

        $post = Post::findOrFail($id);

        if (isset($data['preview_image'])) {
            $data['preview_image'] = Storage::disk('public')->put('/images/preview', $data['preview_image']);
        }
        if (isset($data['main_image'])) {
            $data['main_image'] = Storage::disk('public')->put('/images/main', $data['main_image']);
        }

        DB::transaction(function () use ($tag_ids, $data, $post) {
            $post->update($data);

            if (isset($tag_ids)) {
                $post->tags()->sync($tag_ids);
            }
        });

    }
}
