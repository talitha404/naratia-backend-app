<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'username' => 'required',
            'name' => 'nullable',
            'bio' => 'nullable',
        ]);

        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'bio' => $request->bio,
        ]);

        return response()->json([
            'message' => 'Profile updated',
            'user' => $user,
        ]);
    }
}