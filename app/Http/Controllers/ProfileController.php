<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function updateProfil(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => 'required'
        ]);

        $user->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Profile Berhasil Diperbaharui!!!');
    }
}
