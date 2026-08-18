<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('reservasiWisatas')->latest()->get();
        return view('admin.user.index', compact('users'));
    }

    public function updateRole(User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'Tidak bisa mengubah role sendiri');
        $user->update(['role' => $user->role === 'admin' ? 'user' : 'admin']);
        return back()->with('success', 'Role diperbarui ✅');
    }

    public function destroy(User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'Tidak bisa menghapus akun sendiri');
        $user->delete();
        return back()->with('success', 'User dihapus 🗑');
    }
}