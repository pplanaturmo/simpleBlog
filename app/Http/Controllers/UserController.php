<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{



    public function index()
    {
        $authenticatedUser = Auth::user();


        $users = User::with('roles')
            ->where('id', '!=', $authenticatedUser->id)
            ->get();
        $roles = Role::pluck('name', 'id');

        return view('users.index', compact('users', 'roles'));
    }

    public function changeRole(Request $request, $userId)
    {

        $user = User::findOrFail($userId);
        $role = Role::findOrFail($request->input('role'));
        $user->syncRoles([$role]);

        return redirect()->back()->with('info', 'User role changed successfully.');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect()->back()->with('info', 'User deleted successfully.');
    }

}
