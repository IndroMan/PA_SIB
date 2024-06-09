<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use \Spatie\Permission\Models\Role;

use function Laravel\Prompts\confirm;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('layouts.manage.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                "name" => ['required'],
                "email" => ['required', 'email'],
                "password" => ['required'],
                "avatar" => ['mimes:jpg,jpeg,png']
            ]);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            // optional image
            if ($request->hasFile('avatar')) {
                $fileName = \Carbon\Carbon::now()->timestamp . '_' . str_replace(' ', '_', strtolower($request->name)) . '.jpg';
                $user->avatar = $request->file('avatar')->storeAs('avatar', $fileName, 'public');
            }
            $user->save();
            $user->assignRole($request->role);
            toastr()->success("User Created Successfully");
            return redirect()->route('manage.users.index');
        } catch (\Illuminate\Database\QueryException $e) {
            // catch error if users has duplicate email
            toastr()->error('An error has occurred please try again later.');
            return redirect()->route('manage.users.create');
        }
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $roles = Role::all();
        $user = User::find($id);
        return view('layouts.manage.users.edit', compact('roles', 'user'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                "name" => ['required'],
                "email" => ['required', 'email'],
                "avatar" => ['mimes:jpg,jpeg,png']
            ]);

            $user = User::find($id);
            $user->name = $request->name ?? $user->name;
            $user->email = $request->email ?? $user->email;
            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }

            // optional image
            if ($request->hasFile('avatar')) {
                // Delete old image
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $fileName = \Carbon\Carbon::now()->timestamp . '_' . str_replace(' ', '_', strtolower($request->name)) . '.jpg';
                $user->avatar = $request->file('avatar')->storeAs('avatar', $fileName, 'public');
            }
            $user->save();
            $user->assignRole($request->role);
            toastr()->success("User Updated Successfully");
            return redirect()->route('manage.users.index');
        } catch (\Illuminate\Database\QueryException $e) {
            // catch error if users has duplicate email
            toastr()->error($e->getMessage());
            return redirect()->route('manage.users.edit');
        }
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        // Check is users has device
        if ($user->devices()->exists()) {
            toastr()->error("User can't be deleted cause this user has device");
            return redirect()->back();
        }

        // delete avatar if file exist
        if (Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        toastr()->success("User deleted successfully");
        return redirect()->back();
    }
}