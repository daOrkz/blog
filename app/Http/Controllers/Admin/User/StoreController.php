<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Mail\User\SendPassword;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        Mail::to($data['email'])->queue(new SendPassword($data));

        $data['password'] = Hash::make($data['password']);

        $user = User::firstOrCreate(['email' => $data['email']], $data);

        event(new Registered($user));

        return redirect(route('admin.users.index'));
    }
}
