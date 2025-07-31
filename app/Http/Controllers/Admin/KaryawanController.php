<?php

namespace App\Http\Controllers\Admin;

use App\Models\Karyawan;
use App\Models\Department;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class KaryawanController extends Controller
{
    public function showAdminKaryawan(Request $request)
    {
        $searchKeywords = $request->input('search');
        $karyawansQuery = Karyawan::with(['jabatan', 'department']);
        $jabatans = Jabatan::all();
        $departments = Department::all();

        if ($searchKeywords) {
            $karyawansQuery->where(function ($query) use ($searchKeywords) {
                $query->where('nama', 'like', '%' . $searchKeywords . '%');
                $query->orWhereHas('jabatan', function ($subQuery) use ($searchKeywords) {
                    $subQuery->where('nama', 'like', '%' . $searchKeywords . '%');
                });
                $query->orWhereHas('department', function ($subQuery) use ($searchKeywords) {
                    $subQuery->where('nama', 'like', '%' . $searchKeywords . '%');
                });
            });
        }
        // Logic to retrieve and display karyawan data
        $karyawans = $karyawansQuery->paginate(10)->appends(request()->query());
        return view('admin.karyawan.dashboard', compact('karyawans', 'jabatans', 'departments'));
    }
    public function showDetailKaryawan($id)
    {
        // Logic to retrieve and display a specific karyawan's details
        $karyawan = Karyawan::with(['jabatan', 'department'])->findOrFail($id);
        return response()->json($karyawan);
    }

    public function create()
    {
        // Logic to show the form for creating a new karyawan
        $departments = Department::all();
        $jabatans = Jabatan::all();
        return view('admin.karyawan.create', compact('departments', 'jabatans'));
    }

    public function store(Request $request)
    {
        // Logic to store a new karyawan
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:karyawans,email'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'jabatan_id' => ['required', 'exists:jabatans,id'],
            'department_id' => ['required', 'exists:departments,id'],
            'tanggal_masuk' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'max:2048'], // opsional: validasi file gambar maks 2MB
            'status' => ['required', 'in:aktif,nonaktif'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'agama' => ['nullable', 'in:Islam,Kristen,Hindu,Budha,Konghucu'],
            'pendidikan_terakhir' => ['required', 'in:SD,SMP,SMA/SMK,D1,D2,D3,S1,S2'],
            'pengalaman_kerja' => ['nullable', 'string'],
            'keterampilan' => ['nullable', 'string'],
            'status_pernikahan' => ['required', 'in:Belum Menikah,Menikah,Cerai Hidup,Cerai Mati'],
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'no_telepon.required' => 'No telepon wajib diisi',
            'jabatan_id.required' => 'Jabatan harus di pilih',
            'department_id.required' => 'Department harus dipih',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'status.required' => 'Status wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'pendidikan_terakhir.required' => 'Pendidikan terakhir wajib dipilih',
            'status_pernikahan.required' => 'Status pernikahan wajib dipilih'
        ]);

        $karyawan = new Karyawan();

        $karyawan->nama = $validated['nama'];
        $karyawan->email = $validated['email'];
        $karyawan->no_telepon = $validated['no_telepon'];
        $karyawan->jabatan_id = $validated['jabatan_id'];
        $karyawan->department_id = $validated['department_id'];
        $karyawan->tanggal_masuk = $validated['tanggal_masuk'];
        $karyawan->alamat = $validated['alamat'];
        // kosongkan foto sementar
        $karyawan->foto = $request->hasFile('foto')
            ? $request->file('foto')->store('foto_karyawan', 'public')
            : null;
        $karyawan->status = $validated['status'];
        $karyawan->jenis_kelamin = $validated['jenis_kelamin'];
        $karyawan->agama = $validated['agama'];
        $karyawan->pendidikan_terakhir = $validated['pendidikan_terakhir'];
        $karyawan->pengalaman_kerja = $validated['pengalaman_kerja'];
        $karyawan->keterampilan = $validated['keterampilan'];
        $karyawan->status_pernikahan = $validated['status_pernikahan'];

        // Save the karyawan
        $karyawan->save();

        return redirect()->route('admin.karyawan.dashboard')->with('toast', [
            'type' => 'success',
            'message' => 'Karyawan created successfully.'
        ]);
    }



    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        try {
            $validated = $request->validate([
                'nama' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('karyawans')->ignore($karyawan->id)],
                'no_telepon' => ['nullable', 'string', 'max:20'],
                'jabatan_id' => ['required', 'exists:jabatans,id'],
                'department_id' => ['required', 'exists:departments,id'],
                'tanggal_masuk' => ['nullable', 'date'],
                'alamat' => ['nullable', 'string'],
                'foto' => ['nullable', 'image', 'max:2048'],
                'status' => ['required', 'in:aktif,nonaktif'],
                'jenis_kelamin' => ['nullable', 'in:L,P'],
                'agama' => ['nullable', 'in:Islam,Kristen,Hindu,Budha,Konghucu'],
                'pendidikan_terakhir' => ['nullable', 'in:SD,SMP,SMA/SMK,D1,D2,D3,S1,S2'],
                'pengalaman_kerja' => ['nullable', 'string'],
                'keterampilan' => ['nullable', 'string'],
                'status_pernikahan' => ['nullable', 'in:Belum Menikah,Menikah,Cerai Hidup,Cerai Mati'],
            ]);

            // Logic to update an existing karyawan
            $karyawan->fill($validated); // Menggunakan fill untuk efisiensi

            // Handle foto secara terpisah karena tidak langsung dari $validated
            // if ($request->hasFile('foto')) {
            //     // Hapus foto lama jika ada
            //     if ($karyawan->foto) {
            //         \Storage::disk('public')->delete($karyawan->foto);
            //     }
            //     $karyawan->foto = $request->file('foto')->store('foto_karyawan', 'public');
            // } elseif ($request->input('clear_foto')) { // Tambahkan input tersembunyi untuk menghapus foto
            //     if ($karyawan->foto) {
            //         \Storage::disk('public')->delete($karyawan->foto);
            //     }
            //     $karyawan->foto = null;
            // }
            // Jika tidak ada file baru dan tidak ada permintaan clear_foto, biarkan foto lama

            $karyawan->save();

            return redirect()->route('admin.karyawan.dashboard')->with('toast', [
                'type' => 'success',
                'message' => 'Karyawan berhasil diperbarui.'
            ]);
        } catch (ValidationException $e) {

            $errors = $e->validator->errors()->all();

            foreach ($errors as $error) {
                $errorMessage = $error;
            }

            return redirect()->back()->with('toast', [
                'type' => 'danger',
                'message' => $errorMessage
            ]);
        }
    }
    public function destroy($id)
    {
        // Logic to delete a karyawan
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('admin.karyawan.dashboard')->with('toast', [
            'type' => 'success',
            'message' => 'Karyawan deleted successfully.'
        ]);
    }
}
