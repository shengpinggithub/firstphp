<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserName;


class GreetController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $user = UserName::create($validated);

        return response()->json([
            'name' => $user->name,
            'address' => $user->address,
        ]);
    }

    public function showById($id)
    {
        $user = UserName::findById($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'name' => $user->name,
            'address' => $user->address,
        ]);
    }

    public function showByAddress($address)
    {
        $user = UserName::where('address', $address)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'name' => $user->name,
            'address' => $user->address,
        ]);
    }
}
