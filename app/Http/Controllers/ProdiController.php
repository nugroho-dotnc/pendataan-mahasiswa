<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $data = Prodi::with('Jurusan')->withCount('Mahasiswa')->get();
        return view('prodi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::all();
        return view('prodi.add', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'jurusan' => 'required|exists:jurusans,id',
        ]);

        $prodi = new Prodi();
        $prodi->name = $request->name;
        $prodi->jurusan_id = $request->jurusan;
        $prodi->is_active = $request->has('is_active');
        $prodi->save();

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dibuat!');
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
        $prodi = Prodi::findOrFail($id);
        $jurusans = Jurusan::all();
        return view('prodi.edit', compact('prodi', 'jurusans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'jurusan' => 'required|exists:jurusans,id',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->name = $request->name;
        $prodi->jurusan_id = $request->jurusan;
        $prodi->is_active = $request->has('is_active');
        $prodi->save();

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->is_active = false;
        $prodi->save();
        
        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus!');
    }
}
