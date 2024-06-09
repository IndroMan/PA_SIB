<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:6|confirmed',
        // ]);

        // $user = User::create($validatedData);

        // return response()->json([
        //     'message' => 'User created successfully',
        //     'data' => $user
        // ], 201);
    }

    public function show(string $id)
    {
        return User::find($id);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        if (User::where('id', $id)->exists()) {
            $users = User::find($id);
            $users->name = is_null($request->name) ? $users->name : $request->name;
            $users->email = is_null($request->email) ? $users->email : $request->email;
            $users->password = is_null($request->password) ? $users->password : $request->password;
            $users->avatar = is_null($request->avatar) ? $users->avatar : $request->avatar;
            $users->save();
            return response()->json([
                "message" => "User telah diupdate."
            ], 201);
        } else {
            return response()->json([
                "message" => "User tidak ditemukan."
            ], 404);
        }
    }

    public function destroy(string $id)
    {
        if (User::where('id', $id)->exists()) {
            $users = User::find($id);
            $users->delete();
            return response()->json([
                "message" => "User telah dihapus."
            ], 201);
        } else {
            return response()->json([
                "message" => "User tidak ditemukan."
            ], 404);
        }
    }
}