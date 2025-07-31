<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    //
    public function showAdminDepartment(Request $request)
    {
        $searchKeywords = $request->input('search');
        // Logic to retrieve and display department data
        $departmentsQuery = Department::query();
        if ($searchKeywords) {
            $departmentsQuery->where(function ($query) use ($searchKeywords) {
                $query->where('nama', 'like', '%' . $searchKeywords . '%');
            });
        }
        $departments = $departmentsQuery->paginate(10)->appends(request()->query());
        return view(
            'admin.department.dashboard',
            compact('departments')
        );
    }
    public function create()
    {
        return view('admin.department.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:departments,nama',
            'deskripsi' => 'nullable|string|max:255',
        ]);
        $department = new Department();
        $department->nama = $validated['nama'];
        $department->deskripsi = $validated['deskripsi'];
        $department->save();

        return redirect()->route('admin.department.dashboard')
            ->with('toast', [
                'type' => 'success',
                'message' => 'Department created successfully.'
            ]);
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.department.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:departments,nama' . $id,
            'deskripsi' => 'nullable|string|max:255',
        ]);
        $department->nama = $validated['nama'];
        $department->deskripsi = $validated['deskripsi'];
        $department->save();

        return redirect()->route('admin.department.dashboard')
            ->with('toast', [
                'type' => 'success',
                'message' => 'Department updated successfully.'
            ]);
    }
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()->route('admin.department.dashboard')
            ->with('toast', [
                'type' => 'success',
                'message' => 'Department deleted successfully.'
            ]);
    }
}
