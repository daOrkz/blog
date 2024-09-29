<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }
}
