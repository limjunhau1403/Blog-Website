<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showProfile()
    {
        $id = Auth::id();
        $posts = User::findOrFail($id)->posts;
        return view('profile', ['posts' => $posts, 'url' => 'profile']);
    }

    public function showEditProfile($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('view', $user);

        return view('editProfile', ['user' => $user, 'url' => 'edit profile']);
    }

    public function update(Request $request, $id)
    {
        // Retrieve the user to update
        $user = User::findOrFail($id);

        $this->authorize('update', $user);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    
        // Check if it is editing by an admin
        if (Auth::id() !== $user->id && Auth::user()->is_admin) {
            return redirect()->route('admin.index')->with('success', 'User updated successfully!');
        }
    
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User deleted successfully!');
    }
}
