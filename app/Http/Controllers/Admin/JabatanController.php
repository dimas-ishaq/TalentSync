<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jabatan;

class JabatanController extends Controller
{
    //
    public function showAdminJabatan(Request $request)
    {
        $searchkeywords = $request->input('search');
        $jabatansQuery = Jabatan::query();
        if ($searchkeywords) {
            $jabatansQuery->where(function ($query) use ($searchkeywords) {
                $query->where('nama', 'like', '%' . $searchkeywords . '%');
            });
        }
        $jabatans = $jabatansQuery->paginate(10)->appends(request()->query());
        return view('admin.jabatan.dashboard', compact('jabatans'));
    }

    public function create()
    {
        return view('admin.jabatan.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:jabatans,nama',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        // Simpan ke database
        $jabatan = new Jabatan();
        $jabatan->nama = $validated['nama'];
        $jabatan->deskripsi = $validated['deskripsi'] ?? null;
        $jabatan->save();

        return redirect()->route('admin.jabatan.dashboard')
            ->with('success', 'Jabatan created successfully.');
    }

    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('admin.jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:jabatans,nama' . $id,
            'deskripsi' => 'nullable|string|max:255',
        ]);
        $jabatan->nama = $validated['nama'];
        $jabatan->deskripsi = $validated['deskripsi'] ?? null;
        $jabatan->save();

        return redirect()->route('admin.jabatan.dashboard')
            ->with('success', 'Jabatan updated successfully.');
    }
    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('admin.jabatan.dashboard')
            ->with('success', 'Jabatan deleted successfully.');
    }
}
