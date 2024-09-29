<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect(route('admin.users.index'));
    }
}
