<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\User;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        User::firstOrCreate(['title' => $data['title']],[
            'title' => $data['title']
        ]);

        return redirect(route('admin.users.index'));
    }
}
