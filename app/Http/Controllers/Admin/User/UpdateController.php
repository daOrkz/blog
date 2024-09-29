<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, $id)
    {
        $data = $request->validated();

        $user = User::findOrFail($id);

        $user->update(['title' => $data['title']]);

//        $category->title = $data['title'];
//        $category->save();

        return redirect(route('admin.users.index'));
    }
}
