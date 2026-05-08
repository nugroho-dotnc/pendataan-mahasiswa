<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Exception;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Jurusan::withCount('Prodi')->get();
        return view('jurusan.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('jurusan.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try {
             $values = $request->validate(
            [
                'name' => ['required' ,'max:255'],
            ]
        );
        $values['is_active'] = $request->has('is_active');
        $jurusan = Jurusan::create($values);
        return redirect()->route('jurusan.index')->with('success', 'jurusan dengan nama '.$jurusan->name.' berhasil dibuat!');
       } catch(Exception $e) {
        return redirect()->route('jurusan.create')->with('error', $e->getMessage());
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $jurusan = Jurusan::findOrFail($id);
         return view('jurusan.edit', ['jurusan'=>$jurusan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        try {
        $values = $request->validate(
            [
                'name' => ['required','max:255'],
            ]
        );
        $jurusan->name = $values['name'];
        $jurusan->is_active = $request->has('is_active');
        $jurusan->save();
        return redirect()->route('jurusan.index')->with('success', 'jurusan dengan nama '.$jurusan->name.' berhasil diupdate!');
       } catch(Exception $e) {
        return redirect()->route('jurusan.edit', $id)->with('error', $e->getMessage());
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jurusan = Jurusan::find($id);
        if($jurusan == null){
            return redirect()->route('jurusan.index')->with('error', 'data dengan id '.$id.' tidak ditemukan!');
        }
        $jurusan->is_active = false;
        $jurusan->save();
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus!');
    }
}
