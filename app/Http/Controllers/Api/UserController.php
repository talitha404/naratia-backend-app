<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    return response()->json($user);
}

    public function update(Request $request, string $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    $user->update($request->all());

    return response()->json([
        'message' => 'User berhasil diupdate',
        'user' => $user
    ]);
}

    public function destroy(string $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    $user->delete();

    return response()->json([
        'message' => 'User berhasil dihapus'
    ]);
}
}