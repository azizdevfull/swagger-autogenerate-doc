<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use G4T\Swagger\Attributes\SwaggerSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

#[SwaggerSection('everything about your users')]
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->store('images/avatars', 'public');
            $user->avatar = $filename;
            $user->save();
        }

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
