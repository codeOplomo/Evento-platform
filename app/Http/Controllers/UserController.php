<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function ban($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_banned' => true]);

        return back()->with('success', 'User banned successfully.');
    }

    public function unban($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_banned' => false]);

        return back()->with('success', 'User unbanned successfully.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve organizers
        $organizers = User::whereHas('roles', function ($query) {
            $query->where('name', 'organiser');
        })->get();

        // Retrieve clients
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->get();

        return view('admin.users.index', compact('organizers', 'clients'));
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        
        $role = Role::where('name', $request->role)->first();
        $user->roles()->attach($role);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        
        $user->roles()->sync([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

}
