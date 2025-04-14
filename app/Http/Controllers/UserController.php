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
        $posts = User::find($id)->posts;
        return view('profile', ['posts' => $posts, "url" => "profile"]);
    }

    public function showEditProfile()
    {
        $id = Auth::id();
        $user = User::find($id);
        return view('editProfile', ['user' => $user, "url" => "edit profile"]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);
    
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    public function destroy($id)
    {
        if (Gate::allows('isAdmin')) {
            $user->delete();
            return redirect()->route('admin.index')->with('success', 'User deleted successfully!');
        }
    
        return redirect()->route('home')->with('error', 'Unauthorized action.');
    }

}
