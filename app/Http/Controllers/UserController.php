<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
{
    $users = User::where('type', 'user')->orderBy('username', 'asc')->get();
    return view('superadmin.users.index', compact('users'));
}
public function edit($id)
{
    $user = User::findOrFail($id);

    // Check the type of the user and redirect to the appropriate view
    if ($user->type == 'admin') {
        return view('superadmin.addAdmins', compact('user'));
    } else {
        return view('superadmin.addUser', compact('user'));
    }
}

public function adminindex()
{
    $users = User::where('type', 'admin')->orderBy('username', 'asc')->get();
    return view('superadmin.admins.index', compact('users'));
}

    public function create()
    {
        return view('superadmin.addUser');
    }
    public function createadmin()
    {
        return view('superadmin.addAdmins');
    }
// User Update 
public function update(Request $request, $id)
{Log::info('Form Data: ', $request->all());
    try {
        // Validate the request data
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8',
            'mobileno' => 'required|string|max:20',
            'projectname' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|string|max:10',
            'state' => 'required|string|max:255',
            'address' => 'required|string|max:500',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);
        $userData = $request->except(['_token', '_method', 'password']); // Exclude unnecessary fields

        // Update password if provided
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }
        $user->projectname = $request->projectname ?? '';
      

        // Update the user data
        $user->update($userData);

        if ($request->type == 'admin') {
            return redirect()->route('superadmin.admins.index')->with('success', 'Admin created successfully.');
        } else {
            return redirect()->route('superadmin.users.index')->with('success', 'User created successfully.');
        }
    } catch (\Illuminate\Database\QueryException $e) {
        // Handle unique constraint violation
        if ($e->getCode() == 23000) { // SQLSTATE code for unique constraint violation
            Log::error('Unique constraint violation: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Username already taken.']);
        } else {
            Log::error('Error updating user: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to update user.']);
        }
    } catch (\Exception $e) {
        Log::error('Error updating user: ' . $e->getMessage());
        return back()->withInput()->withErrors(['error' => 'Failed to update user.']);
    }
}


public function destroy($id)
{
    try {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('superadmin.users.index')->with('success', 'User deleted successfully.');
    } catch (\Exception $e) {
        Log::error('Error deleting user: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Failed to delete user.']);
    }
}
public function store(Request $request)
{
    Log::info('Form Data: ', $request->all());

    try {
        $request->validate([
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:50',
            'type' => 'required|string|max:20',
            'password' => 'required|string|min:8|max:255',
            'mobileno' => 'required|string|max:15',
            'projectname' => 'nullable|string|max:30',
            'city' => 'nullable|string|max:30',
            'zipcode' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:200',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'type' => $request->type,
            'password' => Hash::make($request->password),
            'mobileno' => $request->mobileno,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'state' => $request->state,
            'address' => $request->address,
           
        ]);


        // Manually set projectname and save
        $user->projectname = $request->projectname ?? '';
        $user->save();

        Log::info('User created: ', $user->toArray());

        if ($request->type == 'admin') {
            return redirect()->route('superadmin.admins.index')->with('success', 'Admin created successfully.');
        } else {
            return redirect()->route('superadmin.users.index')->with('success', 'User created successfully.');
        }

    } catch (\Exception $e) {
        Log::error('Error creating user: ' . $e->getMessage());
        return back()->withInput()->withErrors(['error' => 'Failed to create user.'. $e->getMessage()]);
    }
}

}