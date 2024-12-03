<?php

namespace App\Http\Controllers\Main\Like;

use App\Http\Controllers\Controller;
use App\Models\Comment;


class StoreController extends Controller
{
    public function __invoke( $id)
    {
        $user = auth()->user();
        $user->userPostLiked()->toggle($id);

        return redirect()->back();
    }
}
