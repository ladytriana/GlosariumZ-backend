<?php

namespace App\Http\Controllers;

use App\Models\Istilah;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IstilahController extends Controller
{
    // GET /istilah - Public (All Istilah)
    public function index()
    {
        $istilah = Istilah::all();
        return response()->json($istilah);
    }

    // GET /istilah/{id} - Public
    public function show($id)
    {
        $istilah = Istilah::find($id);
        if (!$istilah) {
            return response()->json(['message' => 'Istilah not found'], 404);
        }
        return response()->json($istilah);
    }

    // POST /istilah - Only Admins
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kata' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $istilah = Istilah::create([
            'id' => Str::uuid(),
            'kata' => $validatedData['kata'],
            'deskripsi' => $validatedData['deskripsi']
        ]);

        return response()->json($istilah, 201);
    }

    // DELETE /istilah/{id} - Only Admins
    public function destroy($id)
    {
        $istilah = Istilah::find($id);
        if (!$istilah) {
            return response()->json(['message' => 'Istilah not found'], 404);
        }

        $istilah->delete();
        return response()->json(['message' => 'Istilah deleted successfully']);
    }

    // PUT /istilah/{id} - Only Admins
    public function update(Request $request, $id)
    {
        $istilah = Istilah::find($id);
        if (!$istilah) {
            return response()->json(['message' => 'Istilah not found'], 404);
        }

        $validatedData = $request->validate([
            'kata' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $istilah->update($validatedData);
        return response()->json($istilah);
    }
}
