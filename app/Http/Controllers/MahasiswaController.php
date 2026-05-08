<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = User::with('Prodi')->get();
        return view('mahasiswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodis = Prodi::all();
        return view('mahasiswa.add', compact('prodis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'nim' => 'required|unique:users,nim',
            'angkatan' => 'required|integer',
            'prodi' => 'required|exists:prodis,id',
        ]);

        $mahasiswa = new User();
        $mahasiswa->name = $request->name;
        $mahasiswa->email = $request->email;
        $mahasiswa->password = bcrypt($request->password);
        $mahasiswa->nim = $request->nim;
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->prodi_id = $request->prodi;
        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mahasiswa = User::findOrFail($id);
        $prodis = Prodi::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'prodis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mahasiswa = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$mahasiswa->id,
            'nim' => 'required|unique:users,nim,'.$mahasiswa->id,
            'angkatan' => 'required|integer',
            'prodi' => 'required|exists:prodis,id',
        ]);

        $mahasiswa->name = $request->name;
        $mahasiswa->email = $request->email;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->prodi_id = $request->prodi;
        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = User::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus!');
    }
}
