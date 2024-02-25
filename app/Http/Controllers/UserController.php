<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Tables\Users;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Users::class;
        if ($users != null) {
            return view('admin.users.index', [
                'users' => Users::class
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());
        Splade::toast('user created successfully')->autoDismiss(3);
        return view('admin.users.index', [
            'users' => Users::class
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        Splade::toast('user updated')->autoDismiss(3);
        return view('admin.users.index', [
            'users' => Users::class
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        Splade::toast('User deleted successfully')->autoDismiss(3);
        return back();
    }
}
