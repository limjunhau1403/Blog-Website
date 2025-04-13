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

    public function edit($id)   
    {
        // Find the user and show the edit form
        // ...
    }

    public function update(Request $request, $id)
    {
        // Validate and update the user
        // ...
    }

    public function destroy($id)
    {
        // Find the user and delete
        // ...
    }

}
