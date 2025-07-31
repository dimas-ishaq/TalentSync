<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function showAdminUser(Request $request)
    {
        $searchKeywords = $request->input('search');
        $userQuery = User::query();
        if ($searchKeywords) {
            $userQuery->where(function ($query) use ($searchKeywords) {
                $query->where('name', 'like', '%' . $searchKeywords . '%')
                    ->orWhere('email', 'like', '%' . $searchKeywords . '%');
            });
        }
        $users = $userQuery->paginate(10)->appends(request()->query());
        return view('admin.user.dashboard', compact('users'));
    }
    public function create()
    {
        $karyawans = Karyawan::whereNotIn('id', function ($query) {
            $query->select('karyawan_id')->from('users')->whereNotNull('karyawan_id');
        })->get();

        return view('admin.user.create', compact('karyawans'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->karyawan_id = $validated['karyawan_id'];
        $user->password = Hash::make($validated['password']);

        $user->save();

        return redirect()->route('admin.user.dashboard')->with('toast', [
            'type' => 'success',
            'message' => 'user created successfully.'
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->nama = $validated['nama'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);

        $user->save();
        return redirect()->route('admin.user.dashboard')->with('toast', [
            'type' => 'success',
            'message' => 'user updated successfully.'
        ]);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.user.dashboard')->with('toast', [
                'type' => 'danger',
                'message' => 'You cannot delete your own account.'
            ]);
        }

        $user->delete();

        return redirect()->route('admin.user.dashboard')->with('toast', [
            'type' => 'success',
            'message' => 'user deleted successfully.'
        ]);
    }
}
