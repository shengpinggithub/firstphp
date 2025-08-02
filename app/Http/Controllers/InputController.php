<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class InputController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email'   => 'required|email|max:255',
            'title'   => 'nullable|string|max:255',
            'wage'    => 'nullable|numeric|min:0',
        ]);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function showByEmail($email)
    {
        $user = User::where('email', $email)->first();

        if (! $user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email'   => 'required|email|max:255',
            'title'   => 'nullable|string|max:255',
            'wage'    => 'nullable|numeric|min:0',
        ]);

        $user->update($validated);

        return response()->json(['message' => 'User updated successfully']);
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (! $user) {
            abort(404);
        }

        return view('user.edit', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function searchByTitle($title)
    {
        $users = User::where('title', 'like', '%' . $title . '%')->get();

        if ($users->isEmpty()) {
            return response()->json(['error' => 'No users found'], 404);
        }

        return response()->json($users);
    }

}
